<?php

date_default_timezone_set("Europe/Kiev");

define('DSP', DIRECTORY_SEPARATOR);
define('APP_ROOT', dirname(__FILE__).DSP);
define('APP_CONFIG', APP_ROOT."Config".DSP);
define('APP_CORE', APP_ROOT."Core".DSP);
define('APP_CORE_CLASSES', APP_CORE."Classes".DSP);
define('APP_CORE_FUNCTIONS', APP_CORE."Functions".DSP);
define('APP_CORE_INTERFACES', APP_CORE."Interfaces".DSP);
define('APP_CORE_MODELS', APP_CORE."Models".DSP);
define('APP_CORE_CONTROLLERS', APP_CORE."Controllers".DSP);
define('APP_CORE_DEFINES', APP_CORE."Defines".DSP);
define('APP_HOOKS', APP_ROOT."Hooks".DSP);
define('APP_RESOURCES', APP_ROOT."Resources".DSP);

function app_autoload($name)
{
    $name = str_replace("\\", "/", $name);
    $name = APP_ROOT . "$name.php";
    if (file_exists($name)) {
        include_once($name);
    }
}

spl_autoload_register('app_autoload');