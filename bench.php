<?php

use FastRoute\Dispatcher;
use Nice\Benchmark\Benchmark;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/markdown.php';

/** @var callable $rapidRoute */
$rapidRoute = require __DIR__ . '/rr.php';

/** @var Dispatcher $fastRoute */
$fastRoute = require __DIR__ . '/fr.php';

// Iterations per test, higher = better average
$iterations = 1000;
// Iterations of repeat for each benchmark to register a measurable time
$innerIterations = 1000;

/** @var Benchmark[] $benchmarks */
$benchmarks = [];

// Fair start, warm up routers
$rapidRoute('GET', '/');
$fastRoute->dispatch('GET', '/');

$setupBenchmark = function (
    $name,
    $method,
    $uri,
    $expectedRapidRouteResult,
    $expectedFastRouteResult
) use ($rapidRoute, $fastRoute, &$benchmarks, $iterations, $innerIterations) {

    if (($result = $rapidRoute($method, $uri)) !== $expectedRapidRouteResult) {
        throw new \RuntimeException(sprintf(
            'Bad benchmark: RapidRoute did not return the expected result %s, %s returned',
            var_export($expectedRapidRouteResult, true),
            var_export($result, true)
        ));
    }

    if (($result = $fastRoute->dispatch($method, $uri)) !== $expectedFastRouteResult) {
        throw new \RuntimeException(sprintf(
            'Bad benchmark: FastRoute did not return the expected result %s, %s returned',
            var_export($expectedFastRouteResult, true),
            var_export($result, true)
        ));
    }

    $benchmark = new Benchmark();
    $benchmark->setIterations($iterations);
    $benchmark->setName($name);

    $benchmark->register('RapidRoute',
        function () use ($rapidRoute, $innerIterations, $method, $uri) {
            while ($innerIterations--) {
                $rapidRoute($method, $uri);
            }
        });

    $benchmark->register('FastRoute',
        function () use ($fastRoute, $innerIterations, $method, $uri) {
            while ($innerIterations--) {
                $fastRoute->dispatch($method, $uri);
            }
        });

    $benchmarks[] = $benchmark;
};

$setupBenchmark(
    'First static route',
    'GET', '/',
    [\RapidRoute\MatchResult::FOUND, ['name' => 'home'], []],
    [\FastRoute\Dispatcher::FOUND, ['name' => 'home'], []]
);

$setupBenchmark(
    'Last static route',
    'GET', '/admin/category',
    [\RapidRoute\MatchResult::FOUND, ['name' => 'admin.category.index'], []],
    [\FastRoute\Dispatcher::FOUND, ['name' => 'admin.category.index'], []]
);

$setupBenchmark(
    'First dynamic route',
    'GET', '/page/hello-word',
    [\RapidRoute\MatchResult::FOUND, ['name' => 'page.show'], ['page_slug' => 'hello-word']],
    [\FastRoute\Dispatcher::FOUND, ['name' => 'page.show'], ['page_slug' => 'hello-word']]
);

$setupBenchmark(
    'Last dynamic route',
    'GET', '/admin/category/123',
    [\RapidRoute\MatchResult::FOUND, ['name' => 'admin.category.show'], ['category_id' => '123']],
    [\FastRoute\Dispatcher::FOUND, ['name' => 'admin.category.show'], ['category_id' => '123']]
);

$setupBenchmark(
    'Non-existent route',
    'GET', '/shop/product/awesome',
    [\RapidRoute\MatchResult::NOT_FOUND],
    [\FastRoute\Dispatcher::NOT_FOUND]
);

$setupBenchmark(
    'Longest route',
    'GET', '/shop/category/123/product/search/status:sale',
    [
        \RapidRoute\MatchResult::FOUND,
        ['name' => 'shop.category.product.search'],
        ['category_id' => '123', 'filter_by' => 'status', 'filter_value' => 'sale']
    ],
    [
        \FastRoute\Dispatcher::FOUND,
        ['name' => 'shop.category.product.search'],
        ['category_id' => '123', 'filter_by' => 'status', 'filter_value' => 'sale']
    ]
);

$setupBenchmark(
    'Invalid HTTP method, static route',
    'PUT', '/about-us',
    [\RapidRoute\MatchResult::HTTP_METHOD_NOT_ALLOWED, ['GET', 'HEAD']],
    [\FastRoute\Dispatcher::METHOD_NOT_ALLOWED, ['GET']]
);

$setupBenchmark(
    'Invalid HTTP method, dynamic route',
    'PATCH', '/shop/category/123',
    [\RapidRoute\MatchResult::HTTP_METHOD_NOT_ALLOWED, ['GET', 'HEAD']],
    [\FastRoute\Dispatcher::METHOD_NOT_ALLOWED, ['GET']]
);

$benchmarkResults = [];

echo 'Beginning benchmarks: '
    . $iterations
    . ' iterations of each test performed with '
    . $innerIterations
    . ' matches for each'
    . PHP_EOL;

foreach ($benchmarks as $benchmark) {
    echo 'Benchmarking: ' . $benchmark->getName() . PHP_EOL;
    $benchmark->setResultPrinter(new \Nice\Benchmark\ResultPrinter\NullPrinter());
    $benchResults = $benchmark->execute();
    $results      = [];

    // Code from nice/bench printer class,
    // did not really belong there
    $benchResults = array_map(function ($result) {
        return array_sum($result) / count($result);
    }, $benchResults);

    asort($benchResults);
    reset($benchResults);
    $fastestResult = each($benchResults);

    foreach ($benchResults as $name => $result) {
        $change = round((1 - $result / $fastestResult['value']) * 100, 0);
        if ($change == 0) {
            $change = 'baseline';
        } else {
            $faster = true; // Cant really ever be faster, now can it
            if ($change < 0) {
                $faster = false;
                $change *= -1;
            }
        }

        $results[$name] = [
            'result' => $result * 1000,
            'change' => $change,
        ];
    }

    $benchmarkResults[] = [
        'Test Name'              => $benchmark->getName(),
        'RapidRoute - Time (ms)' => sprintf('%.7f', $results['RapidRoute']['result']),
        'FastRoute - Time (ms)'  => sprintf('%.7f', $results['FastRoute']['result']),
        'Relative Difference'    => sprintf('%+.7f',
            $results['RapidRoute']['result'] - $results['FastRoute']['result']),
        'Change'                 => $results['FastRoute']['change'] === 'baseline'
            ? $results['RapidRoute']['change'] . '% slower'
            : $results['FastRoute']['change'] . '% faster',
    ];
}

echo PHP_EOL . PHP_EOL;

$table = new MarkdownTable(
    array_keys(reset($benchmarkResults)),
    array_map('array_values', $benchmarkResults)
);
echo $table->render();