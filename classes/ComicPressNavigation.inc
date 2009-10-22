<?php

require_once('ComicPressStoryline.inc');
require_once('ComicPressDBInterface.inc');

class ComicPressNavigation {
  function init($storyline) {
    $this->_storyline = $storyline;
    $this->_dbi       = ComicPressDBInterface::get_instance();
  }

  function get_post_nav($post) {
    $nav = array();

    // global previous/next
    foreach (array('previous', 'next') as $field) {
      $nav[$field] = $this->_dbi->{"get_${field}_comic"}(null, $post);
    }

    // global first/last
    if ($root_category = $this->_storyline->root_category) {
      foreach (array('first', 'last') as $field) {
        $nav[$field] = $this->_dbi->{"get_${field}_comic"}($root_category);
      }
    }

    if ($category = $this->_storyline->get_valid_post_category($post->ID)) {
      // storyline previous/next
      foreach (array('previous', 'next') as $field) {
        $nav["storyline-${field}"] = $this->_dbi->{"get_${field}_comic"}($category, $post);
      }

      // adjacent storyline nodes
      if (is_array($valid = $this->_storyline->valid($category))) {
        foreach ($valid as $field) {
          $nav["storyline-chapter-${field}"] = $this->_dbi->get_first_comic($this->_storyline->{$field}($category));
        }
      }
    }

		return $nav;
  }
}

?>