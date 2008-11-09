<?php

/*  
	FeatPlug - http://www.featplug.com

	Featplug is free for non-commercial use. For commercial usage and redistribution with commercial packages
	check the plugins webpage http://featplug.huseyinuslu.net

	Huseyin Uslu < shalafirasitlin@gmail.com | http://www.regularsexpressions.com >
*/

?>

<div class="imageElement" style="display:none;">
	<h3><?php echo $item->label; ?></h3>
	<p>
		<?php echo $item->content; ?>
	</p>
	<a href="<?php echo $item->link; ?>" title="open story" class="open"></a>
	<img src="<?php echo $item->image; ?>" width="<?php echo $item->width; ?>" height="<?php echo $item->crop; ?>" class="full" alt="<?php echo $item->label; ?>">
	<img src="<?php echo $item->thumbnail; ?>" class="thumbnail" alt="<?php echo $item->label; ?>">
</div>