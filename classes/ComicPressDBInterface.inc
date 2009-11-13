<?php

class ComicPressDBInterface {
	var $_non_comic_categories, $_all_categories;

	function ComicPressDBInterface() {}

	function get_instance() {
		static $instance;

		if (!isset($instance)) { $instance = new ComicPressDBInterface(); }
		return $instance;
	}

	function _get_categories() { return get_categories("hide_empty=0"); }

	/**
	 * Set the comic categories for the current run of ComicPress.
	 */
	function set_comic_categories($categories) {
		$this->_all_categories       = get_all_category_ids();
		$this->_non_comic_categories = array_values(array_diff($this->_all_categories, $categories));
	}

	function _get_categories_to_exclude($category = null) {
		$result = array_diff($this->_all_categories, array($category));
		if (is_array($result)) {
			return (is_null($category)) ? $this->_non_comic_categories : array_values($result);
		} else {
			return $this->_non_comic_categories;
		}
	}

	/**
	 * Find the terminal post in a specific category.
	 */
	function get_terminal_post_in_category($category_id, $first = true) {
		$this->_prepare_wp_query();

		$sort_order = $first ? "asc" : "desc";
		$terminal_comic_query = new WP_Query();
		$terminal_comic_query->query("showposts=1&order=${sort_order}&cat=${category_id}&status=publish");
		$post = false;
		if ($terminal_comic_query->have_posts()) {
			$post = reset($terminal_comic_query->posts);
		}

		$this->_reset_wp_query();
		return $post;
	}

	/**
	 * Get the first comic in a category.
	 */
	function get_first_comic($category_id) {
		return $this->get_terminal_post_in_category($category_id);
	}

	/**
	 * Get the last comic in a category.
	 */
	function get_last_comic($category_id) {
		return $this->get_terminal_post_in_category($category_id, false);
	}

	/**
	 * Get the comic post adjacent to the current comic.
	 * Wrapper around get_adjacent_post(). Don't unit test this method.
	 */
	function get_adjacent_comic($category, $next = false, $override_post = null) {
		global $post;

		$this->_prepare_wp_query();
		if (!is_null($override_post)) { $temp_post = $post; $post = $override_post; }

		$result = get_adjacent_post(false, implode(" and ", $this->_get_categories_to_exclude($category)), !$next);

		$this->_reset_wp_query();
		if (!is_null($override_post)) { $post = $temp_post; }

		return empty($result) ? false : $result;
	}

	function _prepare_wp_query() {
		global $wp_query;

		$this->is_single = $wp_query->is_single;
		$this->in_the_loop = $wp_query->in_the_loop;

		$wp_query->is_single = $wp_query->in_the_loop = true;
	}

	function _reset_wp_query() {
		global $wp_query;

		$wp_query->is_single = $this->is_single;
		$wp_query->in_the_loop = $this->in_the_loop;
	}

	/**
	 * Get the previous comic from the current one.
	 */
	function get_previous_comic($category = null, $override_post = null) { return $this->get_adjacent_comic($category, false, $override_post); }

	/**
	 * Get the next comic from the current one.
	 */
	function get_next_comic($category = null, $override_post = null) { return $this->get_adjacent_comic($category, true, $override_post); }
}

?>
