<?php
/*
Template Name: Comic Archive
*/
?>
<?php get_header();  ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>
	
<div class="<?php comicpress_post_class(); ?>">
	<div class="post-page-head"></div>
	<div class="post-page">
	<?php while (have_posts()) : the_post() ?>
		<?php if (function_exists('the_post_thumbnail')) {
			if ( has_post_thumbnail() ) { ?>
				<div class="post-page-image">
				<?php the_post_thumbnail('full'); ?>
				</div>
			<?php } ?>
		<?php } ?>
		<?php if (!$comicpress_options['disable_page_titles']) { ?>
			<h2 class="pagetitle"><?php the_title() ?></h2>
		<?php } ?>
		<div class="entry">
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>

	<?php $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' ORDER BY post_date DESC");
	foreach ( $years as $year ) {
		if ($year != (0) ) { ?>
			<h3><?php echo $year ?></h3>
			<table class="month-table">
				<?php $comicArchive = new WP_Query(); $comicArchive->query('showposts=10000&cat='.get_all_comic_categories_as_cat_string().'&year='.$year);
				while ($comicArchive->have_posts()) : $comicArchive->the_post() ?>
					<tr><td class="archive-date"><?php the_time('M j') ?></td><td class="archive-title"><a href="<?php echo get_permalink($post->ID) ?>" rel="bookmark" title="<?php _e('Permanent Link:','comicpress'); ?> <?php the_title() ?>"><?php the_title() ?></a></td></tr>
				<?php endwhile; ?>
			</table>
	<?php } } ?>
		<?php edit_post_link(__('Edit this page.','comicpress'), '<p>', '</p>') ?>
		<br class="clear-margins" />
	</div>
	<div class="post-page-foot"></div>
</div>


<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>