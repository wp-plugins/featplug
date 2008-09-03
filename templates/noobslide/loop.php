<?php

/*  
	FeatPlug - http://featplug.huseyinuslu.net

	Featplug is free for non-commercial use. For commercial usage and redistribution with commercial packages
	check the plugins webpage http://featplug.huseyinuslu.net

	Huseyin Uslu < shalafirasitlin@gmail.com | http://www.huseyinuslu.net >
*/

?>

<div>
	<?php $item_count+=1;?>
	<h3><?php echo $item->label;?></h3>
	<img src="<?php echo $item->thumbnail;?>" alt="Photo" />
	<p><?php echo $item->content;?></p>
</div>