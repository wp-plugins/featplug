<?

/*

WP-Post-Banners

Huseyin Uslu, < shalafirasitlin@gmail.com >
http://www.huseyinuslu.net


This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
Online: http://www.gnu.org/licenses/gpl.txt

*/



class engine
{
	// engine configuration
	private $layer;
	private $current_layer;

	private $VALID_CONFIGURATION;

	private $items;
	public $width;
	public $height;
	public $max_items;
	private static $pattern='/<\s*img [^\>]*src\s*=\s*[\""\']?([^\""\'\s>]*)/i';	// img pattern

	// options
	private $wpb_div_banner_style;
	private $wpb_tooltip_story_lenght;
	private $wpb_div_label_style;
	private $wpb_div_text_style;
	private $wpb_text_style;


	//
	// Constructor
	//
	function __construct($layer_type='')
	{

		$this->layer = array ("INVALID" => 0,"WORDPRESS" => 1,"STAND_ALONE" => 2);

		$this->VALID_CONFIGURATION=True;

		switch (trim($layer_type))
		{
			case "":
			// try to guess the layer
			if (function_exists('get_bloginfo'))
				$this->current_layer=$this->layer["WORDPRESS"];
			else
				$this->current_layer=$this->layer["STAND_ALONE"];
			break;
			case "WORDPRESS":
			$this->current_layer=$this->layer["WORDPRESS"];
			break;
			case "STAND_ALONE":
			$this->current_layer=$this->layer["STAND_ALONE"];
			break;
			default:
			$this->current_layer=$this->layer["INVALID"];
		}


		if($this->current_layer==$this->layer["INVALID"])
		{
			echo "[Configuration Error] It seems you have specified an invalid layer..\n";
			$this->VALID_CONFIGURATION=False;
		}
		else
		{
			$items=array();
			self::read_options();
		}
	}

	//
	// Destructor
	//
	function __destruct() {
		$items=null;
	}

	function script_path()
	{
		switch($this->current_layer)
		{
			case $this->layer["STAND_ALONE"];
			$path= "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
			break;
			case $this->layer["WORDPRESS"];
			$path= get_bloginfo('url') . "/wp-content/plugins/wp-post-banners";
			break;
		}

		return $path;
	}


	function add_item($i)
	{
		global $items;

		self::script_path();

		if($this->VALID_CONFIGURATION==True)
		{
			if(sizeof($items)<$this->max_items)
			{

				preg_match_all(self::$pattern,$i->img,$m);
				$found_images=sizeof($m[1]);
				for($k=0;$k<$found_images;$k++)
				{
					$img=trim($m[1][$k]);
					self::calc_image_dimensions($img,$this->width,$this->height,$nw,$nh);

					if($nw >= $this->width) // if image is suitable for our dimensions
					{
						$i->crop=$this->height;
						if($nh < $this->height)
						$i->crop=$nh;

						$i->calculated_height=$nh;
						$i->img=$img;
						$i->label=strip_tags($i->label);
						$i->content=substr(strip_tags($i->content),0,$this->wpb_tooltip_story_lenght);
						$i->content=str_replace("\"","'",$i->content);
						$items[]=$i;
						return;
					}

				}
			}

		}
	}

	function read_options()
	{
		if($this->current_layer==$this->layer["WORDPRESS"])
		{
			$this->wpb_div_banner_style=get_option("wpb_div_banner_style");
			$this->wpb_tooltip_story_lenght=get_option("wpb_tooltip_story_lenght");
			$this->wpb_div_label_style=get_option("wpb_div_label_style");
			$this->wpb_div_text_style=get_option("wpb_div_text_style");
			$this->wpb_text_style=get_option("wpb_text_style");
		}
		else
		{
			// default values;
			$this->wpb_tooltip_story_lenght=100;
		}
	}

	function render()
	{
		global $items;

		if($this->VALID_CONFIGURATION==True)
		{
			if($items<>NULL)
			{

				$html="<SCRIPT SRC='" . self::script_path(). "/scripts/boxover.js'></SCRIPT>\n";

				$this->wpb_div_banner_style=str_replace("{width}",$this->width ."px",$this->wpb_div_banner_style);

				foreach($items as $item)
				{
					$banner_style=str_replace("{height}",$item->crop."px",$this->wpb_div_banner_style);
					$html.="<div style='$banner_style'>\n";
					$html.= "<a href='". $item->link ."' border='0' title=\"header=[". $item->label . "]";

					if($item->content<>"")
					$html.= " body=[" . $item->content . "...]\">";
					else
					$html.= " body=[]\">";

					$html.= self::resize_img($item->img,$this->width,$item->calculated_height,$item->crop);
					$html.= "<div style='$this->wpb_div_label_style'> </div>";
					$html.= "<div style='$this->wpb_div_text_style'><p style='$this->wpb_text_style'>$item->label</p></div>";
					$html.= "</a></div>";
				}

				$items = NULL;
				return $html;
			}
			else
			{
				echo "No suitable images found for rendering\n";
			}
		}
	}

	function render_slideshow()
	{
		global $items;
		if($this->VALID_CONFIGURATION==True)
		{
			if($items<>NULL)
			{

				$_width=$this->width . "px";
				$_height=$this->height . "px";
				$html ="<script src=\"" . self::script_path(). "/scripts/mootools.v1.11.js\" type=\"text/javascript\"></script>\n";
				$html.="<script src=\"" . self::script_path(). "/scripts/jd.gallery.js\" type=\"text/javascript\"></script>\n";
				$html.="<link rel=\"stylesheet\" href=\"" . self::script_path(). "/css/jd.gallery.css\" type=\"text/css\" media=\"screen\" />\n";
				$html.="<style type=\"text/css\">#myGallery { width: $_width !important; height: $_height !important; } </style>\n";


				$html.="<script type=\"text/javascript\">\n";
				$html.="function startGallery() {\n";
				$html.="var myGallery = new gallery($('myGallery'), {\n";
				$html.="timed: true,delay: 5000\n";
				$html.="});\n";
				$html.="}\n";
				$html.="window.addEvent('domready', startGallery);\n";
				$html.="</script>\n";


				$html.="<div id=\"myGallery\">";
				foreach($items as $item)
				{
					$html.="<div class=\"imageElement\" style=\"display:none;\">\n";
					$html.="<h3>$item->label</h3>";
					$html.="<p>$item->content</p>";
					$html.="<a href=\"$item->link\" title=\"open story\" class=\"open\"></a>";
					$html.=self::resize_img($item->img,$this->width,$item->calculated_height,$item->crop,'class="full"');
					$html.="<img src=\"" . self::script_path(). "/resize.php?src=$item->img&w=75&h=75&crop=75\" class=\"thumbnail\" />";
					$html.="</div>\n";

				}
				$html.="</div>\n";



				$items=NULL;
				return $html;
			}
			else
			{
				echo "No suitable images found for rendering\n";
			}
		}
	}


	function resize_img($img,$w,$h,$crop,$class='')
	{
		$code = "<img src='" . self::script_path() . "/resize.php?";
		$code.= "src={$img}&w={$w}&h={$h}&crop={$crop}' width='{$w}' height='{$crop}'";
		$code.= " " .$class . " ";
		$code.=" />";

		return $code;
	}

	function calc_image_dimensions($src,$mw='',$max_height,&$w,&$h)
	{
		$mh='';
		if(list($w,$h) = @getimagesize($src)) {
			foreach(array('w','h') as $v) { $m = "m{$v}";
			if(${$v} > ${$m} && ${$m}) { $o = ($v == 'w') ? 'h' : 'w';
			$r = ${$m} / ${$v}; ${$v} = ${$m}; ${$o} = ceil(${$o} * $r); } }
			}
		}


		function debug()
		{
			global $items;
			print_r($items);
		}
	}

	class post_item {
		public $img;
		public $content;
		public $link;
		public $label;
		public $calculated_height;
		public $crop;
	}

	?>