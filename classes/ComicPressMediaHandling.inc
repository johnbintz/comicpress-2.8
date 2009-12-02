<?php

class ComicPressMediaHandling {
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
}
