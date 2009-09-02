<?php
/**
 * Body Classes
 * function function comicpress_body_class
 * 
 * This has two functions, the first being it adds the browser type as a class
 * in the <body> tag where you can then do .ie #page and do things specific
 * for each browser type as well as a few other classes that the normal body_class
 * does not yet support.
 * 
 * The second is you can write code specific for a particular browser.
 * 
 * example:  if (reset(browser_body_class()) == 'ie') {
 * 
 * the reset() portion resets the array to a string.
 * 
 */

add_filter('body_class','comicpress_body_class');

function comicpress_body_class($classes = '') {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone, $post, $wp_query;
	
	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	else $classes[] = 'unknown';
	if($is_iphone) $classes[] = 'iphone';

// Hijacked from the hybrid theme, http://themehybrid.com/
	if (is_single()) {
		foreach ( (array)get_the_category( $wp_query->post->ID ) as $cat ) :
			$classes[] = 'single-category-' . sanitize_html_class( $cat->slug, $cat->term_id );
		endforeach;
		
		$classes[] = 'single-author-' . get_the_author_meta( 'user_nicename', $wp_query->post->post_author );

	}

	if ( is_sticky( $wp_query->post->ID ) ) {
		$classes[] = 'single-sticky';
	}

	if ( is_attachment() ) {
		$classes[] = 'attachment attachment-' . $wp_query->post->ID;
		$mime_type = explode( '/', get_post_mime_type() );
		foreach ( $mime_type as $type ) :
			$classes[] = 'attachment-' . $type;
		endforeach;
	}
	
	return $classes;
}

?>