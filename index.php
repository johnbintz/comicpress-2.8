<?php get_header();  ?>

<div id="content-wrapper-top"></div>
	<div id="content-wrapper">

	<?php if (is_cp_theme_layout('gn,v3c')) get_sidebar('left'); ?>

	<?php if (is_cp_theme_layout('gn,rgn')) { ?>
		<div id="pagewrap-right">
	<?php } ?>

	<?php if (is_cp_theme_layout('v3c,v')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">	
	<?php } ?>
	
<?php if (!(is_paged())) { ?>

	<?php if ($disable_comic_frontpage != 'yes') { ?>

		<?php $wp_query ->in_the_loop = true; $comicFrontpage = new WP_Query(); $comicFrontpage->query('showposts=1&cat='.get_all_comic_categories_as_cat_string());
		while ($comicFrontpage->have_posts()) : $comicFrontpage->the_post() ?>	
			<?php if (comicpress_check_themepack_file('displaycomic.php') == false) { ?>
				<div id="comic-head"><?php get_sidebar('over'); ?></div>
				<div class="clear"></div>
				<?php get_sidebar('comicleft'); ?>
				<div id="comic"><?php display_comic(); ?></div>
				<?php get_sidebar('comicright'); ?>
				<div class="clear"></div>
				<div id="comic-foot"><?php get_sidebar('under'); ?></div>
			<?php } ?>
		<?php endwhile; ?>
		
	<?php } ?>

<?php if (is_cp_theme_layout('3c,v')) {  ?>
<div id="subcontent-wrapper-head"></div>
	<div id="subcontent-wrapper">
<?php } ?>

	<?php get_sidebar('overblog'); ?>
	<?php if (is_cp_theme_layout('3c,rgn')) get_sidebar('left'); ?>

	<?php if (!is_cp_theme_layout('v3c,v')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">	
	<?php } ?>

	<?php if ($disable_comic_frontpage != 'yes' && $disable_comic_blog_frontpage != 'yes') { 
		while ($comicFrontpage->have_posts()) : $comicFrontpage->the_post();
			
			display_comic_post();
		
		endwhile; ?>

		<div id="blogheader"><!-- This area can be used for a heading above your main page blog posts --></div>

	<?php } 
	
} else { ?>

<?php if (is_cp_theme_layout('3c,v')) {  ?>
<div id="subcontent-wrapper-head"></div>
	<div id="subcontent-wrapper">
<?php } ?>

	<?php get_sidebar('overblog'); ?>
	<?php if (is_cp_theme_layout('3c,rgn')) get_sidebar('left'); ?>

	<?php if (!is_cp_theme_layout('v3c,v')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">	
	<?php } ?>
<?php } ?>
	<?php if (function_exists('the_project_wonderful_ad')) { ?>
			<div class="blogpwad">
				<center>
				<?php the_project_wonderful_ad('blog'); ?>
				</center>
			</div>
	<?php }
	
	get_sidebar('blog');

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

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>