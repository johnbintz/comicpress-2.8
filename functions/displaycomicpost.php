<?php
/**
 * Display comic post
 * Displays the post info for the comic
 * 
 * 
 */

function display_comic_post() { 
	global $post, $wp_query, $transcript_in_posts, $enable_related_comics, $enable_comic_post_author_gravatar, $enable_comic_post_calendar, $disable_categories_in_posts, $disable_tags_in_posts, $themepack_directory;; 
	$first_comic = get_first_comic_permalink(); $last_comic = get_last_comic_permalink();
	?>
	<div class="nav">
		<?php if ( get_permalink() != $first_comic ) { ?><div class="nav-first"><a href="<?php echo $first_comic ?>">&lsaquo;&lsaquo; First</a></div><?php } ?>
		<div class="nav-previous"><?php $temp_query = $wp_query->is_single; $wp_query->is_single = true; previous_comic_link('%link', '&lsaquo; Previous'); $wp_query->is_single = $temp_query;$temp_query = null; ?></div>
		<div class="nav-next"><?php next_comic_link('%link', 'Next &rsaquo;') ?></div>
		<?php if ( get_permalink() != $last_comic ) { ?><div class="nav-last"><a href="<?php echo $last_comic ?>">Last &rsaquo;&rsaquo;</a></div><?php } ?>
	</div>
	<div class="clear"></div>
<div class="<?php comicpress_post_class(); ?>">
	<div class="post-comic-head"></div>
	<div class="post-comic">
		<div class="post-info">
			<?php if ($enable_comic_post_author_gravatar == 'yes') { ?>
				<div class="post-author-gravatar"><?php echo str_replace("alt='", "alt='".get_the_author_meta('display_name')."' title='".get_the_author_meta('display_name'),get_avatar(get_the_author_meta('email'), 64)); ?></div>
			<?php } ?>
			<?php if (function_exists('comicpress_show_mood_in_post')) comicpress_show_mood_in_post(); ?>
			<?php if ($enable_comic_post_calendar == 'yes') { ?>
				<div class="post-date">
					<div class="date"><span><?php the_time('M') ?></span> <?php the_time('d') ?></div>
				</div>
			<?php } ?>
			<div class="post-text">
				<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<small> By <?php the_author_posts_link(); ?> on <?php the_time('F jS, Y'); ?> <?php edit_post_link('Edit Post', ' [ ', ' ] '); ?></small><br />
				<?php if (get_option('comicpress-enable-storyline-support') == 1) { ?>
					<ul class="storyline-cats"><li class="storyline-root"><?php the_category(' &raquo; </li><li>', multiple) ?></li></ul>
				<?php } else { ?>
					<?php if ($disable_categories_in_posts != 'yes') { ?>
						<small><?php _e('Posted In:','comicpress'); ?> <?php the_category(','); ?></small><br />
					<?php } ?>
				<?php } ?>
				<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="entry">
			<?php if (!is_single()) { global $more; $more = 0; } ?>
			<?php the_content('&darr; Read More..') ?>
			<?php if (is_single()) wp_link_pages(array('before' => '<div class="linkpages"><span class="linkpages-pagetext">Pages:</span> ', 'after' => '</div>', 'next_or_number' => 'number'));  ?>
		</div>
		<?php if ($transcript_in_posts == 'yes') the_transcript('styled'); ?>
				<div class="post-extras">
					<?php if ($disable_tags_in_posts != 'yes') { ?>
						<div class="tags">
						<?php the_tags('&#9492; Tags: ', ', ', '<br />'); ?>
						</div>
					<?php } ?>
					<?php if (!is_single()) { 
							if ('open' == $post->comment_status) { 
								if ( ($themepack_directory != 'none' && !empty($themepack_directory) ) && file_exists(get_template_directory() . '/themepack/'.$themepack_directory.'/commentlink.php') ) { 
									include(get_template_directory() . '/themepack/' .$themepack_directory. '/commentlink.php');
								} else { ?>
									<div class="comment-link"><?php comments_popup_link('<span class="comment-balloon comment-balloon-empty">&nbsp;</span> No Comments ', '<span class="comment-balloon">1</span> Comment ', '<span class="comment-balloon">%</span> Comments '); ?></div>
							<?php }
							}					
						} ?>
					<div class="clear"></div>
					<?php if ($enable_related_comics == 'yes') echo related_comics_shortcode(); ?>
				</div>
				<br class="clear-margins" />
	</div>
	<div class="post-comic-foot"></div>
</div>
	
<?php 
}

?>