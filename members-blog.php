<?php
/*
Template Name: Members Only Blog
*/
?>
<?php get_header(); global $members_post_category; ?>
<?php remove_filter('pre_get_posts','comicpress_members_filter'); ?>

<?php include(get_template_directory() . '/layout-head.php'); ?>
	
	<?php if (have_posts()): 
		
		$blog_query = '&cat='.$members_post_category.'&paged='.$paged; 
		
		$posts = query_posts($blog_query);
		while (have_posts()) : the_post();
			
			display_blog_post();			
		
		endwhile; 
		
		comicpress_pagination(); 
	
	endif; ?>
		<?php get_sidebar('underblog'); ?>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>
