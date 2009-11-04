<?php get_header(); ?>
<?php remove_filter('pre_get_posts','comicpress_members_filter'); ?>
<?php include(get_template_directory() . '/layout-head.php'); ?>

<?php
$tmp_search = new WP_Query($query_string.'&order=desc&show_posts=-1&posts_per_page=-1');
$count = $tmp_search->post_count;
			?>
		<?php if (!$count) $count = "no"; ?>
		
		
		<h2 class="pagetitle"><?php _e('Search for &lsquo;','comicpress'); the_search_query(); _e('&rsquo;','comicpress'); ?></h2>
		<div class="searchresults"><?php printf(__ngettext("%d item.", "%d items.", $count,'comicpress'),$count); ?></div>
  <?php if (have_posts()) : ?>
    
    <?php $posts = query_posts($query_string.'&order=asc');
    while (have_posts()) : the_post() ?>
      
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
						<small>
              <?php
                ob_start();
                the_author_posts_link();
                $author_link = ob_get_clean();
                printf(__('By %1$s on %2$s', 'comicpress'), $author_link, get_the_time('F jS, Y'));
              ?>
              
              <?php edit_post_link(__('Edit Post','comicpress'), ' [ ', ' ] '); ?>
            </small><br />
            <?php if (function_exists('the_matching_transcript_excerpts')) { the_matching_transcript_excerpts(); } ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="comicarchiveframe" style="width:<?php echo $archive_comic_width; ?>px;">
					<a href="<?php the_permalink() ?>"><img src="<?php the_comic_archive() ?>" alt="<?php the_title() ?>" title="Click for full size." width="<?php echo $archive_comic_width ?>" /></a><br />
				</div>
				<br class="clear-margins" />
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
						<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<small> <?php _e('By','comicpress'); ?> <?php the_author_posts_link(); ?> <?php _e('on','comicpress'); ?> <?php the_time('F jS, Y'); ?> <?php edit_post_link(__('Edit Post','comicpress'), ' [ ', ' ] '); ?></small><br />
						<?php if ($disable_categories_in_posts != 'yes') { ?>
							<?php if ($post->post_type == 'page') { ?>
								<small><?php _e('This is a page.','comicpress'); ?></small><break />
							<?php } else { ?>
								<small><?php _e('Posted In:','comicpress'); ?> <?php the_category(','); ?></small><br />
							<?php } ?>
						<?php } ?>
						<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
					</div>
					<div class="clear"></div>
				</div>
					<?php global $excerpt_or_content_search; 
					if ($excerpt_or_content_search != 'excerpt') {
						the_content(__('&darr; Read the rest of this entry...','comicpress'));
					} else { 
						the_excerpt();
					} ?>
				<br class="clear-margins" />
				<div class="post-extras">
					<div class="tags">
						<?php the_tags(__('&#9492; Tags:','comicpress'),', ','<br />'); ?>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="post-foot"></div>
          </div>
        <?php } ?>

    <?php endwhile; ?>
    
  <?php else : ?>
		<div class="<?php comicpress_post_class(); ?>">
			<div class="post-page-head"></div>
			<div class="post-page">
				<h3><?php _e('No entries found.','comicpress'); ?></h3>
				<p><?php _e('Try another search?','comicpress'); ?></p>
				<p><?php include (get_template_directory() . '/searchform.php') ?></p>
				<br class="clear-margins" />
			</div>
			<div class="post-page-foot"></div>
		</div>
  <?php endif; ?>
	
<?php comicpress_pagination(); ?>

<?php include(get_template_directory() . '/layout-foot.php'); ?>
<?php get_footer() ?>