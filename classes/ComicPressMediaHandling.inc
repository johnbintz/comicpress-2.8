<?php

class ComicPressMediaHandling {
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
					return $comic_filename_filters[$filter_to_use];
				}
			}
		}

		return $this->default_filter;
	}

	function get_comic_path($source = 'comic', $override_post = null, $filter = 'default', $multi = false) {

	}
}
