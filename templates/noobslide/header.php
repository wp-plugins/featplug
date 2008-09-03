<?php

/*  
	FeatPlug - http://featplug.huseyinuslu.net

	Featplug is free for non-commercial use. For commercial usage and redistribution with commercial packages
	check the plugins webpage http://featplug.huseyinuslu.net

	Huseyin Uslu < shalafirasitlin@gmail.com | http://www.huseyinuslu.net >
*/

?>
	<link rel="stylesheet" href="<?php echo $this->template_path; ?>/_web.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo $this->template_path; ?>/style.css" type="text/css" media="screen" />
	<script type="text/javascript" src="<?php echo $this->template_path; ?>/mootools-1.2-core.js"></script>
	<script type="text/javascript" src="<?php echo $this->template_path; ?>/_class.noobSlide.packed.js"></script>
	<script type="text/javascript">
	window.addEvent('domready',function(){
		var nS4 = new noobSlide({
			box: $('box4'),
			items: $$('#box4 div'),
			size: 480,
			handles: $$('#handles4 span'),
			onWalk: function(currentItem,currentHandle){
				$('info4').set('html',currentItem.getFirst().innerHTML);
				this.handles.removeClass('active');
				currentHandle.addClass('active');
			}
		});
	});
	</script>

<div id="cont">
<div class="sample">
	<div class="mask3">
		<div id="box4">

