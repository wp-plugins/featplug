<?php 

/*  
	FeatPlug - http://www.featplug.com

	Featplug is free for non-commercial use. For commercial usage and redistribution with commercial packages
	check the plugins webpage http://featplug.huseyinuslu.net

	Huseyin Uslu < shalafirasitlin@gmail.com | http://www.regularsexpressions.com >
*/



	include '../engine.php'; 

	// featplug demo
	$e=new engine();
	$e->layer("STAND_ALONE");
	$e->set_output_dimensions(400,150);


	$p=new post_item();
	$p->img="<img src=\"" . $e->path() . "/examples/images/featplug.png\">";
	$p->label="featplug";
	$e->add_item($p);

	$p=new post_item();
	$p->img="<img src=\"" . $e->path() . "/examples/images/featplug2.png\">";
	$p->label="Story Mining";
	$e->add_item($p);

	$p=new post_item();
	$p->img="<img src=\"" . $e->path() . "/examples/images/featplug3.png\">";
	$p->label="Integration";
	$e->add_item($p);

	$p=new post_item();
	$p->img="<img src=\"" . $e->path() . "/examples/images/featplug4.png\">";
	$p->label="Theme Support";
	$e->add_item($p);

	$p=new post_item();
	$p->img="<img src=\"" . $e->path() . "/examples/images/featplug5.png\">";
	$p->label="Plug-in now!";
	$e->add_item($p);



	$e->set_template("smoothgallery");
	echo $e->render();
	$e=null;

?>