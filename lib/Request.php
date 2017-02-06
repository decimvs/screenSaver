<?php
namespace ScreenSaver\Lib;

class Request
{
	private $uriSegments;
	
	public function __contruct($pathInfo)
	{
		$this->uriSegments = explode("/", $pathInfo);
		$uriSegments = $this->uriSegments;
		
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
	}
	
	public function getUriSegments()
	{
		return $this->uriSegments;
	}
}