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
			
 	 function __construct() 
	 {
      $items=array();
      self::read_options();
   }
   
   function __destruct() {
   		$items=null;
    }

	function add_item($i)
	{
		global $items;
		
		if(sizeof($items)<$this->max_items)
		{
		
		preg_match(self::$pattern,$i->img,$m);
		$img=trim($m[1]);
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
		
	 }
	 }
		
	}
	
	function read_options()
	{
		
		$this->wpb_div_banner_style=get_option("wpb_div_banner_style");
		$this->wpb_tooltip_story_lenght=get_option("wpb_tooltip_story_lenght");
		$this->wpb_div_label_style=get_option("wpb_div_label_style");
		$this->wpb_div_text_style=get_option("wpb_div_text_style");
		$this->wpb_text_style=get_option("wpb_text_style");
	}
		
	function render()
	{
		global $items;
		
		if($items<>NULL)
		{
		
			$html="<SCRIPT SRC='" . get_bloginfo('url') . "/wp-content/plugins/wp-post-banners/boxover.js'></SCRIPT>\n";
		
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
			echo "No suitable banners rendered\n";
		}
	
	}
	
function resize_img($img,$w,$h,$crop)
{
	$code = "<img src='" . get_bloginfo('url') . "/wp-content/plugins/wp-post-banners/resize.php?";
	$code.= "src={$img}&w={$w}&h={$h}&crop={$crop}' width='{$w}' height='{$crop}' />";
	
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