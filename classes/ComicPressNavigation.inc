<?php

require_once('ComicPressStoryline.inc');
require_once('ComicPressDBInterface.inc');

class ComicPressNavigation {
  // @codeCoverageIgnoreStart
  function init($storyline) {
    $this->_storyline = $storyline;
    $this->_dbi       = ComicPressDBInterface::get_instance();
  }
  // @codeCoverageIgnoreEnd

  function get_post_nav($post, $restrictions = null) {
    $nav = array();
    if (is_object($post)) {
	    if (isset($post->ID)) {
		    $cache_key = 'navigation-' . $post->ID;

		    if (($result = wp_cache_get($cache_key, 'comicpress')) !== false) {
		    	 foreach ($result as $key => $post_id) {
		    	 	 $nav[$key] = get_post($post_id);
		    	 }
		    	 return $nav;
		    }

		    $categories = $this->_storyline->build_from_restrictions($restrictions);

		    // global previous/next
		    foreach (array('previous', 'next') as $field) {
		      $nav[$field] = $this->_dbi->{"get_${field}_post"}($categories, $post);
		    }

		    // global first/last
		    foreach (array('first', 'last') as $field) {
		      $nav[$field] = $this->_dbi->{"get_${field}_post"}($categories);
		    }

		    if ($category = $this->_storyline->get_valid_post_category($post->ID)) {
		      // storyline previous/next
		      foreach (array('previous', 'next') as $field) {
		        $nav["storyline-${field}"] = $this->_dbi->{"get_${field}_post"}($category, $post);
		      }

		      // adjacent storyline nodes
		      if (is_array($valid = $this->_storyline->valid($category))) {
		        foreach ($valid as $field) {
		        	$all_adjacents = $this->_storyline->all_adjacent($category, $field);
		      		foreach ($all_adjacents as $adjacent_category) {
		      			$result = $this->_dbi->get_first_post($adjacent_category);
		      			if (!empty($result)) {
		        			$nav["storyline-chapter-${field}"] = $result; break;
		      			}
		        	}
		        }
		      }
		    }

		    $cache_data = array();
		    foreach ($nav as $key => $output_post) {
		    	if (!empty($output_post)) { $cache_data[$key] = $output_post->ID; }
		    }

		    wp_cache_set($cache_key, $cache_data, 'comicpress');

				return $nav;
			}
		}
    return false;
  }
}

?>
