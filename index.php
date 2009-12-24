<?php get_header(); ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>

<?php if (!$comicpress_options['disable_comic_frontpage'] && !$comicpress_options['disable_comic_blog_frontpage'] && !is_paged() )  {
	Protect();
	$comic_query = '&showposts=1&cat='.get_all_comic_categories_as_cat_string();
	$posts = query_posts($comic_query);
	$wp_query->is_archive = false;
	if (have_posts()) {
		while (have_posts()) : the_post();
			comicpress_display_post();
			comments_template();
		endwhile; 
	}
	Restore(); 
	UnProtect(); ?>
<?php } ?>

	<?php if (function_exists('the_project_wonderful_ad')) { 
		the_project_wonderful_ad('blog');
	} ?>

	<?php get_sidebar('blog'); ?>

<?php if (!$comicpress_options['disable_blogheader']) { ?>
	<div id="blogheader"><!-- This area can be used for a heading above your main page blog posts --></div>
<?php } ?>

<?php if (!$comicpress_options[disable_blog_frontpage]) {
	global $blog_postcount; 
	Protect();
		if (!$comicpress_options['split_column_in_two']) {
			$blog_query = 'showposts='.$blog_postcount.'&cat="-'.exclude_comic_categories().'"&paged='.$paged;

			$posts = query_posts($blog_query);
			if (have_posts()) { ?>
			<div class="blogindex-head"></div>
			<div class="blogindex">
				<?php while (have_posts()) : the_post();

					comicpress_display_post();

			endwhile; ?>
			</div>
			<div class="blogindex-foot"></div>
			<?php }
			comicpress_pagination();
	} else {
		comicpress_dual_columns();
	}
	Restore();
	UnProtect();
} ?>

<?php get_sidebar('underblog'); ?>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>
