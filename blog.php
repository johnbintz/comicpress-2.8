<?php
/*
Template Name: Blog
*/
?>
<?php get_header();  ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>
	
	<?php global $blog_postcount;
	if ($split_column_in_two != 'yes') {
		$blog_query = 'showposts='.$blog_postcount.'&cat="-'.exclude_comic_categories().'"&paged='.$paged; 
		
		$posts = query_posts($blog_query);
		if (have_posts()) {
			
			while (have_posts()) : the_post();
				
				display_blog_post();	
			
			endwhile;
			
		}
		comicpress_pagination();
	} else {
		comicpress_dual_columns();
	} ?>
<?php get_sidebar('underblog'); ?>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>