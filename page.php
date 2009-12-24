<?php get_header();  ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>

<?php while (have_posts()) : the_post() ?>

	<?php comicpress_display_post(); ?>

<?php endwhile; ?>

<?php if ('open' == $post->comment_status) { comments_template('', true); } ?>
	
<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>
