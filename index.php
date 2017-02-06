<?php
namespace ScreenSaver;

use ScreenSaver\Lib\Modules;
use ScreenSaver\Lib\Request;
use ScreenSaver\Lib\Autoloader;

define("BASEPATH", dirname(__FILE__));

define("MODULES_PATH", BASEPATH . DIRECTORY_SEPARATOR . "modules");

/**
 * Loading autoloader class
 */
include(BASEPATH."/lib/Autoloader.php");
$loader = new Autoloader();

//Here we're getting the portion after the index.php part in the request URI.
//If this portion is not set (that's ending on index.php or omision of index.php)
//this index is not defined.
$pathInfo = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : "";

/**
 * Create the Request instance and run it
 */
$REQ =& $loader->loadClass("Request", "lib", $pathInfo);

/**
 * Create the Modules instance and load module
 * @var \ScreenSaver\Lib\Modules $MOD
 */
$MOD =& $loader->loadClass("Modules", "lib");
$MOD->processRequest($REQ->getUriSegments());
