<?php
/**
 * Display comic post
 * Displays the post info for the comic
 *
 *
 */

function display_comic_post($frontpage = 0) {
	global $post, $wp_query, $authordata, $comicpress_options, $archive_comic_width;
	$first_comic = get_first_comic_permalink(); 
	$last_comic = get_last_comic_permalink();
	
	if (!$comicpress_options['disable_default_comic_nav']) { 
		if (!is_search() && !is_archive()) { ?>
		<div class="nav">
			<?php if ( get_permalink() != $first_comic ) { ?><div class="nav-first"><a href="<?php echo $first_comic ?>"><?php _e('&lsaquo;&lsaquo; First','comicpress'); ?></a></div><?php } ?>
			<div class="nav-previous"><?php $temp_query = $wp_query->is_single; $wp_query->is_single = true; previous_comic_link('%link', __('&lsaquo; Previous','comicpress')); $wp_query->is_single = $temp_query;$temp_query = null; ?></div>
			<div class="nav-next"><?php next_comic_link('%link', __('Next &rsaquo;','comicpress')) ?></div>
			<?php if ( get_permalink() != $last_comic ) { ?><div class="nav-last"><a href="<?php echo $last_comic ?>"><?php _e('Last &rsaquo;&rsaquo;','comicpress'); ?></a></div><?php } ?>
		</div>
		<br class="clear-margins" />
		<?php } 
	} ?>
	
		<div class="<?php comicpress_post_class(); ?>">
			<?php comicpress_display_post_thumbnail(); ?>
			<div class="post-comic-head"></div>
				<div class="post-comic" id="post-comic-<?php the_ID() ?>">
					<div class="post-comic-info">
						<?php comicpress_display_author_gravatar(); ?>
						<?php if (function_exists('comicpress_show_mood_in_post')) comicpress_show_mood_in_post(); ?>
						<?php comicpress_display_post_calendar(); ?>
						<div class="post-comic-text">
							<?php comicpress_display_post_title(); ?>
							<?php comicpress_display_post_author(); ?>
							<?php comicpress_display_post_category(); ?>
							<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
						</div>
					</div>
					<div class="entry">
						<?php comicpress_display_the_content(); ?>
						<div class="clear"></div>
					</div>
					<div class="post-comic-extras">
						<?php comicpress_display_post_tags(); ?>
						<?php comicpress_display_comment_link(); ?>
						<div class="clear"></div>
						<?php comicpress_display_related_posts(); ?>
					</div>
				</div>
				<div class="post-comic-foot"></div>
		</div>
		<?php
	}
?>
