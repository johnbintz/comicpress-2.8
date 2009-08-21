<?php
/**
 * Check Browser
 * function browser_body_class
 * 
 * This has two functions, the first being it adds the browser type as a class
 * in the <body> tag where you can then do .ie #page and do things specific
 * for each browser type.
 * 
 * The second is you can write code specific for a particular browser.
 * 
 * example:  if (reset(browser_body_class()) == 'ie') {
 * 
 * the reset() portion resets the array to a string.
 * 
 */

add_filter('body_class','browser_body_class');

function browser_body_class($classes = '') {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	
	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	else $classes[] = 'unknown';
	
	if($is_iphone) $classes[] = 'iphone';
	return $classes;
}


?>