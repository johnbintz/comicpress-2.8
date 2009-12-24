<?php
/**
 * Display post
 * Displays the post info
 *
 *
 */

function display_blog_post() {
	global $post, $wp_query, $authordata, $comicpress_options;
	comicpress_display_blog_navigation(); ?>
	<div class="clear"></div>
	<div class="<?php comicpress_post_class(); ?>">
		<?php comicpress_display_post_thumbnail(); ?>
		<div class="post-head"></div>
			<div class="post" id="post-<?php the_ID() ?>">
				<div class="post-info">
					<?php comicpress_display_author_gravatar(); ?>
					<?php if (function_exists('comicpress_show_mood_in_post')) comicpress_show_mood_in_post(); ?>
					<?php comicpress_display_post_calendar(); ?>
					<div class="post-text">
						<?php comicpress_display_post_title(); ?>
						<?php comicpress_display_post_author(); ?>						
						<?php if (!$comicpress_options['disable_categories_in_posts']) { ?>
							<div class="post-cat"><?php _e('Posted In:','comicpress'); ?> <?php the_category(','); ?></div>
						<?php } ?>
						<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
						<?php edit_post_link(__('Edit Post','comicpress'), ' [ ', ' ] '); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="entry">
			
<?php 
	if (is_archive() || is_search()) {
		if ($comicpress_options['excerpt_or_content_archive'] != 'excerpt') {
			the_content(__('&darr; Read the rest of this entry...','comicpress'));
		} else { 
			the_excerpt();
		} 				
	} else {
		if (!is_single()) { global $more; $more = 0; } 
		the_content(__('&darr; Read the rest of this entry...','comicpress'));
		if (is_single()) wp_link_pages(array('before' => '<div class="linkpages"><span class="linkpages-pagetext">Pages:</span> ', 'after' => '</div>', 'next_or_number' => 'number'));
	}
?>
				<div class="clear"></div>
			</div>
			<div class="post-extras">
			<?php if (!$comicpress_options['disable_tags_in_posts']) { ?>
				<div class="post-tags">
				<?php the_tags(__('&#9492; Tags: ','comicpress'), ', ', '<br />'); ?>
				</div>
			<?php } ?>
			<?php
				if ('open' == $post->comment_status) {
					if (comicpress_check_child_file('partials/commentlink') == false && !is_single()) { ?>
						<div class="comment-link"><?php comments_popup_link('<span class="comment-balloon comment-balloon-empty">&nbsp;</span> '.__('Comment ','comicpress'), '<span class="comment-balloon">1</span> '.__('Comment ','comicpress'), '<span class="comment-balloon">%</span> '.__('Comments ','comicpress')); ?></div>
				<?php }
				}
			?>
			<div class="clear"></div>
			<?php if ($comicpress_options['enable_related_posts']) echo ComicPressRelatedPosts::display_related_posts(); ?>
		</div>
	</div>
	<div class="post-foot"></div>
	</div>
<?php
	}
?>
