<?php
/**
 * Syndication - Feed Count Capturing & adding comic to feed.
 * Author: Philip M. Hofer (Frumph)
 * In Testing
 */

/**
 * Add the number of post comments to the title of the RSS feed items.
 * @param string $title The title of the post.
 * @return string The filtered title of the post.
 */
function comicpress_the_title_rss($title = '') {
	switch ($count = get_comments_number()) {
		case 0:
			$title_pattern = __('%s (No Comments)', 'comicpress');
			break;
		case 1:
			$title_pattern = __('%s (1 Comment)', 'comicpress');
			break;
		default:
			$title_pattern = sprintf(__('%%s (%d Comments)', 'comicpress'), $count);
			break;
	}

	return sprintf($title_pattern, $title);
}

/**
 * Handle making changes to ComicPress before the export process starts.
 */
function comicpress_export_wp() {
	remove_filter('the_title_rss', 'comicpress_the_title_rss');
}

function comicpress_init_rss() {
	$comicpress_options = comicpress_load_options();
	if ($comicpress_options['disable_rss_comments_count']) {
		add_filter('the_title_rss', 'comicpress_the_title_rss');
		add_action('export_wp', 'comicpress_export_wp');
	}
}

add_action('init', 'comicpress_init_rss');
