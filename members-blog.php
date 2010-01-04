<?php
/*
Template Name: Members Only Blog
*/
get_header(); 
global $comicpress_options;
remove_filter('pre_get_posts','comicpress_members_filter');
include(get_template_directory() . '/layout-head.php'); 

if ($comicpress_options['enable_members_only']) {
	if ($comicpress_options['members_post_category'] && comicpress_is_member()) {
		$blog_query = 'showposts='.$comicpress_options['blog_postcount'].'&cat='.$comicpress_options['members_post_category'].'&paged='.$paged; 
		
		$posts = query_posts($blog_query);
		if (have_posts()) {
			
			while (have_posts()) : the_post();
				
				comicpress_display_post();	
			
			endwhile;
			
		}
		comicpress_pagination();
	} else {
		_e("This page is restricted to members only.",'comicpress');
	}
} else {
	_e('Member\'s Only content is not enabled on this installation.');
}
	
get_sidebar('underblog');

include(get_template_directory() . '/layout-foot.php');

get_footer() ?>
