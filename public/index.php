<?php


require_once __DIR__ . "/../bootstrap.php";

use app\router\Router;

try {
    Router::execut();
} catch (Exception $e) {
    var_dump($e);
}
