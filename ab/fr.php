<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$router = require __DIR__ . '/../fr.php';

$router->dispatch($_GET['method'], $_GET['uri']);