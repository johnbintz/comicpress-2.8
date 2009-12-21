<?php

require_once('ComicPressStoryline.inc');

class ComicPressRelatedPosts {
	var $related_categories;

	function display_related_comics($attrs = '') {
		$rp = new ComicPressRelatedPosts();
		return $rp->_handle_shortcode(
		  extract(ComicPressRelatedPosts::_handle_shortcode_attrs($attrs)),
		  __('Related Comics &not;', 'comicpress'), true
		);
	}

	function display_related_posts($attrs = '') {
		$rp = new ComicPressRelatedPosts();
		return $rp->_handle_shortcode(
		  extract(ComicPressRelatedPosts::_handle_shortcode_attrs($attrs)),
		  __('Related Posts &not;', 'comicpress'), false
		);
	}

	function _handle_shortcode($attrs, $title, $is_in_storyline) {
		global $post;

		if (is_object($post)) {
			if (isset($post->ID)) {
				$this->_setup_categories($is_in_storyline);
				$tags = $this->_extract_tag_ids($post->ID);

				if (!empty($tags)) {
					$posts = $this->_do_tags_query($post->ID, $tags, $attrs['limit']);
					if (!empty($posts)) {
						return $this->build_post_table($title, $posts);
					}
				}
			}
		}

		return '';
	}

	function _handle_shortcode_attrs($attrs) {
		return shortcode_atts(array(
			'limit' => '5',
		), $atts);
	}

	function _new_comicpressstoryline() { return new ComicPressStoryline(); }

	function _setup_categories($is_in_storyline = true) {
		$storyline = new ComicPressStoryline();
		$storyline->read_from_options();
		$storyline_categories = $storyline->build_from_restrictions();

		if ($is_in_storyline) {
			$this->related_categories = $storyline_categories;
		} else {
			$this->related_categories = array_diff(get_all_category_ids(), $storyline_categories);
		}
	}

	function build_post_table($title, $posts) {
		$output = array();
		if (!empty($posts)) {
			$output[] = '<div class="related_posts">';
				$output[] = '<h4>' . $title . '</h4>';
				$output[] = '<ul>';
				foreach ($posts as $post) {
					if (array_intersect($this->related_categories, wp_get_post_categories($post->ID))) {
						$output[] = '<li><a title="' . esc_attr(get_the_title($post)) . '" href="' . esc_attr(get_permalink($post)) . '">' . esc_html(get_the_title($post)) . '</a></li>';
					}
				}
				$output[] = '</ul>';
			$output[] = '</div>';
		}
		return implode('', $output);
	}

	function _extract_tag_ids($post_id) {
		$output = array();
		foreach (wp_get_post_tags($post_id) as $tag) {
			$output[] = $tag->term_id;
		}
		return $output;
	}

	// @codeCoverageIgnoreStart
	function _do_tags_query($post_id, $tags = array(), $limit = 5) {
		global $wpdb;

		if (!empty($tags)) {
			if (empty($limit)) {
				$limit = 5;
			}

			// Do the query
			$q = "SELECT p.*, count(tr.object_id) as count
					  FROM
			        $wpdb->term_taxonomy AS tt,
			        $wpdb->term_relationships AS tr,
			        $wpdb->posts AS p
					  WHERE
					    tt.taxonomy ='post_tag' AND
					    tt.term_taxonomy_id = tr.term_taxonomy_id AND
					    tr.object_id  = p.ID AND
					    tt.term_id IN (%s) AND
					    p.ID != %d AND
					    p.post_status = 'publish' AND
					    p.post_date < NOW()
						GROUP BY tr.object_id
						ORDER BY count DESC, p.post_date DESC
						LIMIT %d";

			return $wpdb->get_results($wpdb->prepare($q, implode(',', $tags), $post_id, $limit));
		}
		return false;
	}
	// @codeCoverageIgnoreEnd
}

add_shortcode('related_posts', array('ComicPressRelatedPosts', 'display_related_posts'));
add_shortcode('related_comics', array('ComicPressRelatedPosts', 'display_related_comics'));

