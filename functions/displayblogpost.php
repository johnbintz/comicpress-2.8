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
						<?php comicpress_display_post_category(); ?>
						<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
						<?php edit_post_link(__('Edit Post','comicpress'), ' [ ', ' ] '); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="entry">
					<?php comicpress_display_the_content(); ?>
					<div class="clear"></div>
				</div>
				<div class="post-extras">
					<?php comicpress_display_post_tags(); ?>
					<?php comicpress_display_comment_link(); ?>
				<div class="clear"></div>
				<?php if ($comicpress_options['enable_related_posts']) echo ComicPressRelatedPosts::display_related_posts(); ?>
			</div>
		</div>
		<div class="post-foot"></div>
	</div>
<?php
	}
?>
