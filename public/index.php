<?php

use App\Base\Application;

require __DIR__.'/../vendor/autoload.php';

$application = new Application(realpath(__DIR__.'/../'));
$application->run();