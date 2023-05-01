<?php

use EmailFakefilter\Tools\JsonProcessor;

require __DIR__ . '/vendor/autoload.php';

$processor = new JsonProcessor(__DIR__.'/tmp/data_version2.json', dirname(__DIR__).'/data');
$processor->process();
