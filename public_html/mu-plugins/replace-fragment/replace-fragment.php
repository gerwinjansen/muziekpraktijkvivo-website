<?php
/**
 * @package autoplayqr
 * @version 1.0
 */
/*
Plugin Name: Replace Fragment
Plugin URI: http://localhost
Description: Replaces [[titelkey]] en [[youtubekey]] based on ?fragment=XXX
Author: Gerwin Jansen
Version: 1.1
Author URI: http://localhost
*/
add_filter( 'the_content', 'replaceFragment', 2 );

function replaceFragment($content)
{
	if (isset ( $_GET ['fragment'] )) {
		$nummer = intval ( $_GET ['fragment'] );
		
		$firstPathElementName = explode('/', $_SERVER['REQUEST_URI'])[1];
		
		$fragmenten = array_map('str_getcsv', file(dirname(__FILE__)."/$firstPathElementName.csv"));
		$titel = $fragmenten[$nummer][0];
		$youtube = $fragmenten[$nummer][1];
	
		$content = str_replace('[[titelkey]]', $titel, $content);
		return str_replace('[[youtubekey]]', $youtube, $content);
	}
	else
	{
		return $content;
	}
}

?>
