<?php get_header(); ?>
<?php remove_filter('pre_get_posts','comicpress_members_filter'); ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>

	<?php
	$tmp_search = new WP_Query($query_string.'&order=desc&show_posts=-1&posts_per_page=-1');
	$count = $tmp_search->post_count;
			?>
		<?php if (!$count) $count = "no"; ?>
		
<div class="<?php comicpress_post_class(); ?>">
	<div class="post-page-head"></div>
	<div class="post-page">		
		<h2 class="pagetitle"><?php _e('Search for &lsquo;','comicpress'); the_search_query(); _e('&rsquo;','comicpress'); ?></h2>
		<div class="searchresults"><?php printf(__ngettext("%d item.", "%d items.", $count,'comicpress'),$count); ?></div>
	</div>
</div>

  <?php if (have_posts()) :
	$posts = query_posts($query_string.'&order=asc');
	while (have_posts()) : the_post();

			if (is_category() && in_comic_category()) { ?>

				<div class="comicthumbwrap">
					<div class="comicarchiveframe" style="width: <?php echo $mini_comic_width; ?>px">
						<a href="<?php the_permalink() ?>"><img src="<?php the_comic_mini() ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>"  /></a>
					</div>
				</div>
				
			<?php } else { ?>
				<?php if (in_comic_category()) {
					display_comic_post();
				} else {
					display_blog_post();
				}
			}
	endwhile;
    
	else : ?>
		<div class="<?php comicpress_post_class(); ?>">
			<div class="post-page-head"></div>
			<div class="post-page">
				<h3><?php _e('No entries found.','comicpress'); ?></h3>
				<p><?php _e('Try another search?','comicpress'); ?></p>
				<p><?php the_widget('WP_Widget_Search'); ?></p>
			</div>
			<div class="post-page-foot"></div>
		</div>
  <?php endif; ?>
	
<?php comicpress_pagination(); ?>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>
