<?php
/*
Template Name: Links
*/
?>
<?php get_header();  ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>

	<?php 
	$bookmarks = wp_list_bookmarks('echo=0');
	$bookmarks = preg_replace('#<li ([^>]*)>#', '<li>', $bookmarks);
	$bookmarks = preg_replace('#<ul ([^>]*)>#', '<ul>', $bookmarks);
	 ?>
	
	<?php while (have_posts()) : the_post() ?>
	<div class="<?php comicpress_post_class(); ?>">
		<div class="post-page-head"></div>
		<div class="post-page">
			<?php if (function_exists('the_post_image')) {
				if ( has_post_image() ) { ?>
					<div class="post-page-image">
					<?php the_post_image('full'); ?>
					</div>
				<?php } ?>
			<?php } ?>
			<?php if ($disable_page_titles != 'yes') { ?>
				<h2 class="pagetitle"><?php the_title() ?></h2>
			<?php } ?>
			<div id="linkspage">
			<ul>
				<?php echo $bookmarks; ?>
			</ul>
			</div>
			<div class="clear"></div>
		</div>
		<div class="post-page-foot"></div>
	</div>
	<?php endwhile; ?>
	
<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>
