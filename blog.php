<?php
/*
Template Name: Blog
*/
?>
<?php get_header(); ?>

<?php if (is_cp_theme_style('gn,v3c')) get_sidebar('left'); ?>

<?php if (is_cp_theme_style('v3c,v')) { ?>
	<div id="content" class="narrowcolumn">
		<div class="column">
<?php } ?>

<?php if (is_cp_theme_style('gn')) { ?>
	<div id="pagewrap-right">
<?php } ?>

	<?php if (is_cp_theme_style('3c,standard')) { ?>
	<div id="content-wrapper">
	<?php } ?>
	<?php get_sidebar('overblog'); ?>
	<?php if (is_cp_theme_style('3c')) get_sidebar('left'); ?>

	<?php if (is_cp_theme_style('gn,standard,3c')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">
	<?php } 
	
	if (have_posts()): 

		$blog_query = '&cat=-"'.exclude_comic_categories().'"&paged='.$paged; 
	
		$posts = query_posts($blog_query);
		while (have_posts()) : the_post();
		
			display_blog_post();			

			endwhile; ?>


			<?php if(function_exists('wp_pagenavi')) { ?>
				<div class="paginav">
					<?php wp_pagenavi(); ?>
				</div>
				<?php } else { ?>
				<div class="pagenav">
					  <div class="pagenav-right"><?php previous_posts_link('Newer Entries &uarr;') ?></div>
					  <div class="pagenav-left"><?php next_posts_link('&darr; Previous Entries') ?></div>
					<div class="clear"></div>
				</div>
			<?php } ?>
			<div class="clear"></div>
			
<?php endif; ?>
			<?php get_sidebar('underblog'); ?>

		</div>
</div>

<?php 
if (is_cp_theme_style('3c,v3c,gn,standard,v')) { 
	get_sidebar('right');
} ?>

<?php if (is_cp_theme_style('standard,gn,3c')) { ?>
	<div class="clear"></div>
</div> <!-- end pageright-wrapper / content-wrapper -->
<?php } ?>	

<?php get_footer() ?>