<?php
/**
 * Display comic post
 * Displays the post info for the comic
 * 
 * 
 */

function display_comic_post() { 
	global $post, $wp_query, $transcript_in_posts, $enable_related_comics, $enable_comic_post_author_gravatar, $enable_comic_post_calendar, $disable_categories_in_posts, $disable_tags_in_posts; 
	$first_comic = get_first_comic_permalink(); $last_comic = get_last_comic_permalink();
	?>
	<div class="nav">
		<?php if ( get_permalink() != $first_comic ) { ?><div class="nav-first"><a href="<?php echo $first_comic ?>">&lsaquo;&lsaquo; First</a></div><?php } ?>
		<div class="nav-previous"><?php $temp_query = $wp_query->is_single; $wp_query->is_single = true; previous_comic_link('%link', '&lsaquo; Previous'); $wp_query->is_single = $temp_query;$temp_query = null; ?></div>
		<div class="nav-next"><?php next_comic_link('%link', 'Next &rsaquo;') ?></div>
		<?php if ( get_permalink() != $last_comic ) { ?><div class="nav-last"><a href="<?php echo $last_comic ?>">Last &rsaquo;&rsaquo;</a></div><?php } ?>
	</div>
	<div class="clear"></div>
	<div class="post-comic-head"></div>
	<div class="post-comic">
		<div class="post-info">
			<?php if ($enable_comic_post_author_gravatar == 'yes') { ?>
				<div class="post-author-gravatar"><?php echo get_avatar(get_the_author_meta('email'), 64,'', get_the_author_meta('display_name')); ?></div>
			<?php } ?>
			<?php if ($enable_comic_post_calendar == 'yes') { ?>
				<div class="post-date">
					<div class="date"><span><?php the_time('M') ?></span> <?php the_time('d') ?></div>
				</div>
			<?php } ?>
			<div class="post-text">
				<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<small> By <?php the_author_posts_link(); ?> on <?php the_time('F jS, Y'); ?> <?php edit_post_link('Edit Post', ' [ ', ' ] '); ?></small><br />
				<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="entry">
			<?php if (!is_single()) { global $more; $more = 0; } ?>
			<?php the_content('&darr; Read More..') ?>
		</div>
		<?php if ($transcript_in_posts == 'yes') the_transcript('styled'); ?>
		<div class="post-extras">
			<?php if ($disable_tags_in_posts != 'yes') { ?>
				<div class="tags">
				<?php the_tags('&#9492; Tags: ', ', ', '<br />'); ?>
				</div>
			<?php } ?>
			<div class="tags">
				<?php if ($disable_tags_in_posts != 'yes') the_tags('&#9492; Tags: ', ', ', '<br />'); ?> 
			</div>
			<div class="comment-link">
			<?php if ('open' == $post->comment_status) { comments_popup_link('&ldquo;Comment!&rdquo;', '&ldquo;1 Comment&rdquo;', '&ldquo;% Comments&rdquo;'); } ?>
		</div>
		<div class="clear"></div>
			<?php if ($enable_related_comics == 'yes') echo related_comics_shortcode(); ?>
		</div>
		<br class="clear-margins" />
	</div>
	<div class="post-comic-foot"></div>
	
<?php 
}

?>