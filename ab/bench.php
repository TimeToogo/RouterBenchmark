<?php

require __DIR__ . '/../markdown.php';

// Absolute http url to this directory
$url = 'http://localhost:8080/RouterBenchmark/ab/';
// Path to apache benchmark
$ab = 'ab';

$requests   = 1000;
$concurrent = 50;

// How long to sleep after every ab call
$sleepInterval = 3;

$benchmarks = [];

$setupBenchmark = function ($name, $method, $uri) use (&$benchmarks, $ab, $url, $requests, $concurrent) {
    $command     = "\"{$ab}\" -d -S -q -n {$requests} -c {$concurrent} \"%s\"";
    $queryString = http_build_query(['method' => $method, 'uri' => $uri]);

    $benchmarks[] = [
        'name'       => $name,
        'RapidRoute' => sprintf($command, $url . 'rr.php?' . $queryString),
        'FastRoute'  => sprintf($command, $url . 'fr.php?' . $queryString),
    ];
};

$setupBenchmark(
    'First static route',
    'GET', '/'
);

$setupBenchmark(
    'Last static route',
    'GET', '/admin/category'
);

$setupBenchmark(
    'First dynamic route',
    'GET', '/page/hello-word'
);

$setupBenchmark(
    'Last dynamic route',
    'GET', '/admin/category/123'
);

$setupBenchmark(
    'Non-existent route',
    'GET', '/shop/product/awesome'
);

$setupBenchmark(
    'Longest route',
    'GET', '/shop/category/123/product/search/status:sale'
);

$setupBenchmark(
    'Invalid method, static route',
    'PUT', '/about-us'
);

$setupBenchmark(
    'Invalid method, dynamic route',
    'PATCH', '/shop/category/123'
);

$benchmarkResults = [];

echo 'Beginning benchmarks: '
    . $requests
    . ' requests of each test performed with up to '
    . $concurrent
    . ' concurrent requests '
    . PHP_EOL;

foreach ($benchmarks as $benchmark) {
    echo 'Benchmarking: ' . $benchmark['name'] . PHP_EOL;

    $rapidRouteResult = shell_exec($benchmark['RapidRoute']);
    sleep($sleepInterval);

    $fastRouteResult = shell_exec($benchmark['FastRoute']);
    sleep($sleepInterval);

    foreach ([&$rapidRouteResult, &$fastRouteResult] as &$result) {
        preg_match('/Requests per second:\s+([\d\.]+)\s+/', $result, $matches);
        $result = (double)$matches[1];
    }

    $benchmarkResults[] = [
        'Test Name'            => $benchmark['name'],
        'RapidRoute (req/sec)' => sprintf('%.2f', $rapidRouteResult),
        'FastRoute (req/sec)'  => sprintf('%.2f', $fastRouteResult),
    ];
}

echo PHP_EOL . PHP_EOL;

$table = new MarkdownTable(
    array_keys(reset($benchmarkResults)),
    array_map('array_values', $benchmarkResults)
);
echo $table->render();