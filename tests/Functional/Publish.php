<?php

require_once 'vendor/autoload.php';

use MattyRad\NounProject;

$key = $argv[1];
$secret = $argv[2];
$icons = $argv[3];
$test = true;

$api = new NounProject\Client($key, $secret);
$request = new NounProject\Request\Publish($icons, $test);
$result = $api->send($request);

if (! $result->isSuccess()) {
    throw new \Exception($result->getReason());
}

var_dump($result->getPublished());