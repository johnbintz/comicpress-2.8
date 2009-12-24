<?php
/*
Template Name: Comic Year Archive
*/
?>
<?php get_header();  ?>
<?php remove_filter('pre_get_posts','comicpress_members_filter'); ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>

<?php
if (isset($_REQUEST['archive_year'])) { 
	$archive_year = $_REQUEST['archive_year']; 
} else {
	$latest_comic = get_terminal_post_in_category(get_all_comic_categories_as_cat_string(),true); 
	$archive_year = get_post_time('Y', false, $latest_comic, true); 
}
if (empty($archive_year) || $archive_year == '') $archive_year = date('Y');
?> 
	
<?php 
if (have_posts()) {
	while (have_posts()) : the_post();
		comicpress_display_post();
	endwhile; 
}
?>

<div <?php post_class(); ?>>
	<div class="post-head"></div>
	<div class="post-content">
		<div class="archive-yearlist">| 
			<?php $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' ORDER BY post_date ASC");
				foreach ( $years as $year ) {
				if ($year != (0) ) { ?>	
				<a href="<?php echo add_query_arg('archive_year', $year) ?>"><strong><?php echo $year ?></strong></a> |
			<?php } } ?>
		</div>

		<table class="month-table">
			<?php $comicArchive = new WP_Query(); $comicArchive->query('&showposts=-1&cat='.get_all_comic_categories_as_cat_string().'&year='.$archive_year);
			while ($comicArchive->have_posts()) : $comicArchive->the_post() ?>
				<tr><td class="archive-date"><?php the_time('M j') ?></td><td class="archive-title"><a href="<?php echo get_permalink($post->ID) ?>" rel="bookmark" title="<?php _e('Permanent Link:','comicpress'); ?> <?php the_title() ?>"><?php the_title() ?></a></td></tr>
			<?php endwhile; ?>
		</table>
		<br class="clear-margins" />
	</div>
	<div class="post-foot"></div>
</div>

<?php if ('open' == $post->comment_status) { comments_template('', true); } ?>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>