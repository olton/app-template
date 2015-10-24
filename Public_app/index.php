<?php

namespace Public_app;

use Core\Classes\Application;
use Core\Classes\Security;

error_reporting(E_ALL);

ini_set('session.gc_maxlifetime', 60*60);
ini_set('max_input_vars', 10000);

session_start();

include_once "../bootstrap.php";
include_once APP_CORE_CLASSES . "ExceptionHandler.php";

define('TEMPLATE_PATH', APP_ROOT . "Public_app" . DSP);

$database_config = include(APP_CONFIG . 'database.php');
$routes_config = include(APP_CONFIG . 'routes.php');

$config = array(
    'database'   => $database_config,
    'routes'     => $routes_config,
    'controller' => 'Core\\Controllers\\',
    'salt' => '',
    'defaults' => array('controller' => 'DefaultController', 'action' => 'PageNotFound')
);

$GET = Security::XSS($_GET);
$POST = Security::XSS($_POST);
$REQUEST = Security::XSS($_REQUEST);

if (!isset($_SESSION['current'])) {
    $_SESSION['current'] = false;
}

$app = new Application($config);
$app->Run();

