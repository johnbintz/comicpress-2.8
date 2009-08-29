<?php get_header();  ?>

<?php if (is_cp_theme_style('gn,v3c')) get_sidebar('left'); ?>

<?php if (is_cp_theme_style('v3c,v')) { ?>
	<div id="content" class="narrowcolumn">
		<div class="column">
<?php } ?>

<?php if (is_cp_theme_style('gn')) { ?>
	<div id="pagewrap-right">
<?php } ?>

<?php if (!(is_paged())) { ?>

<?php if ($disable_comic_frontpage != 'yes') { ?>

	<?php $wp_query ->in_the_loop = true; $comicFrontpage = new WP_Query(); $comicFrontpage->query('showposts=1&cat='.get_all_comic_categories_as_cat_string());
	while ($comicFrontpage->have_posts()) : $comicFrontpage->the_post() ?>		

		<div id="comic-head"><?php get_sidebar('over'); ?></div>
		<div id="comic">
			<div class="comic-left"><?php get_sidebar('comicleft'); ?></div>
			<div class="comic-content">
				<?php display_comic(); ?>
			</div>
			<div class="comic-right"><?php get_sidebar('comicright'); ?></div>
			<div class="clear"></div>
		</div>
		<div id="comic-foot"><?php get_sidebar('under'); ?></div>
	<?php endwhile; ?>
	
<?php } ?>

	<?php if (is_cp_theme_style('3c,standard')) { ?>
	<div id="content-wrapper">
	<?php } ?>
	<?php get_sidebar('overblog'); ?>
	<?php if (is_cp_theme_style('3c')) get_sidebar('left'); ?>

	<?php if (is_cp_theme_style('gn,standard,3c')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">
	<?php } ?>

	<?php if ($disable_comic_frontpage != 'yes' && $disable_comic_blog_frontpage != 'yes') { 
		while ($comicFrontpage->have_posts()) : $comicFrontpage->the_post();
			
			display_comic_post();
		
		endwhile; ?>

		<div id="blogheader"><!-- This area can be used for a heading above your main page blog posts --></div>

	<?php } 
		if (function_exists('the_project_wonderful_ad')) { ?>
			<div class="blogpwad">
				<center>
				<?php the_project_wonderful_ad('blog'); ?>
				</center>
			</div>
		<?php } ?>
		
		<?php get_sidebar('blog'); ?>
<?php } else { ?>

	<?php if (is_cp_theme_style('3c,standard')) { ?>
	<div id="content-wrapper">
	<?php } ?>
	<?php get_sidebar('overblog'); ?>
	<?php if (is_cp_theme_style('3c')) get_sidebar('left'); ?>

	<?php if (is_cp_theme_style('gn,standard,3c')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">
	<?php } 
} 

if ($disable_blog_frontpage != 'yes') { 
	if (have_posts()) {
		global $blog_postcount;
		$blog_query = 'showposts='.$blog_postcount.'&cat=-"'.exclude_comic_categories().'"&paged='.$paged; 
		
		$posts = query_posts($blog_query);
		while (have_posts()) : the_post();
			
			display_blog_post();	
		
		endwhile;
		
		comicpress_pagination();
	} 
} ?>

		<?php get_sidebar('underblog'); ?>
		</div>
</div>

<?php 
if (is_cp_theme_style('3c,v3c,gn,standard,v')) { 
	get_sidebar('right'); ?>
<?php } ?>

<?php if (is_cp_theme_style('standard,gn,3c')) { ?>
	<div class="clear"></div>
</div> <!-- end pageright-wrapper / content-wrapper -->
<?php } ?>	
<?php get_footer() ?>