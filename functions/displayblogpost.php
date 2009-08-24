<?php
/**
 * Display post
 * Displays the post info
 * 
 * 
 */

function display_blog_post() { 
	global $post, $wp_query, $authordata, $enable_related_posts, $enable_post_author_gravatar, $enable_post_calendar; 
	if (is_single()) { ?>
		<div class="nav-blog">
			<div class="nav-blog-previous"><?php previous_post_link('%link','&lsaquo; Previous', TRUE) ?></div>
			<div class="nav-blog-next"><?php next_post_link('%link','Next &rsaquo;', TRUE) ?></div>
		</div>
		<div class="clear"></div>
	<?php } ?>
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
				</div>
				<div class="post-extras">
					<?php if ($disable_tags_in_posts != 'yes') { ?>
						<div class="tags">
						<?php the_tags('&#9492; Tags: ', ', ', '<br />'); ?>
						</div>
					<?php } ?>
					<div class="comment-link">
						<?php if ('open' == $post->comment_status) { comments_popup_link('&ldquo;Comment!&rdquo;', '&ldquo;1 Comment&rdquo;', '&ldquo;% Comments&rdquo;'); } ?>
					</div>
					<div class="clear"></div>
					<?php if ($enable_related_posts == 'yes') echo related_posts_shortcode(); ?>
				</div>
				<br class="clear-margins" />
			</div>
			<div class="post-foot"></div>
<?php 
}

?>