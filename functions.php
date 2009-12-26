<?php

// the_post_thumbnail('thumbnail/medium/full');
if (function_exists('add_theme_support')) {
	add_theme_support( 'post-thumbnails' );
}

function __comicpress_widgets_init() {
	$available_widgets = array();

	if (($dh = opendir(dirname(__FILE__) . '/widgets')) !== false) {
		while (($file = readdir($dh)) !== false) {
			if (strpos($file, '.inc') !== false) {
				$class_name = "ComicPress" . preg_replace('#\..*$#', '', $file);
				require_once(dirname(__FILE__) . '/widgets/' . $file);
				register_widget($class_name);
				$widget = new $class_name(true);
				if (method_exists($widget, 'init')) {
					$widget->init();
				}

				$available_widgets[strtolower($class_name)] = $widget;
			}
		}
		closedir($dh);
	}

	foreach (wp_get_sidebars_widgets() as $type => $widgets) {
		if ($type != 'wp_inactive_widgets') {
			foreach ($widgets as $widget_id) {
				foreach ($available_widgets as $key => $widget) {
					if (method_exists($widget, 'is_active')) {
						if (strpos(strtolower($widget_id), $key) === 0) {
							$widget->is_active();
						}
					}
				}
			}
		}
	}
}

function __comicpress_init() {
	global $comicpress_options, $__comicpress_handlable_classes;

	$comicpress_options = array();
	// Check if the $comicpress_options exist, if not set defaults
	$comicpress_options = comicpress_load_options();
	// xili-language plugin check
	if (class_exists('xili_language')) {
		define('THEME_TEXTDOMAIN','comicpress');
		define('THEME_LANGS_FOLDER','/lang');
	} else {
	   load_theme_textdomain( 'comicpress', get_template_directory() . '/lang' );
	}

	// Queue up the scripts.
	if (!is_admin() && $comicpress_options['enable_scroll_to_top']) {
		wp_enqueue_script('comicpress_scroll', get_template_directory_uri() . '/js/scroll.js');
	}

	// remove intense debates control over the comment numbers
	if (function_exists('id_get_comment_number')) {
		remove_filter('comments_number','id_get_comment_number');
	}

	do_action('comicpress_init');

	if ($verified_nonce = __comicpress_verify_nonce()) {
		do_action("comicpress_init-${verified_nonce}");
	}
}

function __comicpress_verify_nonce() {
	if (isset($_REQUEST['cp'])) {
		if (is_array($_REQUEST['cp'])) {
			if (isset($_REQUEST['cp']['_nonce'])) {
				if (wp_verify_nonce($_REQUEST['cp']['_nonce'], 'comicpress')) {
					if (isset($_REQUEST['cp']['action'])) {
						if (isset($_REQUEST['cp']['_action_nonce'])) {
							if (wp_verify_nonce($_REQUEST['cp']['_action_nonce'], 'comicpress-' . $_REQUEST['cp']['action'])) {
								return $_REQUEST['cp']['action'];
							}
						}
					}
				}
			}
		}
	}
	return false;
}

add_action('widgets_init', '__comicpress_widgets_init');
add_action('init', '__comicpress_init');

global $wpmu_version;
if (!empty($wpmu_version)) {

	if (get_option('upload_path') !== false) {
		$variables_to_extract = array();

		foreach (array(
					'comiccat'            => 'comiccat',
					'blogcat'             => 'blogcat',
					'comics_path'         => 'comic_folder',
					'comicsrss_path'      => 'rss_comic_folder',
					'comicsarchive_path'  => 'archive_comic_folder',
					'comicsmini_path'     => 'mini_comic_folder',
					'archive_comic_width' => 'archive_comic_width',
					'rss_comic_width'     => 'rss_comic_width',
					'mini_comic_width'    => 'mini_comic_width',
					'blog_postcount'      => 'blog_postcount') as $options => $variable_name) {
			$variables_to_extract[$variable_name] = get_option("comicpress-${options}");
		}

		extract($variables_to_extract);
	}

} else {
	require(get_template_directory() . '/comicpress-config.php');
}

function comicpress_load_options() {
	global $comicpress_options;
	$comicpress_options = get_option('comicpress_options');
	if (empty($comicpress_options)) {
		$comicpress_options['comicpress_version'] = '2.9.0.7';
		foreach (array(
			'cp_theme_layout' => 'standard',
			
			'disable_comic_frontpage' => false,
			'disable_comic_blog_frontpage' => false,
			'disable_comic_blog_single' => false,
			'disable_blog_frontpage' => false,
			'disable_lrsidebars_frontpage' => false,
			'disable_footer_text' => false,
			'disable_blogheader' => false,
			'disable_page_titles' => false,
			'static_blog' => false,
			'disable_default_comic_nav' => false,

			'cp_theme_layout' => 'standard',
			'transcript_in_posts' => false,
			'enable_widgetarea_use_sidebar_css' => false,

			'enable_custom_image_header' => false,
			'custom_image_header_width' => '980',
			'custom_image_header_height' => '120',

			'enable_numbered_pagination' => false,
			'disable_page_restraints' => false,

			'enable_related_comics' => false,
			'enable_related_posts' => false,

			'comic_clicks_next' => false,
			'rascal_says' => false,

			'enable_post_calendar' => false,
			'enable_post_author_gravatar' => false,
			'enable_comic_post_calendar' => false,
			'enable_comic_post_author_gravatar' => false,
			'disable_tags_in_posts' => false,
			'disable_categories_in_posts' => false,
			'disable_comment_note' => false,
			'blogposts_with_comic' => false,
			'remove_wptexturize' => false,

			'moods_directory' => 'default',
			'graphicnav_directory' => 'default',
			'calendar_directory' => 'none',
			'avatar_directory' => 'none',

			'enable_search_in_menubar' => false,
			'enable_rss_in_menubar' => true,
			'enable_navigation_in_menubar' => true,
			'contact_in_menubar' => false,
			'disable_dynamic_menubar_links' => false,
			'disable_default_menubar' => false,

			'archive_display_order' => 'desc',
			'excerpt_or_content_archive' => 'content',
			'excerpt_or_content_search' => 'excerpt',
			'category_thumbnail_postcount' => '-1',

			'members_post_category' => '',

			'split_column_in_two' => false,
			'author_column_one' => '',
			'author_column_two' => '',

			'buy_print_email' => 'philip@frumph.net',
			'buy_print_url' => '/shop/',
			'buy_print_us_amount' => '24.95',
			'buy_print_int_amount' => '29.95',
			'buy_print_add_shipping' => false,
			'buy_print_us_ship' => '4.95',
			'buy_print_int_ship' => '9.95',

			'enable_comicpress_debug' => true,
			'enable_full_post_check' => false,

			'enable_blogroll_off_links' => false,
			
			'enable_comment_count_in_rss' => false,
			'enable_scroll_to_top' => false

		) as $field => $value) {
			$comicpress_options[$field] = $value;
		}

		add_option('comicpress_options', $comicpress_options, '', 'yes');
		// update_option('comicpress_options', $comicpress_options);
	}
	$comicpress_options['comicpress_version'] = '2.9.0.7';
	update_option('comicpress_options', $comicpress_options);
	return $comicpress_options;
}

function is_cp_theme_layout($choices) {
	$comicpress_options = comicpress_load_options();
	$choices = explode(",", $choices);
	foreach ($choices as $choice) {
		if ($comicpress_options['cp_theme_layout'] == $choice) {
			return true;
		}
	}
	return false;
}

/**
 * Remove of wordpress auto-texturizer.
 * Dependant on the need remove the commented out areas of this code.
 * Ex. Russian Language users will need to uncomment all of these to handle the character set dependant on
 * if they utilize the language translation pack.
 **/
if ($comicpress_options['remove_wptexturize']) {
	remove_filter('the_content', 'wptexturize');
	// remove_filter('the_content', 'wpautop');
	// remove_filter('the_title', 'wptexturize');
	// remove_filter('the_excerpt', 'wptexturize');
	// remove_filter('comment_text', 'wptexturize');
}

// WIDGETS WP 2.8 compatible ONLY, no backwards compatibility here.
$dirs_to_search = array_unique(array(get_template_directory(), get_stylesheet_directory()));
$__comicpress_handlable_classes = array();
foreach ($dirs_to_search as $dir) {
	foreach (array('widgets' => 'php', 'functions' => 'php', 'classes' => 'inc') as $folder => $extension) {
		foreach (glob($dir . "/${folder}/*.${extension}") as $__file) {
			require_once($__file);
			$__class_name = preg_replace('#\..*$#', '', basename($__file));
			if (class_exists($__class_name)) {
				if (method_exists($__class_name, '__comicpress_init')) {
					add_action('comicpress_init', array($__class_name, '__comicpress_init'));
				}

				if (method_exists($__class_name, 'handle_update')) {
					$__comicpress_handlable_classes[] = $__class_name;
				}
			}
		}
	}
}

// Dashboard Menu Comicpress Options and ComicPress CSS
require_once(get_template_directory() . '/comicpress-options.php');
require_once(get_template_directory() . '/comicpress-debug.php');

// If you want to run multiple comics on a single day, define your additional filters here.
// Example: you want to run an additional comic with the filename 2008-01-01-a-my-new-years-comic.jpg.
// Define an additional filter in the list below:
//
// $comic_filename_filters['secondary'] = "{date}-a*.*";
//
// Then show the second comic on your page by calling the_comic with your filter name (PHP tags munged
// to maintain valid file syntax):
//
// < ?php the_comic('secondary'); ? >
//
// Note that it's quite possible to slurp up the wrong file if your expressions are too broad.

$comic_filename_filters = array();

// load all of the comic & non-comic category information
add_action('init', 'get_all_comic_categories');

function get_first_comic() {
  return get_terminal_post_in_category(get_all_comic_categories_as_cat_string(), true);
}

function get_last_comic() {
  return get_terminal_post_in_category(get_all_comic_categories_as_cat_string(), false);
}

/**
* Get the hyperlink to the first comic post in the database.
* @return string The hyperlink to the first comic post, or false.
*/
function get_first_comic_permalink() {
  $terminal = get_first_comic();
  return !empty($terminal) ? get_permalink($terminal->ID) : false;
}

/**
* Get the hyperlink to the last comic post in the database.
* @return string The hyperlink to the first comic post, or false.
*/
function get_last_comic_permalink() {
  $terminal = get_last_comic();
  return !empty($terminal) ? get_permalink($terminal->ID) : false;
}

/**
 * Given a category ID or an array of category IDs, create an exclusion string that will
 * filter out every category but the provided ones.
 */
function get_string_to_exclude_all_but_provided_categories($category) {
  $category_ids = array_keys(get_all_category_objects_by_id());
  if (!is_array($category)) { $category = array($category); }
  return implode(" and ", array_diff($category_ids, $category));
}

/**
 * Get the link to the previous comic from the current one.
 */
function previous_comic_link($format, $link) {
  global $non_comic_categories;
  previous_post_link($format, $link, false, $non_comic_categories);
}

/**
 * Get the link to the next comic from the current one.
 */
function next_comic_link($format, $link) {
  global $non_comic_categories;
  next_post_link($format, $link, false, $non_comic_categories);
}

/**
 * Get the previous comic from the current one.
 */
function get_previous_comic($category = null) { return get_adjacent_comic($category, true); }

/**
 * Get the next comic from the current one.
 */
function get_next_comic($category = null) { return get_adjacent_comic($category); }

/**
 * This is function get_next_comic_permalink
 *
 * @return mixed false if no next comic permalink, else return the permalink
 *
 */
function get_next_comic_permalink() {
	$next_comic = get_next_comic();
	if (is_object($next_comic)) {
		if (isset($next_comic->ID)) {
			return get_permalink($next_comic->ID);
		}
	}
	return false;
}

/**
 * This is function get_previous_comic_permalink
 *
 * @return mixed false if there is no permalink or next previous comic
 *
 */
function get_previous_comic_permalink() {
	$prev_comic = get_previous_comic();
	if (is_object($prev_comic)) {
		if (isset($prev_comic->ID)) {
			return get_permalink($prev_comic->ID);
		}
	}
	return false;
}

/**
 * Get the adjacent comic from the current one.
 * @param int $category The category to use.
 * @param boolean $previous True if the previous chronological comic should be retrieved.
 * @return array The WordPress post object for the comic post.
 */
function get_adjacent_comic($category, $previous = false) {
	global $non_comic_categories;

//	get_all_comic_categories();

	$categories_to_exclude = $non_comic_categories;
	if (!empty($category)) {
		$categories_to_exclude = get_string_to_exclude_all_but_provided_categories($category);
	}

	return get_adjacent_post(false, $categories_to_exclude, $previous);
}

/**
 * Find the terminal post in a specific category.
 */
function get_terminal_post_in_category($categoryID, $first = true) {
  global $post, $wp_query;

  $temp = $wp_query; $wp_query = null;
  $sortOrder = $first ? "asc" : "desc";
  $terminalComicQuery = new WP_Query(); $terminalComicQuery->query("showposts=1&order=${sortOrder}&cat=${categoryID}");
  $terninalPost = false;
  if ($terminalComicQuery->have_posts()) {
    $terminalPost = reset($terminalComicQuery->posts);
  }

  $wp_query = null; $wp_query = $temp;
  return $terminalPost;
}

/**
 * Find the first post in the storyline prior to the current one.
 */
function get_previous_storyline_start() {
  if (($category_id = get_adjacent_storyline_category_id(false)) !== false) {
    return get_terminal_post_in_category($category_id);
  }
  return false;
}

function get_previous_storyline_start_permalink() {
	$prev_story = get_previous_storyline_start();
	if (is_object($prev_story)) {
		if (isset($prev_story->ID)) {
			return get_permalink($prev_story->ID);
		}
	}
	return false;
}

/**
 * Find the first post in the storyline following to the current one.
 */
function get_next_storyline_start() {
  if (($category_id = get_adjacent_storyline_category_id(true)) !== false) {
    return get_terminal_post_in_category($category_id);
  }
  return false;
}

function get_next_storyline_start_permalink() {
	$next_story = get_next_storyline_start();
	if (is_object($next_story)) {
		if (isset($next_story->ID)) {
			return get_permalink($next_story->ID);
		}
	}
	return false;
}

function get_adjacent_storyline_category_id($next = false) {
	global $post, $category_tree;

	$categories = wp_get_post_categories($post->ID);
	if (is_array($categories)) {
		$category_id = reset($categories);
		for ($i = 0, $il = count($category_tree); $i < $il; ++$i) {
			$storyline_category_id = end(explode("/", $category_tree[$i]));

			if ($storyline_category_id == $category_id) {
				$target_index = false;
				if ($next) {
					$target_index = $i + 1;
				} else {
					$target_index = $i - 1;
				}
				if (isset($category_tree[$target_index])) {
					return end(explode('/', $category_tree[$target_index]));
				}
			}
		}
	}
	return false;
}

/**
* Find a comic file in the filesystem.
* @param string $folder The folder name to search.
* @param string $override_post A WP Post object to use in place of global $post.
* @param string $filter The $comic_filename_filters to use.
* @return string The relative path to the comic file, or false if not found.
*/

function get_comic_path($folder = 'comic', $override_post = null, $filter = 'default', $multi = null) {
	$mh = new ComicPressMediaHandling();
	return $mh->get_comic_path($folder, $override_post, $filter, $multi);
}


/**
* Find a comic file in the filesystem and return an absolute URL to that file.
* @param string $folder The folder name to search.
* @param string $override_post A WP Post object to use in place of global $post.
* @param string $filter The $comic_filename_filters to use.
* @return string The absolute URL to the comic file, or false if not found.
*/
function get_comic_url($type = 'comic', $override_post = null, $filter = 'default') {
	foreach (array_unique(array($type, 'comic')) as $which_type) {
		if (($result = get_comic_path($which_type, $override_post, $filter)) !== false) {
			return trailingslashit(get_bloginfo('url')) . $result;
		}
	}
	return false;
}

/**
 *  get_comic_filename
 *	returns the filename of the comic for the individual date.
 *
 */
function get_comic_filename($folder = 'comic', $override_post = null, $filter = 'default') {
	if (($result = get_comic_path($folder, $override_post, $filter)) !== false) {
		return $result;
	}
}

/**
 *  Return a list of the comic categories with a negative value for exclusions
 *  NOTE: need a pre - negative for the first one
 */
function exclude_comic_categories() {
	global $all_comic_categories_as_string;
	if (empty($all_comic_categories_as_string)) get_all_comic_categories_as_cat_string();
	$returnstring = str_replace(",",",-",$all_comic_categories_as_string);
	return $returnstring;
}

/**
 * Turn the tree of comics categories into a string to be fed into wp_query functions.
 */
function get_all_comic_categories_as_cat_string() {
  global $all_comic_categories_as_string, $category_tree;
  if (empty($all_comic_categories_as_string)) {
    $categories = array();
    foreach ($category_tree as $node) {
      $parts = explode("/", $node);
      $categories[] = end($parts);
    }
	$all_comic_categories_as_string = implode(",", $categories);
  }
  return $all_comic_categories_as_string;
}

/**
 * Turn the list of categories into a hash table of category objects.
 */
function get_all_category_objects_by_id() {
  global $categories_by_id;
  if (empty($categories_by_id)) {
    $categories_by_id = array();
    foreach (get_categories("hide_empty=0") as $category_object) {
      $categories_by_id[$category_object->term_id] = $category_object;
    }
  }
  return $categories_by_id;
}

/**
 * Parse all categories and sort them into comics and non-comics categories.
 */
function get_all_comic_categories() {
  global $comiccat, $category_tree, $non_comic_categories;

  $categories_by_id = get_all_category_objects_by_id();

  foreach (array_keys($categories_by_id) as $category_id) {
    $category_tree[] = $categories_by_id[$category_id]->parent . '/' . $category_id;
  }

  do {
    $all_ok = true;
    for ($i = 0; $i < count($category_tree); ++$i) {
      $current_parts = explode("/", $category_tree[$i]);
      if (reset($current_parts) != 0) {

        $all_ok = false;
        for ($j = 0; $j < count($category_tree); ++$j) {
          $j_parts = explode("/", $category_tree[$j]);

          if (end($j_parts) == reset($current_parts)) {
            $category_tree[$i] = implode("/", array_merge($j_parts, array_slice($current_parts, 1)));
            break;
          }
        }
      }
    }
  } while (!$all_ok);

  $non_comic_tree = array();

  if (get_option('comicpress-enable-storyline-support') == 1) {
    $result = get_option("comicpress-storyline-category-order");
    if (!empty($result)) {
      $category_tree = explode(",", $result);
    }
    $non_comic_tree = array_keys($categories_by_id);
    foreach ($category_tree as $node) {
      $parts = explode("/", $node);
      $category_id = end($parts);
      if ($parts[1] == $comiccat) {
        if (($index = array_search($category_id, $non_comic_tree)) !== false) {
          array_splice($non_comic_tree, $index, 1);
        }
      }
    }
  } else {
    $new_category_tree = array();
    foreach ($category_tree as $node) {
      $parts = explode("/", $node);
      if ($parts[1] == $comiccat) {
        $new_category_tree[] = $node;
      } else {
        $non_comic_tree[] = end($parts);
      }
    }
    $category_tree = $new_category_tree;
  }

  $non_comic_categories = implode(" and ", $non_comic_tree);
}

/**
 * Return true if the current post is in the comics category or a child category.
 */
function in_comic_category() {
  global $post, $category_tree;

  $comic_categories = array();
  foreach ($category_tree as $node) {
    $comic_categories[] = end(explode("/", $node));
  }

  return (count(array_intersect($comic_categories, wp_get_post_categories($post->ID))) > 0);
}

// ComicPress Template Functions

function the_comic_filename($filter = 'default') { return get_comic_filename('comic',null, $filter); }
function the_comic($filter = 'default') { echo get_comic_url('comic', null, $filter); }
function the_comic_archive($filter = 'default') { echo get_comic_url('archive', null, $filter); }
function the_comic_rss($filter = 'default') { echo get_comic_url('rss', null, $filter); }
function the_comic_mini($filter = 'default') { echo get_comic_url('mini', null, $filter); }

/**
 * Display the list of Storyline categories.
 */
function comicpress_list_storyline_categories($args = "") {
  global $category_tree;

  $defaults = array(
    'style' => 'list', 'title_li' => __('Storyline','comicpress')
  );

  $r = wp_parse_args($args, $defaults);

  extract($r);

  $categories_by_id = get_all_category_objects_by_id();

  $output = '';
  if ($style == "list") { $output .= '<li class="categories storyline">'; }
  if ($title_li && ($style == "list")) { $output .= $title_li; }
  if ($style == "list") { $output .= "<ul>"; }
  $current_depth = 0;
  foreach ($category_tree as $node) {
    $parts = explode("/", $node);
    $category_id = end($parts);
    $target_depth = count($parts) - 2;
    if ($target_depth > $current_depth) {
      $output .= str_repeat("<li><ul>", ($target_depth - $current_depth));
    }
    if ($target_depth < $current_depth) {
      $output .= str_repeat("</ul></li>", ($current_depth - $target_depth));
    }
    $output .= '<li><a href="' . get_category_link($category_id) . '">';
    $output .= $categories_by_id[$category_id]->cat_name;
    $output .= "</a></li>";
    $current_depth = $target_depth;
  }
  if ($current_depth > 0) {
    $output .= str_repeat("</ul></li>", $current_depth);
  }
  if ($style == "list") { $output .= "</ul></li>"; }
  echo $output;
}

/**
* Display text when image (comic) is hovered
* Text is taken from a custom field named "hovertext"
*/
function the_hovertext() {
	$hovertext = get_post_meta( get_the_ID(), "hovertext", true );
  echo (empty($hovertext)) ? get_the_title() : $hovertext;
}

/**
* Display the comic transcript
* Transcript must be entered into a custom field named "transcript"
* @param string $displaymode, "raw" (straight from the field), "br" (includes html line breaks), "styled" (fully css styled with JavaScript expander)
*/
function the_transcript($displaymode = 'raw') {
	$transcript = get_post_meta( get_the_ID(), "transcript", true );
  switch ($displaymode) {
    case "raw":
      echo $transcript;
      break;
    case "br":
      echo nl2br($transcript);
      break;
    case "styled":
      if (!empty($transcript)) { ?>
        <script type='text/javascript'>
          <!--
            function toggle_expander(id) {
              var e = document.getElementById(id);
              if(e.style.height == 'auto')
                e.style.height = '1px';
              else
              e.style.height = 'auto';
            }
          //-->
        </script>
        <div class="transcript-border"><div id="transcript"><a href="javascript:toggle_expander('transcript-content');" class="transcript-title">&darr; Transcript</a><div id="transcript-content"><?php echo nl2br($transcript); ?><br /><br /></div></div></div>
        <script type='text/javascript'>
          <!--
            document.getElementById('transcript-content').style.height = '1px';
          //-->
        </script><?php
      }
      break;
  }
}

//Insert the comic image into the RSS feed
function comic_feed() {
	foreach (array("rss", "archive", "mini", "comic") as $type) {
		if (($requested_thumbnail_image = get_comic_url($type, $first_comic_in_category)) !== false) {
			$thumbnail_image = $requested_thumbnail_image; break;
		}
	}
	?>
	<p><a href="<?php the_permalink() ?>"><img src="<?php echo $thumbnail_image; ?>" border="0" alt="<?php the_title() ?>" title="<?php the_hovertext() ?>" /></a></p><?php
}

function insert_comic_feed($content) {
	if (is_feed() && in_comic_category()) {
		return comic_feed() . $content;
	} else {
		return $content;
	}
}
add_filter('the_content','insert_comic_feed');

// Register Sidebar and Define Widgets

if ( function_exists('register_sidebar') ) {
	foreach (array(
		__('Left Sidebar', 'comicpress'),
		__('Right Sidebar', 'comicpress'),
		__('Above Header', 'comicpress'),
		__('Header', 'comicpress'),
		__('Menubar', 'comicpress'),
		__('Over Comic', 'comicpress'),
		__('Left of Comic', 'comicpress'),
		__('Right of Comic', 'comicpress'),
		__('Under Comic', 'comicpress'),
		__('Over Blog', 'comicpress'),
		__('Blog', 'comicpress'),
		__('Under Blog', 'comicpress'),
		__('Footer', 'comicpress')
	) as $label) {
		register_sidebar(array(
			'name'=> $label,
			'before_widget' => '
	<div class="widget-head"></div>
	<div id="%1$s" class="widget %2$s">
',
			'after_widget'  => '
	</div>
	<div class="widget-foot"></div>
',
			'before_title'  => '		<h2 class="widgettitle">',
			'after_title'   => '</h2>'
		));
	}
}

function storyline_category_list() {
	$listcats = wp_list_categories('echo=0&title_li=&include='.get_all_comic_categories_as_cat_string());
	$listcats = str_replace("<ul class='children'>", "<ul class='children'> &raquo; ", $listcats);
	echo $listcats;
}

/**
 * function is_active_sidebar
 * check if a sidebar has widgets based on index number or name
 *
 * @param $index - sidebar name made with register_sidebar(array('name'=>'Name of Sidebar'),
 * OR the index # as an int for specific sidebar.
 * @return true if sidebar with $index has widgets, false if not.
 *
 */
function comicpress_is_active_sidebar( $index ) {
	global $wp_registered_sidebars, $_wp_sidebars_widgets;
	if ( is_int($index) ) {
		if (!empty($_wp_sidebars_widgets[sanitize_title("sidebar-$index")]) )
			return true;
	} else {
		$i = 1;
		foreach ( $wp_registered_sidebars as $sidebar => $registered_sidebar ) {
			if ( $index == $registered_sidebar['name'] && !empty($_wp_sidebars_widgets[sanitize_title("sidebar-$i")]) )
				return true;
			$i++;
		}
	}
	return false;
}

function comicpress_copyright() {
	global $wpdb;
	$copyright_dates = $wpdb->get_results("
		SELECT
			YEAR(min(post_date_gmt)) AS firstdate,
			YEAR(max(post_date_gmt)) AS lastdate
		FROM
			$wpdb->posts
		WHERE
			post_status = 'publish'
	");
	$output = '';
	if($copyright_dates) {
		$copyright = "&copy; " . $copyright_dates[0]->firstdate;
		if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
			$copyright .= '-' . $copyright_dates[0]->lastdate;
		}
		$output =  $copyright;
	}
	return $output;
}

function comicpress_check_child_file($filename = '') {
	if (empty($filename)) return false;
	if (get_stylesheet_directory() != get_template_directory()) {
		if (file_exists(get_stylesheet_directory() .'/'. $filename . '.php')) {
			return include(get_stylesheet_directory() .'/'. $filename . '.php');
		}
	}
	return false;
}

function comicpress_gnav_display_css() {
	global $comicpress_options;
	if (file_exists(get_stylesheet_directory() . '/images/nav/' . $comicpress_options['graphicnav_directory'] . '/navstyle.css')) { ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/images/nav/<?php echo $comicpress_options['graphicnav_directory']; ?>/navstyle.css" type="text/css" media="screen" />
<?php } elseif (file_exists(get_template_directory() . '/images/nav/' .$comicpress_options['graphicnav_directory']. '/navstyle.css')) { ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri();  ?>/images/nav/<?php echo $comicpress_options['graphicnav_directory']; ?>/navstyle.css" type="text/css" media="screen" />
<?php }
}

if (comicpress_check_child_file('childfunctions') == false) {}

if ( isset( $_GET['latestcomic'] ) )
	add_action( 'template_redirect', 'latest_comic_jump' );

//to use simply create a URL link to "/?latestcomic"
function latest_comic_jump() {
	wp_redirect( get_permalink( get_terminal_post_in_category(get_all_comic_categories_as_cat_string(), false) ) );
	exit;
}

//Generate a random comic page - to use simply create a URL link to "/?randomcomic"
function random_comic() {
	$randomComicQuery = new WP_Query(); $randomComicQuery->query('showposts=1&orderby=rand&cat='.get_all_comic_categories_as_cat_string());
	while ($randomComicQuery->have_posts()) : $randomComicQuery->the_post();
		$random_comic_id = get_the_ID();
	endwhile;
	wp_redirect( get_permalink( $random_comic_id ) );
	exit;
}

if ( isset( $_GET['randomcomic'] ) )
	add_action( 'template_redirect', 'random_comic' );
	
//Generate a random post page - to use simply create a URL link to "/?randompost"
function random_post() {
	$randomComicQuery = new WP_Query(); $randomComicQuery->query('showposts=1&orderby=rand&cat=-'.exclude_comic_categories());
	while ($randomComicQuery->have_posts()) : $randomComicQuery->the_post();
		$random_comic_id = get_the_ID();
	endwhile;
	wp_redirect( get_permalink( $random_comic_id ) );
	exit;
}

if ( isset( $_GET['randompost'] ) )
	add_action( 'template_redirect', 'random_post' );