<?php
/*
Template Name: Archives
*/
?>
<?php get_header();  ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>
	
		<div class="<?php comicpress_post_class(); ?>">
			<div class="post-page-head"></div>
			<div class="post-page">
				<div id="archivepage">
			<?php if (function_exists('the_post_image')) {
				if ( has_post_image() ) { ?>
					<div class="post-page-image">
					<?php the_post_image('full'); ?>
					</div>
				<?php } else { ?>
					<h2 class="pagetitle"><?php the_title() ?></h2>
				<?php } ?>
			<?php } else { ?>
				<h2 class="pagetitle"><?php the_title() ?></h2>
			<?php } ?>
			<br class="clear-margins" />
					<ul><?php wp_get_archives('type=monthly') ?></ul>
					<h2><?php _e('Archives by Subject:','comicpress'); ?></h2>
					<ul><?php wp_list_categories() ?></ul>
				</div>
				<div class="clear"></div>
			</div>
			<div class="post-page-foot"></div>
		</div>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>