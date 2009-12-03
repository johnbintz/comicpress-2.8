<?php

class ComicPressMediaHandling {
	var $root_filter    = '%wordpress%/%type-folder%/';
	var $default_filter = '%wordpress%/%type-folder%/%date-Y-m-d%*.*';

	function _bundle_global_variables() {
		global $comic_folder, $archive_comic_folder, $rss_comic_folder, $mini_comic_folder;

		$bundle = array();
		foreach (array('comic', 'archive', 'rss', 'mini') as $which) {
			switch ($which) {
				case 'comic':
					$bundle['comic'] = $comic_folder;
					break;
				default:
					$bundle[$which] = ${"${which}_comic_folder"};
					break;
			}
		}
		return $bundle;
	}

	function _get_filter($filter_to_use = null) {
		global $comic_filename_filters;

		if (!is_null($filter_to_use)) {
			if (is_string($filter_to_use)) {
				if (isset($comic_filename_filters[$filter_to_use])) {
					return $this->_convert_to_percent_filter($comic_filename_filters[$filter_to_use]);
				}
			}
		}

		return $this->default_filter;
	}

	function _convert_to_percent_filter($old) {
		if (strpos(strtolower($old), '%wordpress%') !== 0) {
			$old = str_replace('{date}', '%date-Y-m-d%', $old);
			return $this->root_filter . $old;
		}
		return $old;
	}

	function _expand_filter($filter, $type_folder, $override_post = null) {
		global $post;
		$this->post_to_use = !is_null($override_post) ? $override_post : $post;
		$this->type_folder = $type_folder;

		$result = preg_replace_callback('#%([a-z0-9-]+)%#i', array(&$this, '_expand_filter_callback'), $filter);
		$result = str_replace('.', '\.', $result);
		$result = str_replace('*', '.*', $result);

		unset($this->post_to_use);
		unset($this->type_folder);

		return $result;
	}

	function _resolve_regex_path($input) {
		$input = str_replace('\.', '.', $input);
		return $input;
	}

	// @codeCoverageIgnoreStart
	function _abspath() {
		return realpath(ABSPATH);
	}
	// @codeCoverageIgnoreEnd

	function _expand_filter_callback($matches) {
		$value = '';
		switch (strtolower($matches[1])) {
			case 'wordpress':
				$value = $this->_abspath();
				break;
			case 'type-folder':
				$value = $this->type_folder;
				break;
			default:
				if (preg_match('#^date-(.*)$#', $matches[1], $date_matches) > 0) {
					if (isset($this->post_to_use)) {
						$value = date($date_matches[1], strtotime($this->post_to_use->post_date));
						break;
					}
				}
				$value = $matches[0];
				break;
		}
		return apply_filters('comicpress_expand_filter_callback', $value, $matches);
	}

	function _read_directory($pattern) {
		$dirname = $this->_resolve_regex_path(dirname($pattern));
		$results = false;
		if (is_dir($dirname)) {
			$results = array();
			if (($dh = opendir($dirname)) !== false) {
				$filename_pattern = str_replace('#', '\#', basename($pattern));
				while (($file = readdir($dh)) !== false) {
					$target = $dirname . '/' . $file;
					if (is_file($target)) {
						if (preg_match("#^${filename_pattern}$#", $file) > 0) {
							$results[] = $target;
						}
					}
				}
				closedir($dh);
			}
		}
		return $results;
	}

	function _check_post_meta_data($post_to_use, $type) {
		if ($result = get_post_meta($post_to_use->ID, "backend_url_${type}", true)) {
			if (is_string($result)) {
				return $result;
			}
		}

		if ($result = get_post_meta($post_to_use->ID, "backend_url_images", true)) {
			if (is_string($result)) {
				parse_str($result, $types);
				if (isset($types[$type])) {
					return $types[$type];
				}
			}
		}

		if ($result = get_post_meta($post_to_use->ID, "backend_url", true)) {
			if (is_string($result)) {
				return $result;
			}
		}
		return false;
	}

	function _ensure_valid_uri($uri, $type) {
		if (!empty($uri)) {
			if (substr($uri, 0, 1) == '/') {
				return $uri;
			} else {
				if (preg_match('#^[a-z]+://#', $uri) > 0) {
					return $uri;
				} else {
					$bundle = $this->_bundle_global_variables();
					if (isset($bundle[$type])) {
						$this->type_folder = $bundle[$type];
					} else {
						$this->type_folder = '';
					}

					$uri = preg_replace_callback('#%([a-z0-9-]+)%#i', array(&$this, '_expand_filter_callback'), $uri);

					return trailingslashit(get_bloginfo('url')) . $uri;
				}
			}
		}
		return false;
	}

	/**
	 * Get the comic path.
	 * @param string $type The type to retrieve.
	 * @param object $override_post The post to use in place of the Loop post.
	 * @param string $filter The filter to use.
	 * @param boolean $multi If true, return all matching files.
	 * @return string|array|boolean A single comic URI relative to the WordPress base, multiple comic URIs, or false if an error occurred.
	 */
	function get_comic_path($type = 'comic', $override_post = null, $filter = 'default', $multi = false) {
		global $post;
		$post_to_use = !is_null($override_post) ? $override_post : $post;

		if ($uri = $this->_check_post_meta($post_to_use, $type)) {
			if ($result = $this->_ensure_valid_url($uri, $type)) {
				return $result;
			}
		}

		$filter = $this->_get_filter($filter);
		$globals = $this->_bundle_global_variables();

		if (isset($globals[$type])) {
			$filter = $this->_expand_filter($filter, $globals[$type], $post_to_use);

			if (is_array($results = $this->_read_directory($filter))) {
				if (($pre_handle = apply_filters('comicpress_pre_handle_comic_path_results', false, $results, $type, $post_to_use)) !== false) {
					return $pre_handle;
				}

				$new_results = array();
				foreach ($results as $result) {
					$new_results[] = str_replace($this->_abspath(), '', $result);
				}

				if ($multi) {
					return $new_results;
				} else {
					return reset($new_results);
				}
			}
		}
		return false;
	}
}
