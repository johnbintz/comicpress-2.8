<?php
/*
Template Name: This Month of Comics
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
<div <?php post_class(); ?>>
	<div class="post-head"></div>
	<div class="post-page">
<?php if (have_posts()) : while (have_posts()) : the_post() ?>

				<div class="comicthumbwrap">
					<div class="comicarchiveframe">
						<a href="<?php the_permalink() ?>"><img src="<?php the_comic_mini() ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>" style="width: <?php echo $mini_comic_width; ?>px" /></a><br />
					</div>
				</div>
				
<?php endwhile; endif; ?>
		<br class="clear-margins" />
	</div>
	<div class="post-foot"></div>
</div>	
	



<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>