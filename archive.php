<?php
	get_header(); global $category_thumbnail_postcount; 
	remove_filter('pre_get_posts','comicpress_members_filter');
	include(get_template_directory() . '/layout-head.php'); 
	
	global $archive_display_order;
	if (empty($archive_display_order)) $archive_display_order = 'desc';
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
	<div class="<?php comicpress_post_class(); ?>">
		<div class="post-page-head"></div>
		<div class="post-page">	
			<div class="content">
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
				<div class="searchresults"><?php printf(__ngettext("%d item.", "%d items.", $count,'comicpress'),$count); ?></div>
			</div>
		</div>
		<div class="post-page-foot"></div>
	</div>


		<?php while (have_posts()) : the_post() ?>
		
			<?php if (is_category() && in_comic_category()) { ?>

				<div class="comicthumbwrap">
					<div class="comicarchiveframe" style="width: <?php echo $mini_comic_width; ?>px">
						<a href="<?php the_permalink() ?>"><img src="<?php the_comic_mini() ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>"  /></a>
					</div>
				</div>

			<?php } else { ?>
				<?php global $archive_comic_width; if (in_comic_category()) { ?>
				<div class="<?php comicpress_post_class(); ?>">
					<div class="post-comic-head"></div>
					<div class="post-comic">
						<div class="post-info">
							<?php if ($enable_comic_post_author_gravatar == 'yes') { ?>
								<div class="post-author-gravatar"><?php echo str_replace("alt='", "alt='".get_the_author_meta('display_name')."' title='".get_the_author_meta('display_name'),comicpress_get_avatar(get_the_author_meta('email'), 64)); ?></div>
							<?php } ?>
							<?php if (function_exists('comicpress_show_mood_in_post')) comicpress_show_mood_in_post(); ?>
							<?php if ($enable_comic_post_calendar == 'yes') { ?>
								<div class="post-date">
									<div class="date"><span><?php the_time('M') ?></span> <?php the_time('d') ?></div>
								</div>
							<?php } ?>
							<div class="post-text">
								<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
								<small> <?php _e('By','comicpress'); ?> <?php the_author_posts_link(); ?> <?php _e('on','comicpress'); ?> <?php the_time('F jS, Y'); ?> <?php edit_post_link(__('Edit Post','comicpress'), ' [ ', ' ] '); ?></small><br />
								<?php if (get_option('comicpress-enable-storyline-support') == 1) { ?>
									<ul class="storyline-cats"><li class="storyline-root"><?php the_category(' &raquo; </li><li>', multiple) ?></li></ul>
								<?php } else { ?>
									<?php if ($disable_categories_in_posts != 'yes') { ?>
										<small> <?php _e('Posted In:','comicpress'); ?> <?php the_category(','); ?></small><br />
									<?php } ?>
								<?php } ?>
								<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
							</div>
							<div class="clear"></div>
						</div>
						<div class="comicarchiveframe" style="max-width:<?php echo $archive_comic_width; ?>px;">
							<a href="<?php the_permalink() ?>"><img src="<?php the_comic_archive() ?>" alt="<?php the_title() ?>" title="Click for full size." style="max-width: <?php echo $archive_comic_width ?>px" /></a>
						</div>
					</div>
					<div class="post-comic-foot"></div>
				</div>
				<?php } else { ?>
				<div class="<?php comicpress_post_class(); ?>">
					<div class="post-head"></div>
					<div <?php post_class(); ?>>
					<div class="post-info">
						<?php if ($enable_post_author_gravatar == 'yes') { ?>
							<div class="post-author-gravatar"><?php echo str_replace("alt='", "alt='".get_the_author_meta('display_name')."' title='".get_the_author_meta('display_name'),comicpress_get_avatar(get_the_author_meta('email'), 64)); ?></div>
						<?php } ?>
						<?php if (function_exists('comicpress_show_mood_in_post')) comicpress_show_mood_in_post(); ?>
						<?php if ($enable_post_calendar == 'yes') { ?>
							<div class="post-date">
								<div class="date"><span><?php the_time('M') ?></span> <?php the_time('d') ?></div>
							</div>
						<?php } ?>
						<div class="post-text">
							<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e('Permanent Link to','comicpress'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
							<small> <?php _e('By','comicpress'); ?> <?php the_author_posts_link(); ?> <?php _e('on','comicpress'); ?> <?php the_time('F jS, Y'); ?> <?php edit_post_link(__('Edit Post','comicpress'), ' [ ', ' ] '); ?></small><br />
							<?php if ($disable_categories_in_posts != 'yes') { ?>
								<small> <?php _e('Posted In:','comicpress'); ?> <?php the_category(','); ?></small><br />
							<?php } ?>
							<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
						</div>
						<div class="clear"></div>
					</div>
				<?php global $excerpt_or_content_archive; 
				if ($excerpt_or_content_archive != 'excerpt') {
					the_content(__('&darr; Read the rest of this entry...','comicpress'));
				} else { 
					the_excerpt();
						} ?>
						<div class="post-extras">
							<div class="post-tags">
								<?php the_tags(__('&#9492; Tags:','comicpress'),', ','<br />'); ?>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<div class="post-foot"></div>
				</div>
				<?php } ?>
			<?php } ?>
		<?php endwhile; ?>
		<div class="clear"></div>
	<?php else : ?>
	<div class="<?php comicpress_post_class(); ?>">
		<div class="post-head"></div>
		<div class="post">
			<h3><?php _e('No posts found.','comicpress'); ?></h3>
			<p><?php _e('Try another search?','comicpress'); ?></p>
			<p><?php include(get_template_directory() . '/searchform.php') ?></p>
		</div>
		<div class="post-foot"></div>
	</div>
	<?php endif; ?>
		
	<?php comicpress_pagination(); ?>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>