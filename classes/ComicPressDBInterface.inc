<?php

class ComicPressDBInterface {
	var $is_single, $in_the_loop;
	function ComicPressDBInterface() {}

	function get_instance() {
		static $instance;

		if (!isset($instance)) { $instance = new ComicPressDBInterface(); }
		return $instance;
	}

	function _get_categories_to_exclude($categories = null) {
		if (is_numeric($categories)) { $categories = array($categories); }
		if (is_array($categories)) {
			return array_values(array_diff(get_all_category_ids(), $categories));
		} else {
			return array();
		}
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

	// @codeCoverageIgnoreStart

	/**
	 * Find the terminal post in a specific category.
	 */
	function get_terminal_post_in_categories($categories, $first = true) {
		$this->_prepare_wp_query();

		if (!is_array($categories)) { $categories = array($categories); }

		$sort_order = $first ? "asc" : "desc";
		$terminal_comic_query = new WP_Query();
		$terminal_comic_query->query(array(
			'showposts' => 1,
		  'order' => $sort_order,
			'category__in' => $categories,
			'status' => 'publish'
		));
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
	function get_first_post($categories) {
		return $this->get_terminal_post_in_categories($categories);
	}

	/**
	 * Get the last comic in a category.
	 */
	function get_last_post($categories) {
		return $this->get_terminal_post_in_categories($categories, false);
	}

	/**
	 * Get the comic post adjacent to the current comic.
	 * Wrapper around get_adjacent_post(). Don't unit test this method.
	 */
	function get_adjacent_post($categories, $next = false, $override_post = null) {
		global $post;

		$this->_prepare_wp_query();
		if (!is_null($override_post)) { $temp_post = $post; $post = $override_post; }

		$result = get_adjacent_post(false, implode(" and ", $this->_get_categories_to_exclude($categories)), !$next);

		$this->_reset_wp_query();
		if (!is_null($override_post)) { $post = $temp_post; }

		return empty($result) ? false : $result;
	}

	/**
	 * Get the previous comic from the current one.
	 */
	function get_previous_post($categories = null, $override_post = null) { return $this->get_adjacent_post($categories, false, $override_post); }

	/**
	 * Get the next comic from the current one.
	 */
	function get_next_post($categories = null, $override_post = null) { return $this->get_adjacent_post($categories, true, $override_post); }

	// @codeCoverageIgnoreEnd

	function get_parent_child_category_ids() {
		global $wpdb;

		$parent_child_categories = array();

		$result = $wpdb->get_results("SELECT term_id, parent FROM $wpdb->term_taxonomy", ARRAY_A);
		if (!empty($result)) {
			foreach ($result as $row) {
				$parent_child_categories[$row['term_id']] = $row['parent'];
			}
		}

		return $parent_child_categories;
	}
}
