<?php

define('ROOT', dirname(__DIR__));
chdir(ROOT);

require "vendor/autoload.php";

$app = new Slender\App();
$app->run();
