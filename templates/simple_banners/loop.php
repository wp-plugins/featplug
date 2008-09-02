<div style="position: relative; overflow: hidden; width: <?php echo $item->width; ?>px ; height: <?php echo $item->crop; ?>px ; border: solid 5px;">
					
<a href="<?php echo $item->link;?>" border="0" title="header=[<?php echo $item->label;?>] body=[<?php echo $item->content;?>..]">
<img src="<?php echo $item->image;?>" width="<?php echo $item->width;?>" height="<?php echo $item->crop;?>" border="0">
<div style="position: relative; top: -60px; height: 50px; background-color: black; filter:alpha(opacity=60); -moz-opacity: 0.6; opacity: 0.6;"></div>
<div style="position: relative; top: -100px; height: 50px;"><p style="font-weight:bold;font-family:tahoma, verdana, arial, sans-serif;font-variant:small-caps;text-align:right;color:#d0d955;font-size:16px;">
<?php echo $item->label;?>
</p>
</div>
</a>
</div>
