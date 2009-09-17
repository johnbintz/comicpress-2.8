<?php get_header(); ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>
	
	<?php get_sidebar('overblog'); ?>
	<?php if (is_cp_theme_layout('3c')) get_sidebar('left'); ?>

	<?php if (!is_cp_theme_layout('v3c,v')) { ?>
		<div id="content" class="narrowcolumn">
			<div class="column">	
	<?php } ?>
	
<div class="<?php comicpress_blogpost_class(); ?>">
	<div class="post-page-head"></div>
	<div class="post-page">
		<h2 class="pagetitle">Page Not Found</h2>
		<p><a href="<?php bloginfo('url') ?>">Click here to return to the home page</a> or try a search:</p>
		<p><?php include (get_template_directory() . '/searchform.php') ?></p>
		<br class="clear-margins" />
	</div>
	<div class="post-page-foot"></div>
</div>
		</div>
	</div>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>