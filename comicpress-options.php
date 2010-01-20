<?php

function comicpress_options_setup() {
	$pagehook = add_submenu_page('themes.php',__('ComicPress Options', 'comicpress'), __('ComicPress Options','comicpress'), 10, 'comicpress-options', 'comicpress_admin');
	add_action('admin_head-' . $pagehook, 'comicpress_admin_page_head');
	add_action('admin_print_scripts-' . $pagehook, 'comicpress_admin_print_scripts');
	add_action('admin_print_styles-' . $pagehook, 'comicpress_admin_print_styles');
}

function comicpress_admin_print_scripts() {
	wp_enqueue_script('utils');
	wp_enqueue_script('jquery');
}

function comicpress_admin_print_styles() {
	wp_admin_css('css/global');
	wp_admin_css('css/colors');
	wp_admin_css('css/ie');
	wp_enqueue_style('comicpress-options', get_template_directory_uri() . '/options/options.css');
}

function comicpress_save_options_comic_filename_filters($incoming) {
	$filters = array();

	foreach (array_values($incoming) as $filter) {
		$filters[wp_filter_nohtml_kses($filter['name'])] = wp_filter_nohtml_kses($filter['filter']);
	}

	if (!empty($filters)) {
		if (!isset($filters['default'])) {
			$cpmh = new ComicPressMediaHandling();
			$filters['default'] = $cpmh->default_filter;
		}
	}

	return $filters;
}

function comicpress_admin_page_head() { ?>
	<!--[if lt ie 8]> <style> div.show { position: static; margin-top: 1px; } #cpadmin div.off { height: 22px; } </style> <![endif]-->
<?php }

function comicpress_admin() {
	global $upload_path, $blogcat;
	$comicpress_options = get_option('comicpress_options');
?>

<div class="wrap">
	<div id="cpadmin-headericon" style="background: url('<?php echo get_template_directory_uri(); ?>/images/options/comicpress_icon.png') no-repeat;"></div>
	<h2 class="alignleft"><?php _e('ComicPress Options','comicpress'); ?></h2>
	<div class="clear"></div>
	<?php
	$tab = '';
	if ( wp_verify_nonce($_POST['_wpnonce'], 'update-options') ) {

		if ($_REQUEST['action'] == 'comicpress_save_layout') {
			$comicpress_options['cp_theme_layout'] = wp_filter_nohtml_kses($_REQUEST['cp_theme_layout']);
			$tab = 'themestyle';
			update_option('comicpress_options',$comicpress_options);
		}

		if ($_REQUEST['action'] == 'comicpress_save_general') {

			foreach (array(
				'disable_page_restraints',
				'rascal_says',
				'disable_comment_note',
				'enable_numbered_pagination',
				'enable_comment_count_in_rss',
				'enable_post_thumbnail_rss',
				'comic_clicks_next',
				'disable_default_comic_nav',
				'enable_widgetarea_use_sidebar_css',
				'disable_lrsidebars_frontpage',
				'disable_footer_text',
				'disable_blogheader',
				'enable_comicpress_debug',
				'enable_full_post_check',
				'enable_scroll_to_top',
				'enable_page_load_info'
				) as $key) {
					$comicpress_options[$key] = (bool)( $_REQUEST[$key] == 1 ? true : false );
			}

			foreach (array(
				'graphicnav_directory'
						) as $key) {
				$comicpress_options[$key] = wp_filter_nohtml_kses($_REQUEST[$key]);
			}
			$tab = 'general';
			update_option('comicpress_options',$comicpress_options);
		}

		if ($_REQUEST['action'] == 'comicpress_save_index') {
			foreach (array(
				'disable_comic_frontpage',
				'disable_comic_blog_frontpage',
				'disable_comic_blog_single',
				'disable_blog_frontpage',
				) as $key) {
					$comicpress_options[$key] = (bool)( $_REQUEST[$key] == 1 ? true : false );
			}
			$comicpress_options['blog_postcount'] = wp_filter_nohtml_kses($_REQUEST['blog_postcount']);
			$tab = 'index';
			update_option('comicpress_options',$comicpress_options);
		}

		if ($_REQUEST['action'] == 'comicpress_save_post') {
			foreach (array(
				'transcript_in_posts',
				'enable_related_comics',
				'enable_related_posts',
				'remove_wptexturize',
				'enable_comic_post_author_gravatar',
				'enable_post_author_gravatar',
				'split_column_in_two',
				'enable_comic_post_calendar',
				'enable_post_calendar',
				'disable_tags_in_posts',
				'disable_categories_in_posts',
				'blogposts_with_comic',
				'static_blog',
				'disable_page_titles'
						) as $key) {
				$comicpress_options[$key] = (bool)( $_REQUEST[$key] == 1 ? true : false );
			}
			foreach (array(
				'author_column_one',
				'author_column_two',
				'avatar_directory',
				'moods_directory',
				'calendar_directory'
						) as $key) {
				$comicpress_options[$key] = wp_filter_nohtml_kses($_REQUEST[$key]);
			}
			$tab = 'post';
			update_option('comicpress_options',$comicpress_options);
		}

		if ($_REQUEST['action'] == 'comicpress_save_archivesearch') {
			foreach (array(
				'archive_display_order',
				'excerpt_or_content_archive',
				'excerpt_or_content_search',
				'category_thumbnail_postcount'
						) as $key) {
				$comicpress_options[$key] = wp_filter_nohtml_kses($_REQUEST[$key]);
			}
			$tab = 'archivesearch';
			update_option('comicpress_options',$comicpress_options);
		}

		if ($_REQUEST['action'] == 'comicpress_save_menubar') {
			foreach (array(
				'enable_search_in_menubar',
				'enable_rss_in_menubar',
				'enable_navigation_in_menubar',
				'contact_in_menubar',
				'disable_dynamic_menubar_links',
				'disable_default_menubar',
				'enable_blogroll_off_links'
						) as $key) {
				$comicpress_options[$key] = (bool)( $_REQUEST[$key] == 1 ? true : false );
			}
			$tab = 'menubar';
			update_option('comicpress_options',$comicpress_options);
		}

		if ($_REQUEST['action'] == 'comicpress_save_addons') {
			foreach (array(
				'enable_custom_image_header',
				'enable_members_only_post_comments',
				'buy_print_add_shipping'
						) as $key) {
				$comicpress_options[$key] = (bool)( $_REQUEST[$key] == 1 ? true : false );
			}
			foreach (array(
				'custom_image_header_width',
				'custom_image_header_height',
				'enable_members_only',
				'members_post_category',
				'buy_print_email',
				'buy_print_url',
				'buy_print_us_amount',
				'buy_print_int_amount',
				'buy_print_us_ship',
				'buy_print_int_ship'
						) as $key) {
				$comicpress_options[$key] = wp_filter_nohtml_kses($_REQUEST[$key]);
			}
			$tab = 'addons';
			update_option('comicpress_options',$comicpress_options);
		}

		if ($_REQUEST['action'] == 'comicpress_save_config') {

			foreach (array(
				'comiccat',
				'blogcat',
				'comic_folder',
				'rss_comic_folder',
				'archive_comic_folder',
				'mini_comic_folder',
				'archive_comic_width',
				'rss_comic_width',
				'mini_comic_width'
						) as $key) {
				$comicpress_options['comicpress_config'][$key] = wp_filter_nohtml_kses($_REQUEST[$key]);
			}

			if (isset($_REQUEST['comic_filename_filters'])) {
				$comicpress_options['comic_filename_filters'] = comicpress_save_options_comic_filename_filters($_REQUEST['comic_filename_filters']);
			} else {
				$comicpress_options['comic_filename_filters'] = array();
			}

			$tab = 'config';
			update_option('comicpress_options',$comicpress_options);
		}

		if ($tab) {
			?>
			<div id="message" class="updated"><p><strong><?php _e('ComicPress Settings SAVED!','comicpress'); ?></strong></p></div>
			<script>function hidemessage() { document.getElementById('message').style.display = 'none'; }</script>
		<?php }
		}
		if ($_REQUEST['action'] == 'comicpress_reset') {
			delete_option('comicpress_options');
			$comicpress_options = comicpress_load_options();
		?>
			<div id="message" class="updated"><p><strong><?php _e('ComicPress Settings RESET!','comicpress'); ?></strong></p></div>
		<?php
	}

	?>

	<div id="poststuff" class="metabox-holder">
		<div id="cpadmin">
		  <?php
		  	$tab_info = array(
		  		'themestyle' => __('Layout', 'comicpress'),
		  		'general' => __('General', 'comicpress'),
  	  		'index' => __('Home Page', 'comicpress'),
  	  		'post' => __('Posts &amp; Pages', 'comicpress'),
  	  		'archivesearch' => __('Archive &amp; Search', 'comicpress'),
  	  		'menubar' => __('Menubar', 'comicpress'),
  	  		'addons' => __('Add Ons', 'comicpress'),
  	  		'config' => __('Configuration', 'comicpress'),
		  	);

		  	if (empty($tab)) { $tab = array_shift(array_keys($tab_info)); }

		  	foreach($tab_info as $tab_id => $label) { ?>
		  		<div id="comicpress-tab-<?php echo $tab_id ?>" class="comicpress-tab <?php echo ($tab == $tab_id) ? 'on' : 'off'; ?>"><span><?php echo $label; ?></span></div>
		  	<?php }
		  ?>
		</div>

		<div id="comicpress-options-pages">
		  <?php	foreach (glob(get_template_directory() . '/options/*.php') as $file) { include($file); } ?>
		</div>
	</div>
	<script type="text/javascript">
		(function($) {
			var showPage = function(which) {
				$('#comicpress-options-pages > div').each(function(i) {
					$(this)[(this.id == 'comicpress-' + which) ? 'show' : 'hide']();
				});
			};

			$('.comicpress-tab').click(function() {
				$('#message').animate({height:"0", opacity:0, margin: 0}, 100, 'swing', function() { $(this).remove() });

				showPage(this.id.replace('comicpress-tab-', ''));
				var myThis = this;
				$('.comicpress-tab').each(function() {
					var isSame = (this == myThis);
					$(this).toggleClass('on', isSame).toggleClass('off', !isSame);
				});
				return false;
			});

			showPage('<?php echo esc_js($tab) ?>');
		}(jQuery));
	</script>
</div>

<?php
}

add_action('admin_menu', 'comicpress_options_setup');
