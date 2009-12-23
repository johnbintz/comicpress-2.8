<?php
/*
Template Name: Links
*/
?>
<?php get_header();  ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>

<?php 
if (have_posts()) {
	while (have_posts()) : the_post();
		comicpress_display_page_post();
	endwhile; 
}
?>

<?php 
$linkcatid = get_term_by('name','menubar','link_category');
$linkcatid = $linkcatid->term_id;
$bookmarks = wp_list_bookmarks('echo=0&categorize=1&exclude_category='.$linkcatid); 
$bookmarks = preg_replace('#<li ([^>]*)>#', '<li>', $bookmarks);
$bookmarks = preg_replace('#<ul ([^>]*)>#', '<ul>', $bookmarks);
?>

<div class="<?php comicpress_post_class(); ?>">
	<div class="post-page-head"></div>
	<div class="post-page">
		<div id="linkspage">
		<ul>
			<?php echo $bookmarks; ?>
		</ul>
		</div>
		<div class="clear"></div>
	</div>
	<div class="post-page-foot"></div>
</div>
	
<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>
