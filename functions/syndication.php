<?php
/**
 * Syndication - Feed Count Capturing & adding comic to feed.
 * Author: Philip M. Hofer (Frumph)
 * In Testing
 */
/*

function cp_add_to_feed_count_rss() {
	$feedcount = get_option('comicpress_feed_count_rss');
	if (!empty($feedcount)) {
		$feedcount = $feedcount + 1;
		update_option('comicpress_feed_count_rss', $feedcount);
	} else {
		add_option('comicpress_feed_count_rss', 1, ' ', 'yes');
	}
}

add_action('do_feed_rss', 'cp_add_to_feed_count_rss',5);


function cp_add_to_feed_count_rdf() {
	$feedcount = get_option('comicpress_feed_count_rdf');
	if (!empty($feedcount)) {
		$feedcount = $feedcount + 1;
		update_option('comicpress_feed_count_rdf', $feedcount);
	} else {
		add_option('comicpress_feed_count_rdf', 1, ' ', 'yes');
	}
}

add_action('do_feed_rdf', 'cp_add_to_feed_count_rdf',5);


function cp_add_to_feed_count_atom() {
	$feedcount = get_option('comicpress_feed_count_atom');
	if (!empty($feedcount)) {
		$feedcount = $feedcount + 1;
		update_option('comicpress_feed_count_atom', $feedcount);
	} else {
		add_option('comicpress_feed_count_atom', 1, ' ', 'yes');
	}
}

add_action('do_feed_atom', 'cp_add_to_feed_count_atom',5);

function cp_add_to_feed_count_rss2() {
	$feedcount = get_option('comicpress_feed_count_rss2');
	if (!empty($feedcount)) {
		$feedcount = $feedcount + 1;
		update_option('comicpress_feed_count_rss2', $feedcount);
	} else {
		add_option('comicpress_feed_count_rss2', 1, ' ', 'yes');
	}
}

add_action('do_feed_rss2', 'cp_add_to_feed_count_rss2',5);
*/

/**
 * Add the number of post comments to the title of the RSS feed items.
 * TODO Make this togglable via options.
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

global $comicpress_options;
if ($comicpress_options['enable_comment_count_in_rss']) {
	add_filter('the_title_rss', 'comicpress_the_title_rss');
	add_action('export_wp', 'comicpress_export_wp');
}
