<?php

if ( ! defined( 'ABSPATH' ) ) {
        exit;
}


header( 'Access-Control-Allow-Origin: *' );
header( 'Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE' );
header( 'Access-Control-Allow-Credentials: true' );
//header('content-type: application/json; charset=utf-8');
header( "Content-Type: application/javascript; charset=utf-8" );


include_once("functions.php");

//header( "Content-Type: application/javascript" );
//header("Content-Type: text/javascript");

$meta = get_post_meta( get_the_ID() ); //print_r($meta); 


$tracks = array();
$playlist = array();
$params = array();


$_title = maybe_unserialize(base64_decode($_title));
$_artist = maybe_unserialize(base64_decode($_artist));
$_song = maybe_unserialize(base64_decode($_song));
$_artwork = maybe_unserialize(base64_decode($_artwork));

$ccc = count($_title);

for($kk=0;$kk<$ccc;$kk++)
{
	if($_title[$kk]!="" && $_song[$kk]!="")	
	$tracks[] = array("index" => $kk, "title" => (string)MP3Title(wp_unslash($_title[$kk])), "artist" => (string)wp_unslash($_artist[$kk]), "source" => (string)wp_unslash($_song[$kk]), "artwork" => (string)wp_unslash($_artwork[$kk]), "download" => $download);
}	
	
$playlist = array("title" => get_the_title(), "tracks" => $tracks);
	
$param = array('id' => get_the_ID(), "sourcetype" => $sourcetype, "playlist" => $playlist, "params" => $params);	


echo  'processLast('.json_encode($param).')';




?>