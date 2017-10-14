<?php

require_once __DIR__.'/vendor/autoload.php';

$size = 50 * 1024 * 1024;
$data = str_repeat(0, $size);
file_put_contents(__DIR__.'/huge_file', $data);