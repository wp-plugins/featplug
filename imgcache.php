<?php

/*  
	FeatPlug - http://www.featplug.com

	Featplug is free for non-commercial use. For commercial usage and redistribution with commercial packages
	check the plugins webpage http://featplug.huseyinuslu.net

	Huseyin Uslu < shalafirasitlin@gmail.com | http://www.regularsexpressions.com >
*/


	function check_cache()
	{

		// check if we got a cache directory
		$cache_dir = dirname(__FILE__) . "/cache";
		
		if (file_exists($cache_dir))
		{
			return True;
		}
		else 
		{
			if (@mkdir($cache_dir))
				return True;
			else 
				return False;
		}
	}


?>