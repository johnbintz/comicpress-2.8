<?php
/**
 * Display post
 * Displays the post info
 * 
 * 
 */

function display_blog_post() { 
	global $post, $wp_query, $authordata, $comicpress_options; ?>
	<?php if (is_single()) { ?>
		<div class="blognav">
			<div class="nav-single">
				<?php previous_post_link('%link',__(' &lsaquo; Previous ','comicpress'), TRUE); ?>
				<?php next_post_link('%link',__('| Next &rsaquo; ','comicpress'), TRUE); ?>
			</div>
		</div>
	<?php } ?>
	<div class="clear"></div>
	<div class="<?php comicpress_post_class(); ?>">
		<?php if (function_exists('has_post_thumbnail')) {
			if ( has_post_thumbnail() ) { ?>
				<div class="post-image">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_post_thumbnail('full'); ?></a>
				</div>
			<?php }
		} ?>
		<div class="post-head"></div>
			<div class="post" id="post-<?php the_ID() ?>">
				<div class="post-info">
				<?php if ($comicpress_options['enable_post_author_gravatar']) { ?>
					<div class="post-author-gravatar"><?php echo str_replace("alt='", "alt='".get_the_author_meta('display_name')."' title='".get_the_author_meta('display_name'),comicpress_get_avatar(get_the_author_meta('email'), 64)); ?></div>
				<?php } ?>
				<?php if (function_exists('comicpress_show_mood_in_post')) comicpress_show_mood_in_post(); ?>
				<?php if ($comicpress_options['enable_post_calendar']) { ?>
					<div class="post-date">
						<div class="date"><span><?php the_time('M') ?></span> <?php the_time('d') ?></div>
					</div>
				<?php } ?>
				<div class="post-text">
					<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<div class="post-author"> <?php the_time('F jS, Y'); ?> <span class="pipe">|</span> by <?php the_author_posts_link(); ?> <?php edit_post_link(__('Edit Post','comicpress'), ' [ ', ' ] '); ?></div>
					<?php if (!$comicpress_options['disable_categories_in_posts']) { ?>
						<div class="post-cat"><?php _e('Posted In:','comicpress'); ?> <?php the_category(','); ?></div>
					<?php } ?>
					<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="entry">
				<?php if (!is_single()) { global $more; $more = 0; } ?>
				<?php the_content(__('&darr; Read the rest of this entry...','comicpress')); ?>
				<?php if (is_single()) wp_link_pages(array('before' => '<div class="linkpages"><span class="linkpages-pagetext">Pages:</span> ', 'after' => '</div>', 'next_or_number' => 'number'));  ?>
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
					if (comicpress_check_child_file('partials/commentlink') == false && !(is_single())) { ?>
						<div class="comment-link"><?php comments_popup_link('<span class="comment-balloon comment-balloon-empty">&nbsp;</span> '.__('Comments ','comicpress'), '<span class="comment-balloon">1</span> '.__('Comment ','comicpress'), '<span class="comment-balloon">%</span> '.__('Comments ','comicpress')); ?></div>
					<?php }
				}
			?>
			<div class="clear"></div>
			<?php if ($comicpress_options['enable_related_posts']) echo related_posts_shortcode(); ?>
		</div>
	</div>
	<div class="post-foot"></div>
	</div>
<?php 
	}
?>