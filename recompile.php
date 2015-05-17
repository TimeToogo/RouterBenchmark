<?php

require __DIR__ . '/vendor/autoload.php';

@unlink(__DIR__ . '/compiled/fr.php');
@unlink(__DIR__ . '/compiled/rr.php');
@unlink(__DIR__ . '/ab/compiled/fr.php');
@unlink(__DIR__ . '/ab/compiled/rr.php');

require __DIR__ . '/rr.php';
require __DIR__ . '/fr.php';
require __DIR__ . '/ab/rr.php';
require __DIR__ . '/ab/fr.php';