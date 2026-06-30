<?php

use app\helpers\Env;

if (session_status() === PHP_SESSION_NONE) session_start();
ini_set('memory_limit', '256M');
ini_set('display_errors', '1');
ini_set('log_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . "/vendor/autoload.php";

Env::load(__DIR__ . '/config/.Env');
