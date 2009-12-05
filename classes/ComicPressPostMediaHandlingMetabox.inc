<?php

class ComicPressPostMediaHandlingMetabox {
	function __comicpress_init() {
		add_action('admin_menu', array('ComicPressPostMediaHandlingMetabox', 'admin_menu'));
	}

	function handle_update() {}

	function _get_valid_types() {
		return array_keys(ComicPressMediaHandling::_bundle_global_variables());
	}

	function handle_post_media_update($info) {
		if (isset($info['post_id'])) {
			if (is_numeric($info['post_id'])) {
				$result = array();
				if (isset($info['urls'])) {
					if (is_array($info['urls'])) {
						$valid_types = $this->_get_valid_types();
						foreach ($info['urls'] as $field => $value) {
							if (in_array($field, $valid_types)) {
								$result[$field] = strip_tags($value);
							}
						}
					}
				}
				update_post_meta($info['post_id'], 'backend_url_images', $result);
			}
		}
	}

	function admin_menu() {
		add_meta_box('comicpress-post-media-handling', __('ComicPress Post Media', 'comicpress'), array('ComicPressPostMediaHandlingMetabox', 'metabox'), 'post', 'normal', 'low');
	}

	function metabox() {
		global $post;
		$media_info = get_post_meta($post->ID, 'backend_url_images', true);
		if (!is_array($media_info)) {
			$media_info = array();
		}

		$nonce = wp_create_nonce('comicpress');
		$action_nonce = wp_create_nonce('comicpress-post-media-update');

		include('partials/post-media-handling/metabox.inc');
	}
}
