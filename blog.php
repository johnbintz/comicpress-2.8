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
	} else { ?>
	<div id="dualcolumns">
		<div class="column_one">
			<div class="column_one_header"></div>
	<?php $blog_query = 'showposts='.$blog_postcount.'&cat="-'.exclude_comic_categories().'"&author='.$author_column_one.'&paged='.$paged; 
	$posts = query_posts($blog_query);
	if (have_posts()) {
		while (have_posts()) : the_post();
			display_blog_post();	
		endwhile;
			} ?>
			<span class="viewpostsbyone">View all posts by: <?php the_author_posts_link(); ?><span><br />
		</div>
		<div class="column_two">
			<div class="column_two_header"></div>
	<?php $blog_query = 'showposts='.$blog_postcount.'&cat="-'.exclude_comic_categories().'"&author='.$author_column_two; 
	$posts = query_posts($blog_query);
	if (have_posts()) {
		while (have_posts()) : the_post();
			display_blog_post();	
		endwhile;
			} ?>
			<span class="viewpostsbytwo">View all posts by: <?php the_author_posts_link(); ?></span><br />
		</div>
		<div class="clear"></div>
	</div>
	<?php } ?>
<?php get_sidebar('underblog'); ?>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>