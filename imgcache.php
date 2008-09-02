<?php

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