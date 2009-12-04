<?php

class ComicPressPostMediaHandlingMetabox {
	function __comicpress_init() {
		$n = new ComicPressPostMediaHandlingMetabox();

		if (isset($_REQUEST['cp'])) {
			if (is_array($_REQUEST['cp'])) {
				if (isset($_REQUEST['cp']['_nonce'])) {
					if (wp_verify_nonce('comicpress', $_REQUEST['cp']['_nonce'])) {
						if (isset($_REQUEST['cp']['action'])) {
							if (isset($_REQUEST['cp']['_action_nonce'])) {
								if (wp_verify_nonce('comicpress-' . $_REQUEST['cp']['action'], $_REQUEST['cp']['_action_nonce'])) {
									$method_name = str_replace('-', '_', $_REQUEST['cp']['_action_nonce']);
									if (method_exists($n, $method_name)) {
										$n->{$method_name}($_REQUEST['cp']);
									}
								}
							}
						}
					}
				}
			}
		}
	}

	function handle_update($info) {

	}
}
