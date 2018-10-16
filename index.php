<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

const BP = __DIR__;

use DreamTeam\Framework\Application;
use DreamTeam\Framework\Router;

Application::run();
//Router::init();