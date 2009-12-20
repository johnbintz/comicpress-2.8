<?php
/*
Template Name: Month at a glance
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

	<?php	
//based on Austin Matzko's code from wp-hackers email list
  function filter_where($where = '') {
    //posts in the last 30 days
	$where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
//    $where .= " AND post_date >= '2009-03-01' AND post_date < '2009-03-16'";
    return $where;
  }
add_filter('posts_where', 'filter_where');
$posts = query_posts('&show_posts=-1&posts_per_page=-1&cat='.get_all_comic_categories_as_cat_string());

?>

	<?php if (have_posts()) : while (have_posts()) : the_post() ?>
				<div class="comicthumbwrap">
					<div class="comicarchiveframe">
						<a href="<?php the_permalink() ?>"><img src="<?php the_comic_mini() ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>" style="width: <?php echo $mini_comic_width; ?>px" /></a><br />
					</div>
				</div>
	<?php endwhile; endif; ?>
		<br class="clear-margins" />
	</div>
	<div class="post-page-foot"></div>
</div>
	
<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>