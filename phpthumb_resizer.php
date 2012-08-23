<?php

function resize($width,$height,$img)
{
	$this->apps->load("PhpThumb/ThumbLib.inc");
	$img = UPLOADS.$img;
	
	try {
	    $thumb = PhpThumbFactory::create($img);
		$thumb->adaptiveResize($width,$height);
		$thumb->show();
	} catch(Exception $e) {
	    echo $e->getMessage();
	}
}