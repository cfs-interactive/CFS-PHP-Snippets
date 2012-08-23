<?php

// Methods for pulling Facebook albums and photos

function albums()
{		
	try
	{
		$album_data = $this->facebook->api('/me/albums');
	} 
	catch(FacebookApiException $e)
	{
		$album_data = "";
	}
	
	$data['albums'] = array();
	
	if( is_array($album_data) && !empty($album_data['data']) ){
		foreach($album_data['data'] as $album){
			$temp = array('aid'=>$album['id'],'name'=>$album['name']);
			array_push($data['albums'],$temp);
		}
	}
	
	$album_viewer = $this->load->view("modals/photo_album",$data,TRUE);
	echo $album_viewer;
}

function photos($aid)
{	
	$params['fields'] = 'name,source,images,picture';
    $params = http_build_query($params,null,'&');
	
	try
	{
    	$album_photos = $this->facebook->api("/{$aid}/photos?$params");
	} 
	catch(FacebookApiException $e)
	{
    	$album_photos = "";
    }
	
	$data['photos'] = array();
    
    if( is_array($album_photos) && !empty($album_photos['data']) ) {
        foreach($album_photos['data'] as $photo) {
            $pid = $photo['id'];
			$thumb = $photo['picture'];
            
            $fbsrc = $photo['images'][1]['source'];
            $fbsrc = str_replace('https', 'http', $fbsrc);
            
            $source = base_url()."ajax/gallery/".base64_encode($fbsrc);
			$temp = array('pid'=>$pid,'thumb'=>$thumb,'source'=>$source);
			array_push($data['photos'],$temp);
        }
    }
	
	$photo_set = $this->load->view("modals/photo_set",$data,TRUE);
	echo $photo_set;
}