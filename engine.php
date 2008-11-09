<?php

/*  
	FeatPlug - http://www.featplug.com

	Featplug is free for non-commercial use. For commercial usage and redistribution with commercial packages
	check the plugins webpage http://featplug.huseyinuslu.net

	Huseyin Uslu < shalafirasitlin@gmail.com | http://www.regularsexpressions.com >
*/



include_once 'imgcache.php'; 


class engine
{
	// configuration
	var $VALID_CONFIGURATION;

	// input layer
	var $layers;
	var $current_layer;

	// template
	var $template_header;
	var $template_loop;
	var $template_footer;
	var $template_path;

	// output dimensions
	var $output_width;
	var $output_height;
	var $dimensions_set=False;
	var $image_enlarge_enabled=True;

	var $thumbnail_width=50;
	var $thumbnail_height=50;
	
	var $max_items=10;
	var $story_lenght=100;

	var $enable_text_stories=False;

	// items
	var $items=array();


	function layer($layer_type='')
	{

		$this->layers = array ("INVALID" => 0,"WORDPRESS" => 1,"STAND_ALONE" => 2);

		$this->VALID_CONFIGURATION=True;

		switch (trim($layer_type))
		{
			case "":
			// try to guess the layer
			if (function_exists('get_bloginfo'))
				$this->current_layer=$this->layers["WORDPRESS"];
			else
				$this->current_layer=$this->layers["STAND_ALONE"];
			break;
			case "WORDPRESS":
			$this->current_layer=$this->layers["WORDPRESS"];
			break;
			case "STAND_ALONE":
			$this->current_layer=$this->layers["STAND_ALONE"];
			break;
			default:
			$this->current_layer=$this->layers["INVALID"];
		}


		if($this->current_layer==$this->layers["INVALID"])
		{
			echo "[Configuration Error] It seems you have specified an invalid layer..\n";
			$this->VALID_CONFIGURATION=False;
		}
		else
		{
			$curr_template='';
		}
	}

	function __destruct() {
		unset($this->items);
		$this->items=null;
	}
	
	function destruct() {
		engine::__destruct();
	}

	function path()
	{
		switch($this->current_layer)
		{
			case $this->layers["STAND_ALONE"];
				$path=str_replace('\\','/',__FILE__);
				$path=dirname(str_replace($_SERVER['DOCUMENT_ROOT'],'',$path));
				$path= "http://" . $_SERVER['HTTP_HOST'] . $path;
				break;
			case $this->layers["WORDPRESS"];
				$path= get_bloginfo('url') . "/wp-content/plugins/featplug";
				break;
		}

		return $path;
	}


	function add_item($i)
	{
		$pattern='/<\s*img [^\>]*src\s*=\s*[\""\']?([^\""\'\s>]*)/i';

		if($this->VALID_CONFIGURATION==True) // if we got valid config
		{
			if(sizeof($this->items)<$this->max_items) // if we still need to find more content
			{
				preg_match_all($pattern,$i->img,$m);

				$found_images=sizeof($m[1]);
				for($k=0;$k<$found_images;$k++)
				{
					$img=trim($m[1][$k]);

					if($this->image_enlarge_enabled) // try to guess image from cache
						$cache_guess=engine::guess_image_from_cache($img,$nw,$nh);

					if($cache_guess)
							$img_broken=False; // if we found a matching file on cache, it means its not broken	
					else	
							$img_broken=engine::calc_image_dimensions($img,$this->output_width,$this->output_height,$nw,$nh);	

					if (!$img_broken) // if image link is not broken
					{	
						$i->crop=$this->output_height;
						if($nh < $this->output_height)
						$i->crop=$nh;

						$i->height=$nh;
						$i->width=$nw;
						$i->thumbnail=engine::resize_img($img,$this->thumbnail_width,$this->thumbnail_height,$this->thumbnail_height);

						$i->label=strip_tags($i->label);
						$i->content=substr(strip_tags($i->content),0,$this->story_lenght);
						$i->content=str_replace("\"","'",$i->content);					

						if ($nw >= $this->output_width)
						{
							$i->image=engine::resize_img($img,$this->output_width,$i->height,$i->crop);
							$this->items[]=$i;
							return;
						}
						else if ($this->image_enlarge_enabled)
						{
							$i->height=$this->output_height;
							$i->width=$this->output_width;
							$i->crop=$this->output_height;
							$i->image=engine::resize_img($img,$this->output_width,$i->height,$i->crop);
							$this->items[]=$i;
							return;
						}
					}

				}
				// if found no images
				if($this->enable_text_stories)
					engine::render_text_story($i->content);
			}
		}


	}
	
	function set_output_dimensions($width,$height)
	{
		$this->output_width=$width;
		$this->output_height=$height;
		$this->dimensions_set=True;		
	}

	function enable_image_enlarging($enabled)
	{
		$this->image_enlarge_enabled=$enabled;	
	}

	function set_thumbnail_dimensions($width,$height)
	{
		$this->thumbnail_width=$width;
		$this->thumbnail_height=$height;
	}

	function set_maximum_stories($max)
	{
		$this->max_items=$max;
	}

	function set_story_lenght($lenght)
	{
		$this->story_lenght=$lenght;
	}

	function enable_text_stories($enabled)
	{
		$this->enable_text_stories=$enabled;
	}

	function render()
	{
		if($this->VALID_CONFIGURATION==True)
		{
			if($this->items<>NULL)
			{
				include $this->template_header;
				foreach($this->items as $item)
				{
					include $this->template_loop;
				}
				include $this->template_footer;
			}
			else
			{
				echo "[Featplug Warning]: No suitable images found for given dimensions $this->output_width x $this->output_height - Image Enlarging Enabled: " . (int)$this->image_enlarge_enabled;

			}
		}
	}

	function render_text_story($data)
	{
		$words=explode(" ",$data);
		$cloud=array();
		
		foreach($words as $word)
		{
			$word= preg_replace('/\W/', '', $word); // strip punctuation
			$cloud[$word]=$cloud[$word]+1;
		}		

		$total_hits=0;

		engine::shuffle_with_keys($cloud);

		// find max
		$max=0;
		$max_font=6;

		foreach($cloud as $key => $val)
		{
			if($val > $cloud[$max])
				$max=$key;			
		}


		foreach($cloud as $key => $val)
		{
			$percent=($val * 100) / $cloud[$max];
			$font_size= (int) ($max_font * $percent) / 100;
			echo "<font size=\"$font_size\">$key</font> ";
		}
	}

	function shuffle_with_keys(&$array) 
	{
		$aux = array();
		$keys = array_keys($array);
		shuffle($keys);
		foreach($keys as $key) 
		{
			$aux[$key] = $array[$key];
			unset($array[$key]);
		}
		$array = $aux;
	} 

	function check_template($template)
	{
		$template_dir=dirname(__FILE__) . "/templates";
		$template_header = $template_dir . "/$template/header.php";
		$template_loop = $template_dir . "/$template/loop.php";
		$template_footer = $template_dir . "/$template/footer.php";


		if(! ( file_exists($template_header) && file_exists($template_loop) && file_exists($template_footer)) )
			return False;	

		return True;
	}


	function set_template($template)
	{
		$template_dir=dirname(__FILE__) . "/templates";
		
		if(engine::check_template($template))		
		{
			$this->template_header = $template_dir . "/$template/header.php";
			$this->template_loop = $template_dir . "/$template/loop.php";
			$this->template_footer = $template_dir . "/$template/footer.php";
			$this->template_path = engine::path() ."/templates/$template";
		}
		else
		{
			$this->VALID_CONFIGURATION=False;
			echo "[Featplug Warning]: Supplied template '$template' does not exists.<br>";
		}
	}

	function list_avaible_templates()
	{
		$templates=array();

		$template_dir=dirname(__FILE__) . "/templates";
		if ($dh = @opendir($template_dir))
    		{
		        while ($file = readdir($dh))
		        {
		            	if ($file != '.' && $file != '..') 
			 	{	
					if ( engine::check_template( $file ) )
						$templates[]=$file;
			        }
        		}
		}
	        closedir($dh);

		return $templates;
	}

	function resize_img($img,$w,$h,$crop)
	{

		$found_cache=false;
		if ( check_cache())
		{
			// try to read from cache
			$cache_file= "/cache/" . $w . "." . $h . "." . $crop . "." . basename($img);			
			if (file_exists(dirname(__FILE__) . $cache_file))
			{
				$code=engine::path() . $cache_file;
				$found_cache=true;
			}
		}

		if ($found_cache==false)
		{	
			$code = engine::path() . "/resize.php?src={$img}&w={$w}&h={$h}&crop={$crop}";
		}
		
		return $code;
	}

	function guess_image_from_cache($img,&$w,&$h)
	{

		$img=basename($img);
		$filename = dirname(__FILE__) . "/cache/";
		$filename.= $this->output_width  . ".";
		$filename.= $this->output_height . "."; 
		$filename.= $this->output_height . "."; 
		$filename.= $img;

		// test a exact width x height x crop match
		if(file_exists($filename))
		{
			$w=$this->output_width;
			$h=$this->output_height;
			return True;
		}

		// test a semi-exact match with width x height
		$filename = dirname(__FILE__) . "/cache/";
		$filename.= $this->output_width  . ".";
		$filename.= $this->output_height . "."; 
		$filename.= "*."; 
		$filename.= $img;

		foreach(glob($filename) as $f)
		{
			$f=basename($f);
			$parts=explode(".",$f);
			$w=$parts[0];	
			$h=$parts[1];
			return True;
			
		}

		// try match using width
		$f_pattern = dirname(__FILE__) . "/cache/*" . $img;
		foreach (glob($f_pattern) as $filename) 
		{
		    $filename=basename($filename);
		    $parts=explode(".",$filename);

		    // try a width match
		    if( $parts[0]==$this->output_width )
		    {
			$w=$parts[0];	
			$h=$parts[1];
			return True;
		    }

		}
		return False; // no matches.. :/
	}

	function calc_image_dimensions($src,$mw='',$max_height,&$w,&$h)
	{
		// check image with fsockopen to ensure we don't wait quite long
		$timeout = 3;
		$old = ini_set('default_socket_timeout', $timeout);
		$fp = @fopen($src, 'r');
		ini_set('default_socket_timeout', $old);

		if (!$fp) // timed out
			return False;
	
		$mh='';
		if(list($w,$h) = @getimagesize($src)) 
		{
			foreach(array('w','h') as $v) { $m = "m{$v}";
			if(${$v} > ${$m} && ${$m}) { $o = ($v == 'w') ? 'h' : 'w';
			$r = ${$m} / ${$v}; ${$v} = ${$m}; ${$o} = ceil(${$o} * $r); } }
			}

			if($w!='') // is image link broken?
				return False; // nope
			else
				return True; // yes image link is broken
		}
	}

	class post_item {

		var $label;
		var $link;
		var $content;

		var $image;
		var $height;
		var $width;
		var $crop;
		
		var $thumbnail;
	}

	?>
