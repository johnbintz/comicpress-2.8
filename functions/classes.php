<?php
/**
 * Body Classes
 * function function comicpress_body_class
 * 
 * Author: Philip M. Hofer (Frumph)
 * Author URI: http://webcomicplanet.com/ http://frumph.net/
 * Version: 1.0.1
 * 
 * This function adds the browser type as a class
 * in the <body> tag where you can then do .ie #page and do things specific
 * for each browser type as well as a few other classes that the normal body_class
 * does not yet support.
 * 
 * 
 */

add_filter('body_class','comicpress_body_class');

function comicpress_body_class($classes = '') {
	global  $current_user, $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone, $post, $wp_query, $cp_theme_layout;
	
	if (!empty($current_user)) {
		$user_login = addslashes($current_user->user_login);
		$classes[] = 'user-'.$user_login;
	} else {
		$classes[] = 'user-guest';
	}
	
	if (is_single()) {
		if (in_comic_category()) {
			$classes[] = 'comiccat';
		} else {
			$classes[] = 'blogcat';
		}
	}
	
	if (function_exists('comicpress_is_member')) {
		if (comicpress_is_member()) {
			$classes[] = 'sitemember';
		} else {
			$classes[] = 'non-sitemember';
		}
	}
	
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
		$classes[] = 'sticky-post';
	}
	
// NOT hijacked from anything, doi! people should do this.
	$rightnow = date('gi');
	$ampm = date('a');
	$classes[] = $ampm;
	
	if ($ampm == 'am') {
		if ((int)$rightnow < 30) $classes[] = 'midnight';
		if ((int)$rightnow < 560) $classes[] = 'night';
		if ((int)$rightnow > 559 && (int)$rightnow < 1130) $classes[] = 'morning';
		if ((int)$rightnow > 1129) $classes[]='noon';
	} else {
		if ((int)$rightnow < 30) $classes[] = 'noon';
		if ((int)$rightnow < 559) $classes[] = 'day';
		if ((int)$rightnow > 559 && (int)$rightnow < 1130) $classes[] = 'evening';
		if ((int)$rightnow > 1129) $classes[]='midnight';
	}

	if ( is_attachment() ) {
		$classes[] = 'attachment attachment-' . $wp_query->post->ID;
		$mime_type = explode( '/', get_post_mime_type() );
		foreach ( $mime_type as $type ) :
			$classes[] = 'attachment-' . $type;
		endforeach;
	}
	
	$classes[] = 'layout-'.$cp_theme_layout;
	
	return $classes;
}

function comicpress_post_class($class = '') {
	global $post;
	static $post_alt;

	$args = array(
		'entry_tax' => array( 'category', 'post_tag' )
	);

	/* Microformats. */
	$classes[] = 'hentry';

	/* Post alt class. */
	$classes[] = 'post-' . ++$post_alt;

	if ( $post_alt % 2 )
		$classes[] = 'odd';
	else
		$classes[] = 'even alt';

	/* Sticky class (only on home/blog page). */
	if( is_sticky() && is_home() )
		$classes[] = 'sticky';

	/* Author class. */
	if ( !is_attachment() )
		$classes[] = 'post-author-' . sanitize_html_class( get_the_author_meta( 'user_nicename' ), get_the_author_meta( 'ID' ) );

	/* Password-protected posts. */
	if ( post_password_required() )
		$classes[] = 'protected';

	/* User-created classes. */
	if ( !empty( $class ) ) :
		if ( !is_array( $class ) )
			$class = preg_split( '#\s+#', $class );
		$classes = array_merge( $classes, $class );
	endif;

	/* Join all the classes into one string and echo them. */
	$class = join( ' ', $classes );

	echo apply_filters( 'comicpress_post_class', $class );
}

?>