<?php

use FastRoute\Dispatcher;
use Nice\Benchmark\Benchmark;

require __DIR__ . '/vendor/autoload.php';

/** @var callable $rapidRoute */
$rapidRoute = require __DIR__ . '/rr.php';

/** @var Dispatcher $fastRoute */
$fastRoute = require __DIR__ . '/fr.php';

// Iterations per test, higher = better average
$iterations = 100;
// Iterations of repeat for each benchmark to register a measurable time
$innerIterations = 10000;

$benchmark = new Benchmark();
$benchmark->setIterations($iterations);
$benchmark->setName('Router benchmark');

// Fair start, warm up routers
$rapidRoute('GET', '/');
$fastRoute->dispatch('GET', '/');

$benchmark->register('RapidRoute - First static route', function () use ($rapidRoute, $innerIterations) {
    while($innerIterations--) {
        $rapidRoute('GET', '/');
    }
});
$benchmark->register('FastRoute - First static route', function () use ($fastRoute, $innerIterations) {
    while($innerIterations--) {
        $fastRoute->dispatch('GET', '/');
    }
});

$benchmark->register('RapidRoute - First dynamic route', function () use ($rapidRoute, $innerIterations) {
    while($innerIterations--) {
        $rapidRoute('GET', '/page/hello-word');
    }
});
$benchmark->register('FastRoute - First dynamic route', function () use ($fastRoute, $innerIterations) {
    while($innerIterations--) {
        $fastRoute->dispatch('GET', '/page/hello-word');
    }
});

$benchmark->register('RapidRoute - Last static route', function () use ($rapidRoute, $innerIterations) {
    while($innerIterations--) {
        $rapidRoute('GET', '/admin/category');
    }
});
$benchmark->register('FastRoute - Last static route', function () use ($fastRoute, $innerIterations) {
    while($innerIterations--) {
        $fastRoute->dispatch('GET', '/admin/category');
    }
});

$benchmark->register('RapidRoute - Last dynamic route', function () use ($rapidRoute, $innerIterations) {
    while($innerIterations--) {
        $rapidRoute('DELETE', '/admin/category/123');
    }
});
$benchmark->register('FastRoute - Last dynamic route', function () use ($fastRoute, $innerIterations) {
    while($innerIterations--) {
        $fastRoute->dispatch('DELETE', '/admin/category/123');
    }
});

$benchmark->register('RapidRoute - Non-existent route', function () use ($rapidRoute, $innerIterations) {
    while($innerIterations--) {
        $rapidRoute('GET', '/shop/product/awesome');
    }
});
$benchmark->register('FastRoute - Non-existent route', function () use ($fastRoute, $innerIterations) {
    while($innerIterations--) {
        $fastRoute->dispatch('GET', '/shop/product/awesome');
    }
});

$benchmark->register('RapidRoute - Longest route', function () use ($rapidRoute, $innerIterations) {
    while($innerIterations--) {
        $rapidRoute('GET', '/shop/category/123/product/search/status:sale');
    }
});
$benchmark->register('FastRoute - Longest route', function () use ($fastRoute, $innerIterations) {
    while($innerIterations--) {
        $fastRoute->dispatch('GET', '/shop/category/123/product/search/status:sale');
    }
});

$benchmark->register('RapidRoute - Invalid method, static route', function () use ($rapidRoute, $innerIterations) {
    while($innerIterations--) {
        $rapidRoute('PUT', '/about-us');
    }
});
$benchmark->register('FastRoute - Invalid method, static route', function () use ($fastRoute, $innerIterations) {
    while($innerIterations--) {
        $fastRoute->dispatch('PUT', '/about-us');
    }
});

$benchmark->register('RapidRoute - Invalid method, dynamic route', function () use ($rapidRoute, $innerIterations) {
    while($innerIterations--) {
        $rapidRoute('PATCH', '/shop/category/123');
    }
});
$benchmark->register('FastRoute - Invalid method, dynamic route', function () use ($fastRoute, $innerIterations) {
    while($innerIterations--) {
        $fastRoute->dispatch('PATCH', '/shop/category/123');
    }
});

// Fix div by 0 error in bench library
error_reporting(0);

$benchmark->execute();