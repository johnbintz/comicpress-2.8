<?php

class ComicPressPostMediaHandlingMetabox {
	function __comicpress_init() {
		$n = new ComicPressPostMediaHandlingMetabox();
		add_action('admin_menu', array(&$n, 'admin_menu'));
	}

	function handle_update() {}

	function admin_menu() {
		add_meta_box('comicpress-post-media-handling', __('ComicPress Post Media', 'comicpress'), array(&$this, 'metabox'), 'post', 'normal', 'low');
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
