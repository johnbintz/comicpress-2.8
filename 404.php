<?php get_header(); ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>
	
<div class="<?php comicpress_post_class(); ?>">
	<div class="post-page-head"></div>
	<div class="post-page">
		<h2 class="pagetitle"><?php _e('Page Not Found','comicpress'); ?></h2>
		<p><a href="<?php bloginfo('wpurl') ?>"><?php _e('Click here to return to the home page','comicpress'); ?></a> <?php _e('or try a search:','comicpress'); ?></p>
		<p><?php include (get_template_directory() . '/searchform.php') ?></p>
	</div>
	<div class="post-page-foot"></div>
</div>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>