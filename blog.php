<?php
/*
Template Name: Blog
*/
?>
<?php get_header();  ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>
	
	<?php if (have_posts()): 

		$blog_query = '&cat=-"'.exclude_comic_categories().'"&paged='.$paged; 
	
		$posts = query_posts($blog_query);
		while (have_posts()) : the_post();
		
			display_blog_post();			

			endwhile; 
			
			comicpress_pagination(); 
			
	endif; ?>
		<?php get_sidebar('underblog'); ?>
		</div>
	</div>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>