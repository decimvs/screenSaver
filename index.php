<?php

define("BASEPATH", dirname(__FILE__));

define("MODULES_PATH", BASEPATH . DIRECTORY_SEPARATOR . "modules");

$pathInfo = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : "";

$uriSegments = explode("/", $pathInfo);

$className = "";

if(is_array($uriSegments) && count($uriSegments) > 0)
{
	if($uriSegments[0] == '')
	{
		array_shift($uriSegments);
	}
	
	if(count($uriSegments) > 0 && $uriSegments[count($uriSegments)-1] == '')
	{
		array_pop($uriSegments);
	}
}

if(count($uriSegments) > 0)
{
	$modulePath = MODULES_PATH . DIRECTORY_SEPARATOR . $uriSegments[0].'.php';
	
	if(file_exists($modulePath))
	{
		require($modulePath);
		
		$className = $uriSegments[0];
	}
	else 
	{
		/**
		 * @todo Afegir un mètode de gestió per al cas d'error per un modul inexistent
		 */
		throw new Exception("Module not available or inexistent");
	}
}
else 
{
	//Load default module
	require(MODULES_PATH . DIRECTORY_SEPARATOR . "home.php");
	
	$className = "home";
}

//header('Content-type: text/plain; charset=utf-8');

if($className != "")
{
	$MOD = new $className();
	
	if(isset($uriSegments[1]))
	{
		$action = $uriSegments[1];
		
		if(method_exists($MOD, $action))
		{
			$MOD->$action();
		}
		else
		{
			/**
			 * @todo Afegir un tractament per a esta excepció
			 */
			throw new Exception("Action not defined!");
		}
	}
	else
	{
		if(method_exists($MOD, "index"))
		{
			$MOD->index();
		}
		else
		{
			/**
			 * @todo Afegir un tractament per a esta excepció
			 */
			throw new Exception("Action not defined!");
		}
	}
}
else 
{
	/**
	 * @todo Afegir un tractament per a esta exepció
	 */
	throw new Exception("Error module name not set yet!");
}