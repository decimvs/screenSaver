<?php
namespace ScreenSaver\Lib;

class Autoloader
{
	public function &loadClass($classname, $folder="lib", $params=NULL)
	{
		static $loadedClasses = array();
		
		if($folder == "lib")
		{
			$myNamespace = 'ScreenSaver\\Lib\\';
		}
		
		if(!isset($loadedClasses[$classname]))
		{
			$file = BASEPATH.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$classname.".php";
		
			if(!empty($file) && file_exists($file))
			{
				require_once $file;
				
				$class = $myNamespace.$classname;
			
				if($params != NULL)
				{
					$loaded = new $class($params);
				}
				else 
				{
					$loaded = new $class();
				}
				
				$loadedClasses[$classname] = $loaded;
				
				return $loadedClasses[$classname];
			}
			else 
			{
				throw new \Exception("Error: class couldn't be loaded ");
			}
		}
		else
		{
			return $loadedClasses[$classname];
		}
	}
}