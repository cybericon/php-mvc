<?php
require_once __DIR__ . "/base/constants.php";
require_once BASE_DIR . "vendor/autoload.php";

use Core\App;
use Core\Database\Connection;
use Core\Database\QueryBuilder;

App::bind('routes', require APP_DIR . "routes.php");

if (file_exists($file = BASE_DIR . "config.json")) {
    APP::bind(
        'config',
        json_decode(file_get_contents($file), true)
    );
} else {
    throw new Exception("Config file not found");
}

App::bind('database', new QueryBuilder(Connection::getInstance()));
