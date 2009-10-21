<?php

require_once('ComicPressDBInterface.inc');

class ComicPressStoryline {
  var $_structure, $root_category;
  
  /**
   * Create a searchable structure from a node list.
   * @param array $structure The structure to process.
   * @return boolean True if the structure was valid.
   */
  function create_structure($structure) {
    $new_structure = array();
    $parent   = null;
    $all_leaves = array();
    $this->root_category = false;

    $adjacents_by_parent = array();

    if (is_array($structure)) {
      $is_valid = true;
      foreach ($structure as $branch) {
        if (is_string($branch)) {
          $parts = explode('/', $branch);
          $valid = false;
          if (count($parts) > 1) {
            if ($parts[0] == '0') { $valid = true; }
          }
          if (!$valid) {
            $is_valid = false; break;
          } else {
            $data = array();
            $leaf = end($parts);
            $all_leaves[] = $leaf;

            if (count($parts) > 2) {
              $parent = $parts[count($parts) - 2];

              if (!isset($adjacents_by_parent[$parent])) {
                $adjacents_by_parent[$parent] = array();
              }
              $adjacents_by_parent[$parent][] = $leaf;

              $data['parent'] = $parent;
            } else {
              $this->root_category = $leaf;
            }

            $new_structure[$leaf] = $data;
          }
        } else {
          $is_valid = false; break;
        }
      }
      if ($is_valid) {
        for ($i = 0; $i < count($all_leaves); ++$i) {
          foreach (array('previous' => -1, 'next' => 1) as $type => $dir) {
            if (isset($all_leaves[$i + $dir])) {
              $new_structure[$all_leaves[$i]][$type] = $all_leaves[$i + $dir];
            }
          }
        }
      
        $this->_structure = $new_structure;
      }
    }
    return is_array($this->_structure);
  }

  function _get_field($field, $id) {
    if (isset($this->_structure)) {
      if (isset($this->_structure[$id])) {
        if (isset($this->_structure[$id][$field])) {
          return $this->_structure[$id][$field];
        }
      }
    }
    return false;
  }
  
  function parent($id)   { return $this->_get_field('parent', $id); }
  function previous($id) { return $this->_get_field('previous', $id); }
  function next($id)     { return $this->_get_field('next', $id); }
  function valid($id)    {
    if (isset($this->_structure[$id])) {
      return array_keys($this->_structure[$id]);
    }
    return false;
  }

  /**
   * Get the valid navigation directions for a particular post.
   */
  function get_valid_nav($post_id) {
    if (($category = $this->get_valid_post_category($post_id)) !== false) {
      return $this->valid($category);
    }
    return false;
  }

  /**
   * Get the valid comic category for this post.
   */
  function get_valid_post_category($post_id) {
    $result = false;
    
    foreach (wp_get_post_categories($post_id) as $category) {
      if ($this->valid($category)) {
        if ($result) { return false; }

        $result = $category;
      }
    }
    return $result;
  }
}

?>