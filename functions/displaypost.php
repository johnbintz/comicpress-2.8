<?php

function comicpress_display_post_title() {
	global $post, $wp_query;
	$post_title = "<h2 class=\"post-title\">";
	if (is_home() || is_search() || is_archive()) $post_title .= "<a href=\"".get_permalink()."\">";
	$post_title .= get_the_title();
	if (is_home() || is_search() || is_archive()) $post_title .= "</a>";
	$post_title .= "</h2>\r\n";
	echo apply_filters('comicpress_display_post_title',$post_title);
}

function comicpress_display_post_thumbnail() {
	global $post;
	if (function_exists('has_post_thumbnail')) {
		if ( has_post_thumbnail() ) {
			$post_thumbnail = "<div class=\"post-image\"><a href=\"".get_permalink()."\" rel=\"bookmark\" title=\"Permanent Link to ".get_the_title()."\">".get_the_post_thumbnail($post->ID,'full')."</a></div>\r\n";
			echo apply_filters('comicpress_display_post_thumbnail',$post_thumbnail);
		}
	} 
}

function comicpress_display_author_gravatar() {
	global $post, $comicpress_options;
	if ($comicpress_options['enable_post_author_gravatar'] && (is_home() || is_single())) {
		$author_get_gravatar = str_replace("alt='", "alt='".get_the_author_meta('display_name')."' title='".get_the_author_meta('display_name'),comicpress_get_avatar(get_the_author_meta('email'), 64));
		$author_gravatar = "<div class=\"post-author-gravatar\">".$author_get_gravatar."</div>";
		echo apply_filters('comicpress_display_author_gravatar', $author_gravatar);
	}
}

function comicpress_display_post_calendar() {
	global $post, $comicpress_options;
	if ($comicpress_options['enable_post_calendar']) { 
		$post_calendar = "<div class=\"post-calendar-date\"><div class=\"calendar-date\"><span>".get_the_time('M')."</span>".get_the_time('d')."</div></div>\r\n";
		echo apply_filters('comicpress_display_post_calendar',$post_calendar);
	}
}

function comicpress_display_post_author() {
	global $post;
	$post_author = "<div class=\"post-author\"><span class=\"post-date\">".get_the_time('F jS, Y')."</span> <span class=\"pipe\">|</span> by ".get_the_author_meta('display_name')."</div>";
	echo apply_filters('comicpress_display_post_author',$post_author);
}

function comicpress_display_blog_navigation() {
	global $post, $wp_query;
	if (is_single() && !in_comic_category()) { ?>
		<div class="blognav">
			<div class="nav-single">
				<?php previous_post_link('%link',__(' &lsaquo; Previous ','comicpress'), TRUE); ?>
				<?php next_post_link('%link',__('| Next &rsaquo; ','comicpress'), TRUE); ?>
			</div>
		</div>
		<div class="clear"></div>
	<?php }
}
	

function comicpress_display_post() {
	global $post, $wp_query; ?>
	<div <?php post_class(); ?>>
		<?php comicpress_display_blog_navigation(); ?>
		<?php comicpress_display_post_thumbnail(); ?>
		<div class="post-head"></div>
			<div class="post-content">
				<div class="post-info">
					<?php if (function_exists('comicpress_show_mood_in_post')) comicpress_show_mood_in_post(); ?>
					<div class="post-text">
						<?php comicpress_display_post_title(); ?>
	<?php if (!is_page()) { ?>
		<div class="post-author"> <?php the_time('F jS, Y'); ?> <span class="pipe">|</span> by <?php the_author_posts_link(); ?> <?php edit_post_link(__('Edit Post','comicpress'), ' [ ', ' ] '); ?></div>
		<?php if (!$comicpress_options['disable_categories_in_posts']) { ?>
			<div class="post-cat"><?php _e('Posted In:','comicpress'); ?> <?php the_category(','); ?></div>
		<?php } ?>
		<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
	<?php } ?>
					</div>
					<?php comicpress_display_author_gravatar(); ?>
				</div>
				<div class="clear"></div>
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
					<br class="clear-margins" />
				</div>
				<?php wp_link_pages(array('before' => '<div class="linkpages"><span class="linkpages-pagetext">'.__('Pages:','comicpress').'</span> ', 'after' => '</div>', 'next_or_number' => 'number'));  ?>
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
		<div class="post-foot"></div>
	</div>
	<?php
}

function comicpress_display_page_post() {
	global $post, $wp_query, $comicpress_options; ?>
	<div class="<?php comicpress_post_class(); ?>">
		<?php comicpress_display_post_thumbnail(); ?>
		<div class="post-page-head"></div>
		<div class="post-page">
			<?php if (!$comicpress_options['disable_page_titles']) { ?>
				<h2 class="pagetitle"><?php the_title() ?></h2>
			<?php } ?>
			<div class="entry">
				<?php the_content(); ?>
			</div>
			<br class="clear-margins" />
			<?php wp_link_pages(array('before' => '<div class="linkpages"><span class="linkpages-pagetext">'.__('Pages:','comicpress').'</span> ', 'after' => '</div>', 'next_or_number' => 'number'));  ?>
			<br class="clear-margins" />
			<?php edit_post_link(__('Edit this page.','comicpress'), '<p>', '</p>') ?>
		</div>
		<div class="post-page-foot"></div>
	</div>
<?php 
}


?>