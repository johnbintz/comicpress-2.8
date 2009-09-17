<?php
/*
Template Name: Comic Year Archive
*/
?>
<?
	if (isset($_GET['archive_year'])) { 
		$archive_year = (int)$_GET['archive_year']; 
	} else { 
		$latest_comic = get_terminal_post_in_category(get_all_comic_categories_as_cat_string(),false); 
		$archive_year = get_post_time('Y', false, $latest_comic, true); 
	}
	if (empty($archive_year)) $archive_year = date('Y'); 
?> 
<?php get_header();  ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>
	
<div class="<?php comicpress_blogpost_class(); ?>">
	<div class="post-page-head"></div>
	<div class="post-page">
	<?php while (have_posts()) : the_post() ?>
		<div class="entry">
			<h2 class="pagetitle"><?php the_title() ?> <span class="page-archive-year"> <?php echo $archive_year; ?></span></h2>
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>

		<div class="archive-yearlist">| 
			<?php $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' ORDER BY post_date ASC");
				foreach ( $years as $year ) {
				if ($year != (0) ) { ?>	
				<a href="<?php echo add_query_arg('archive_year', $year) ?>"><strong><?php echo $year ?></strong></a> |
			<?php } } ?>
		</div>

		<table class="month-table">
			<?php $comicArchive = new WP_Query(); $comicArchive->query('showposts=10000&cat='.get_all_comic_categories_as_cat_string().'&year='.$archive_year);
			while ($comicArchive->have_posts()) : $comicArchive->the_post() ?>
				<tr><td class="archive-date"><?php the_time('M j') ?></td><td class="archive-title"><a href="<?php echo get_permalink($post->ID) ?>" rel="bookmark" title="Permanent Link: <?php the_title() ?>"><?php the_title() ?></a></td></tr>
			<?php endwhile; ?>
		</table>
		
		<br class="clear-margins" />

	</div>
	<div class="post-page-foot"></div>
</div>
		</div>
	</div>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>