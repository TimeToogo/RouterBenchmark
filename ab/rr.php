<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$router = require __DIR__ . '/../rr.php';

$router($_GET['method'], $_GET['uri']);