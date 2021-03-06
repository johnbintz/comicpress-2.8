<?php
	get_header(); 
	remove_filter('pre_get_posts','comicpress_members_filter');
	include(get_template_directory() . '/layout-head.php'); 
	$category_thumbnail_postcount = $comicpress_options['category_thumbnail_postcount'];
	$archive_display_order = $comicpress_options['archive_display_order'];
	$tmp_search = new WP_Query($query_string.'&order='.$archive_display_order.'&show_posts=-1&posts_per_page=-1');
	$count = $tmp_search->post_count;
	
	if (!$count) $count = "no";
?>

	<?php if (have_posts()) : ?>
		<?php 
			if (is_category() && in_comic_category()) {
				$posts = query_posts($query_string.'&showposts='.$category_thumbnail_postcount.'&order='.$archive_display_order);
			} else {
				$posts = query_posts($query_string.'&order='.$archive_display_order);
			} ?>
	<div <?php post_class(); ?>>
		<div class="post-head"></div>
		<div class="post-content">	
			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
			<?php /* Category Archive */ if (is_category()) { ?>
				<h2 class="pagetitle"><?php _e('Archive for &#8216;','comicpress'); ?><?php single_cat_title() ?>&#8217;</h2>
			<?php /* Tag Archive */ } elseif( is_tag() ) { ?>
				<h2 class="pagetitle"><?php _e('Posts Tagged &#8216;','comicpress'); ?><?php single_tag_title() ?>&#8217;</h2>
			<?php /* Daily Archive */ } elseif (is_day()) { ?>
				<h2 class="pagetitle"><?php _e('Archive for','comicpress'); ?> <?php the_time('F jS, Y') ?></h2>
			<?php /* Monthly Archive */ } elseif (is_month()) { ?>
				<h2 class="pagetitle"><?php _e('Archive for','comicpress'); ?> <?php the_time('F, Y') ?></h2>
			<?php /* Yearly Archive */ } elseif (is_year()) { ?>
				<h2 class="pagetitle"><?php _e('Archive for','comicpress'); ?> <?php the_time('Y') ?></h2>
			<?php /* Author Archive */ } elseif (is_author()) { ?>
				<h2 class="pagetitle"><?php _e('Author Archive','comicpress'); ?></h2>
			<?php /* Paged Archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h2 class="pagetitle"><?php _e('Archives','comicpress'); ?></h2>
			<?php } ?>
			<div class="searchresults"><?php printf(_n("%d item.", "%d items.", $count,'comicpress'),$count); ?></div>
			<br class="clear-margins" />
		</div>
		<div class="post-foot"></div>
	</div>
	
		<?php if (is_category() && in_comic_category()) { ?>

		<div <?php post_class(); ?>>
			<div class="post-head"></div>
			<div class="post-content">	
			
		<?php } ?>
		<?php while (have_posts()) : the_post();

			if (is_category() && in_comic_category()) { ?>

				<div class="comicthumbwrap">
					<?php global $mini_comic_width; ?>
					<div class="comicarchiveframe" style="width: <?php echo $mini_comic_width; ?>px">
						<a href="<?php the_permalink() ?>"><?php echo comicpress_display_comic_image("mini,rss,archive,comic", false); ?></a>
					</div>
				</div>
				
			<?php } else { 
				comicpress_display_post();
			}
			
		endwhile;
		
		if (is_category() && in_comic_category()) { ?>
	
			<br class="clear-margins" />
		</div>
		<div class="post-foot"></div>
	</div>	
	
	<?php } ?>
		
		<div class="clear"></div>
	<?php else : ?>
		<div <?php post_class(); ?>>
			<div class="post-head"></div>
			<div class="post">
				<h3><?php _e('No entries found.','comicpress'); ?></h3>
				<p><?php _e('Try another search?','comicpress'); ?></p>
				<p><?php the_widget('WP_Widget_Search'); ?></p>
			</div>
			<div class="post-foot"></div>
		</div>
	<?php endif; ?>
		
	<?php comicpress_pagination(); ?>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>