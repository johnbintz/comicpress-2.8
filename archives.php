<?php
/*
Template Name: Archives
*/
?>
<?php get_header();  ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>

<?php 
if (have_posts()) {
	while (have_posts()) : the_post();
		comicpress_display_post();
	endwhile; 
}
?>

<div class="<?php comicpress_post_class(); ?>">
	<div class="post-page-head"></div>
	<div class="post-page">
		<div id="archivepage">
			<h2><?php _e('Archives by Month:','comicpress'); ?></h2>
			<ul><?php wp_get_archives('type=monthly') ?></ul>
		</div>
		<br class="clear-margins" />
	</div>
	<div class="post-page-foot"></div>
</div>

<div class="<?php comicpress_post_class(); ?>">
	<div class="post-page-head"></div>
	<div class="post-page">
		<div id="archivepage">
			<h2><?php _e('Archives by Subject:','comicpress'); ?></h2>
			<ul><?php wp_list_categories() ?></ul>
		</div>
		<br class="clear-margins" />
	</div>
	<div class="post-page-foot"></div>
</div>

<?php if ('open' == $post->comment_status) { comments_template('', true); } ?>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>