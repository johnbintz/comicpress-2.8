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
	
<?php while (have_posts()) : the_post() ?>

<div class="<?php comicpress_post_class(); ?>">
	<?php if (function_exists('has_post_thumbnail')) {
		if ( has_post_thumbnail() ) { ?>
			<div class="post-page-image">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_post_thumbnail('full'); ?></a>
			</div>
		<?php }
	} ?>
	<div class="post-page-head"></div>
	<div class="post-page">
		<?php if (!$comicpress_options['disable_page_titles']) { ?>
			<h2 class="pagetitle"><?php the_title() ?></h2>
		<?php } ?>
		<div class="entry">
			<?php the_content(); ?>
		</div>
		<br class="clear-margins" />
		<?php edit_post_link(__('Edit this page.','comicpress'), '<p>', '</p>') ?>
	</div>
	<div class="post-page-foot"></div>
</div>

<?php endwhile; ?>

<div class="<?php comicpress_post_class(); ?>">
	<div class="post-page-head"></div>
	<div class="post-page">
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
	<div class="post-page-foot"></div>
</div>

<?php if ('open' == $post->comment_status) { comments_template('', true); } ?>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>