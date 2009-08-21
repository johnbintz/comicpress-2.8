<?php
/**
 * User Pages
 * Allows view of user profiles for each user including admins/
 * 
 * Fun stuff.
 */

// add_action('init','cp_rewrite_user_to_author');
/*
function cp_rewrite_author_to_user() {
	global $wp_rewrite;
	$wp_rewrite->author_base = 'user';
	$wp_rewrite->flush_rules();
}

function cp_rewrite_user_to_author() {
	global $wp_rewrite;
	$wp_rewrite->author_base = 'author';
	$wp_rewrite->init();
	$wp_rewrite->flush_rules();
}

function cp_theme_switch() {
	global $wp_rewrite;
	if ($wp_rewrite->author_base != 'user') {
		add_action('init','cp_rewrite_author_to_user',1);
	} else {
		add_action('init','cp_rewrite_user_to_author',1);
	}
}
*/

// Flush the rules if someone switchs the theme.
add_action('switch_themes', array(&$GLOBALS['wp_rewrite'], 'init') );

/*
add_action('init','cp_reset_rules');

function cp_reset_rules() {
	global $wp_rewrite;
	$wp_rewrite->init();
	$wp_rewrite->flush_rules();
}
*/
?>