<?php

/*  
	FeatPlug - http://www.featplug.com

	Featplug is free for non-commercial use. For commercial usage and redistribution with commercial packages
	check the plugins webpage http://featplug.huseyinuslu.net

	Huseyin Uslu < shalafirasitlin@gmail.com | http://www.regularsexpressions.com >
*/

?>

<?php
$instance=rand();

?>

<script src="<?php echo $this->template_path; ?>/scripts/mootools.v1.11.js" type="text/javascript"></script>
<script src="<?php echo $this->template_path; ?>/scripts/jd.gallery.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $this->template_path; ?>/css/jd.gallery.css" type="text/css" media="screen">

<style type="text/css">
#myGallery<?php echo $instance; ?> 
{ 
	width: <?php echo $this->output_width; ?>px !important; 
	height: <?php echo $this->output_height; ?>px !important; 
} 
</style>

<script type="text/javascript">
function startGallery() {
var myGallery = new gallery($('myGallery<?php echo $instance; ?>'), {
timed: true,delay: 5000
});
}
window.addEvent('domready', startGallery);
</script>
<div id="myGallery<?php echo $instance; ?>">
