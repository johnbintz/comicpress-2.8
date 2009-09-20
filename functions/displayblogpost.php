<?php
/**
 * Display post
 * Displays the post info
 * 
 * 
 */

function display_blog_post() { 
	global $post, $wp_query, $authordata, $enable_related_posts, $enable_post_author_gravatar, $enable_post_calendar, $themepack_directory;  ?>
	<?php if (is_single()) { ?>
		<div class="blognav">
				<div class="nav-single">
					<?php previous_post_link('%link','Previous', TRUE); ?>
					<?php next_post_link('%link','Next', TRUE); ?>
				</div>
		</div>
	<?php } ?>
	<div class="clear"></div>
		<div class="<?php comicpress_post_class(); ?>">
			<div class="post-head"></div>
			<div class="post" id="post-<?php the_ID() ?>">
				<div class="post-info">
					<?php if ($enable_post_author_gravatar == 'yes') { ?>
						<div class="post-author-gravatar"><?php echo str_replace("alt='", "alt='".get_the_author_meta('display_name')."' title='".get_the_author_meta('display_name'),get_avatar(get_the_author_meta('email'), 64)); ?></div>
					<?php } ?>
					<?php if (function_exists('comicpress_show_mood_in_post')) comicpress_show_mood_in_post(); ?>
					<?php if ($enable_post_calendar == 'yes') { ?>
						<div class="post-date">
							<div class="date"><span><?php the_time('M') ?></span> <?php the_time('d') ?></div>
						</div>
					<?php } ?>
					<div class="post-text">
						<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<small> By <?php the_author_posts_link(); ?> on <?php the_time('F jS, Y'); ?> <?php edit_post_link('Edit Post', ' [ ', ' ] '); ?></small><br />
						<?php if ($disable_categories_in_posts != 'yes') { ?>
							<small> Posted In: <?php the_category(','); ?></small><br />
						<?php } ?>
						<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="entry">
					<?php if (!is_single()) { global $more; $more = 0; } ?>
					<?php the_content('&darr; Read the rest of this entry...') ?>
					<?php if (is_single()) wp_link_pages(array('before' => '<div class="linkpages"><span class="linkpages-pagetext">Pages:</span> ', 'after' => '</div>', 'next_or_number' => 'number'));  ?>
				</div>
				<div class="post-extras">
					<?php if ($disable_tags_in_posts != 'yes') { ?>
						<div class="tags">
						<?php the_tags('&#9492; Tags: ', ', ', '<br />'); ?>
						</div>
					<?php } ?>
					<?php if (!is_single()) { 
							if ('open' == $post->comment_status) { 
								if (comicpress_check_themepack_file('commentlink.php') == false) { ?>
									<div class="comment-link"><?php comments_popup_link('<span class="comment-balloon comment-balloon-empty">&nbsp;</span> No Comments ', '<span class="comment-balloon">1</span> Comment ', '<span class="comment-balloon">%</span> Comments '); ?></div>
							<?php }
							}
						} ?>
					<div class="clear"></div>
					<?php if ($enable_related_posts == 'yes') echo related_posts_shortcode(); ?>
				</div>
				<br class="clear-margins" />
			</div>
			<div class="post-foot"></div>
		</div>
<?php 
}

?>