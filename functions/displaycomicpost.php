<?php
/**
 * Display comic post
 * Displays the post info for the comic
 * 
 * 
 */

function display_comic_post() { 
		global $post, $wp_query, $authordata, $enable_related_comics, $enable_comic_post_author_gravatar, $enable_comic_post_calendar, $disable_categories_in_posts, $disable_tags_in_posts;
			$first_comic = get_first_comic_permalink(); $last_comic = get_last_comic_permalink();
		?>
		<div class="nav">
			<?php if ( get_permalink() != $first_comic ) { ?><div class="nav-first"><a href="<?php echo $first_comic ?>"><?php _e('&lsaquo;&lsaquo; First','comicpress'); ?></a></div><?php } ?>
			<div class="nav-previous"><?php $temp_query = $wp_query->is_single; $wp_query->is_single = true; previous_comic_link('%link', __('&lsaquo; Previous','comicpress')); $wp_query->is_single = $temp_query;$temp_query = null; ?></div>
			<div class="nav-next"><?php next_comic_link('%link', __('Next &rsaquo;','comicpress')) ?></div>
			<?php if ( get_permalink() != $last_comic ) { ?><div class="nav-last"><a href="<?php echo $last_comic ?>"><?php _e('Last &rsaquo;&rsaquo;','comicpress'); ?></a></div><?php } ?>
		</div>
		<div class="<?php comicpress_post_class(); ?>">
			<div class="post-comic-head"></div>
				<div class="post-comic" id="post-comic-<?php the_ID() ?>">
					<div class="post-comic-info">
					<?php if ($enable_comic_post_author_gravatar == 'yes') { ?>
						<div class="post-comic-author-gravatar"><?php echo str_replace("alt='", "alt='".get_the_author_meta('display_name')."' title='".get_the_author_meta('display_name'),comicpress_get_avatar(get_the_author_meta('email'), 64)); ?></div>
					<?php } ?>
					<?php if (function_exists('comicpress_show_mood_in_post')) comicpress_show_mood_in_post(); ?>
					<?php if ($enable_comic_post_calendar == 'yes') { ?>
						<div class="post-comic-date">
							<div class="date"><span><?php the_time('M') ?></span> <?php the_time('d') ?></div>
						</div>
					<?php } ?>
					<div class="post-comic-text">
						<?php if (function_exists('the_post_image')) {
							if ( has_post_image() ) { ?>
								<div class="post-comic-image">
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_post_image('full'); ?></a>
								</div>
							<?php } else {?>
								<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
							<?php } ?>
						<?php } else { ?>
							<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<?php } ?>
						<div class="post-comic-author"> <?php the_time('F jS, Y'); ?> <span class="pipe">|</span> by <?php the_author_posts_link(); ?> <?php edit_post_link(__('Edit Post','comicpress'), ' [ ', ' ] '); ?></div>
						<?php if (get_option('comicpress-enable-storyline-support') == 1) { ?>
							<ul class="storyline-cats"><li class="storyline-root"><?php the_category(' &raquo; </li><li>', multiple) ?></li></ul>
						<?php } else { ?>
							<?php if ($disable_categories_in_posts != 'yes') { ?>
								<div class="post-comic-cat"><?php _e('Posted In:','comicpress'); ?> <?php the_category(','); ?></div>
							<?php } ?>
						<?php } ?>
						<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
					</div>
				</div>
				<div class="entry">
					<?php if (!is_single()) { global $more; $more = 0; } ?>
					<?php the_content(__('&darr; Read the rest of this entry...','comicpress')); ?>
					<?php if (is_single()) wp_link_pages(array('before' => '<div class="linkpages"><span class="linkpages-pagetext">Pages:</span> ', 'after' => '</div>', 'next_or_number' => 'number'));  ?>
					<div class="clear"></div>
				</div>
				<div class="post-comic-extras">
				<?php if ($disable_tags_in_posts != 'yes') { ?>
					<div class="post-comic-tags">
					<?php the_tags(__('&#9492; Tags: ','comicpress'), ', ', '<br />'); ?>
					</div>
				<?php } ?>
				<?php 
					if ('open' == $post->comment_status) { 
						if (comicpress_check_child_file('partials/commentlink') == false) { ?>
							<div class="comment-link"><?php comments_popup_link('<span class="comment-balloon comment-balloon-empty">&nbsp;</span> '.__('Comments ','comicpress'), '<span class="comment-balloon">1</span> '.__('Comment ','comicpress'), '<span class="comment-balloon">%</span> '.__('Comments ','comicpress')); ?></div>
						<?php }
					}
				?>
				<div class="clear"></div>
				<?php if ($enable_related_comics == 'yes') echo related_comics_shortcode(); ?>
			</div>
		</div>
		<div class="post-comic-foot"></div>
		</div>
		<?php 
	}
?>