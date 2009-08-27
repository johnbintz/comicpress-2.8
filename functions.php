<?php

$comicpress_version = '2.8.0.9';

// Remove the wptexturizer from changing the quotes and squotes.
// remove_filter('the_title', 'wptexturize');
// remove_filter('the_content', 'wptexturize');
// remove_filter('the_excerpt', 'wptexturize');
// remove_filter('comment_text', 'wptexturize');

global $wpmu_version;
if (!empty($wpmu_version)) {
	require_once(get_template_directory() . '/wpmu-functions.php');
	
	if (get_option('upload_path') !== false) {
		$variables_to_extract = array();
		
		foreach (array(
					'comiccat'            => 'comiccat',
					'blogcat'             => 'blogcat',
					'comics_path'         => 'comic_folder',
					'comicsrss_path'      => 'rss_comic_folder',
					'comicsarchive_path'  => 'archive_comic_folder',
					'archive_comic_width' => 'archive_comic_width',
					'rss_comic_width'     => 'rss_comic_width',
					'blog_postcount'      => 'blog_postcount') as $option => $variable_name) {
			$variables_to_extract[$variable_name] = get_option("comicpress-${option}");
		}
		
		extract($variables_to_extract);
	}
	
} else {
	require_once(get_template_directory() . '/comicpress-config.php');
}


if (get_option('upload_path') !== false) {
	$variables_to_extract = array();
	
	foreach (array(
				'disable_comic_frontpage'		=> 'disable_comic_frontpage',
				'disable_comic_blog_frontpage'	=> 'disable_comic_blog_frontpage',
				'disable_blog_frontpage'		=> 'disable_blog_frontpage',
				'disable_extended_comments'		=> 'disable_extended_comments',
				'buy_print_email'				=> 'buy_print_email',
				'buy_print_url'					=> 'buy_print_url',
				'buy_print_us_amount'			=> 'buy_print_us_amount',
				'buy_print_int_amount'			=> 'buy_print_int_amount',
				'buy_print_us_ship'				=> 'buy_print_us_ship',
				'buy_print_int_ship'			=> 'buy_print_int_ship',
				'custom_css'					=> 'custom_css',
				'cp_theme_style'				=> 'cp_theme_style',
				'transcript_in_posts'			=> 'transcript_in_posts',
				'enable_widgetarea_use_sidebar_css'	=> 'enable_widgetarea_use_sidebar_css',
				'enable_custom_image_header'	=> 'enable_custom_image_header',
				'custom_image_header_width'		=> 'custom_image_header_width',
				'custom_image_header_height'	=> 'custom_image_header_height',
				'enable_numbered_pagination'	=> 'enable_numbered_pagination',
				'disable_page_restraints'		=> 'disable_page_restraints',
				'enable_dropdown_sidebar'		=> 'enable_dropdown_sidebar',
				'enable_related_comics'			=> 'enable_related_comics',
				'enable_related_posts'			=> 'enable_related_posts',
				'comic_clicks_next'				=> 'comic_clicks_next',
				'anomaly_says'					=> 'anomaly_says',
				'disable_css_style_editor'		=> 'disable_css_style_editor',
				'enable_post_calendar'			=> 'enable_post_calendar',
				'enable_post_author_gravatar'	=> 'enable_post_author_gravatar',
				'enable_comic_post_calendar'	=> 'enable_comic_post_calendar',
				'enable_comic_post_author_gravatar'	=> 'enable_comic_post_author_gravatar',
				'disable_tags_in_posts'			=> 'disable_tags_in_posts',
				'disable_categories_in_posts'	=> 'disable_categories_in_posts',
				'moods_directory'				=> 'moods_directory',
				'graphicnav_directory'			=> 'graphicnav_directory',
				'enable_search_in_menubar'		=> 'enable_search_in_menubar',
				'enable_rss_in_menubar'			=> 'enable_rss_in_menubar',
				'enable_navigation_in_menubar'	=> 'enable_navigation_in_menubar',
				'contact_in_menubar'			=> 'contact_in_menubar' ) as $options => $variable_name) {
		$variables_to_extract[$variable_name] = get_option("comicpress-${options}");
	}
	
	extract($variables_to_extract);
}

if (empty($graphicnav_directory)) $graphicnav_directory = 'default';
if (empty($moods_directory)) $moods_directory = 'default';

function is_cp_theme_style($choices) {
global $cp_theme_style;
	
	$choices = explode(",", $choices);
	foreach ($choices as $choice) {

		if ($choice == $cp_theme_style) { 
			return true; 
		}  
	}	
	return false;
}

require_once(get_template_directory() . '/functions/userpages.php');

// WIDGETS WP 2.8 compatible ONLY, no backwards compatibility here.

require_once(get_template_directory() . '/widgets/control-panel.php');
require_once(get_template_directory() . '/widgets/graphical-navigation.php');
require_once(get_template_directory() . '/widgets/buythisprint.php');
require_once(get_template_directory() . '/widgets/bookmark.php');
require_once(get_template_directory() . '/widgets/transcription.php');
require_once(get_template_directory() . '/widgets/latestthumb.php');
require_once(get_template_directory() . '/widgets/latestcomics.php');
require_once(get_template_directory() . '/widgets/scheduledposts.php');
require_once(get_template_directory() . '/widgets/calendar.php');
require_once(get_template_directory() . '/widgets/randomcomic.php');
require_once(get_template_directory() . '/widgets/randompost.php');
require_once(get_template_directory() . '/widgets/searchtranscript.php');
require_once(get_template_directory() . '/widgets/latestcomicjump.php');
require_once(get_template_directory() . '/widgets/permalink.php');
require_once(get_template_directory() . '/widgets/comicdate.php');
require_once(get_template_directory() . '/widgets/comictitle.php');
require_once(get_template_directory() . '/widgets/comiccomments.php');
require_once(get_template_directory() . '/widgets/menubar.php');
require_once(get_template_directory() . '/widgets/archive-dropdown.php');

// FUNCTIONS & Extra's

require_once(get_template_directory() . '/functions/displaycomic.php');
require_once(get_template_directory() . '/functions/displaycomicpost.php');
require_once(get_template_directory() . '/functions/displayblogpost.php');
require_once(get_template_directory() . '/functions/adminnotes.php');
require_once(get_template_directory() . '/functions/checkbrowser.php');
require_once(get_template_directory() . '/functions/searchcustomfields.php');
require_once(get_template_directory() . '/functions/multicomics.php');
require_once(get_template_directory() . '/functions/rawformatting.php');
require_once(get_template_directory() . '/functions/relatedposts.php');
require_once(get_template_directory() . '/functions/relatedcomics.php');
require_once(get_template_directory() . '/functions/membersonly.php');
require_once(get_template_directory() . '/functions/syndication.php');
require_once(get_template_directory() . '/functions/moods.php');

if ($enable_numbered_pagination == 'yes') {
	require_once(get_template_directory() . '/functions/wp-pagenavi.php');
}

if ($disable_extended_comments == 'no') {
	require_once(get_template_directory() . '/functions/comment-functions.php');
}

// Dashboard Menu Comicpress Options and ComicPress CSS

require_once(get_template_directory() . '/comicpress-options.php');

if ($enable_custom_image_header == 'yes') {
	require_once(get_template_directory() . '/functions/custom-image-header.php');
}

// If any errors occur while searching for a comic file, the error messages will be pushed into here.
$comic_pathfinding_errors = array();

// If ComicPress Manager is installed, use the date format defined there. If not, default to
// Y-m-d.. It's best to use CPM's date definition for improved operability between theme and plugin.

if (defined("CPM_DATE_FORMAT")) {
 define("CP_DATE_FORMAT", CPM_DATE_FORMAT);
} else {
 define("CP_DATE_FORMAT", "Y-m-d");
}

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
$comic_filename_filters['default'] = "{date}*.*";

// load all of the comic & non-comic category information
add_action('init', 'get_all_comic_categories');

function get_first_comic() {
  return get_terminal_post_in_category(get_all_comic_categories_as_cat_string());
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
function get_previous_comic($category = null) { return get_adjacent_comic($category,true); }

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
 * @param boolean $next True if the next chronological comic should be retrieved.
 * @return array The WordPress post object for the comic post.
 */
function get_adjacent_comic($category, $next = false) {
	global $non_comic_categories;
	
//	get_all_comic_categories();
	
	$categories_to_exclude = $non_comic_categories;
	if (!empty($category)) {
		$categories_to_exclude = get_string_to_exclude_all_but_provided_categories($category);
	}
	
	return get_adjacent_post(false, $categories_to_exclude, $next);
}

/**
 * Find the terminal post in a specific category.
 */
function get_terminal_post_in_category($categoryID, $first = true) {
  global $post;

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
  if (($category_id = get_adjacent_storyline_category_id(true)) !== false) {
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
  if (($category_id = get_adjacent_storyline_category_id()) !== false) {
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
if (!function_exists('get_comic_path')) {
	function get_comic_path($folder = 'comic', $override_post = null, $filter = 'default', $multi = null) {
	global $post, $comic_filename_filters, $comic_folder, $archive_comic_folder, $rss_comic_folder, $comic_pathfinding_errors;

	if (isset($comic_filename_filters[$filter])) {
		$filter_to_use = $comic_filename_filters[$filter];
	} else {
		$filter_to_use = '{date}*.*';
	}

	switch ($folder) {
		case "rss": $folder_to_use = $rss_comic_folder; break;
		case "archive": $folder_to_use = $archive_comic_folder; break;
		case "comic": default: $folder_to_use = $comic_folder; break;
	}

	$post_to_use = (is_object($override_post)) ? $override_post : $post;
	$post_date = mysql2date(CP_DATE_FORMAT, $post_to_use->post_date);

	$filter_with_date = str_replace('{date}', $post_date, $filter_to_use);

	$results = array();

	if (count($results = glob("${folder_to_use}/${filter_with_date}")) > 0) {
		if (!empty($multi)) {
			return $results;
		} else {
			return reset($results);
		}
	}

	$comic_pathfinding_errors[] = sprintf(__("Unable to find the file in the <strong>%s</strong> folder that matched the pattern <strong>%s</strong>. Check your WordPress and ComicPress settings.", 'comicpress'), $folder, $filter_with_date);
	return false;
	}
}

/**
* Find a comic file in the filesystem and return an absolute URL to that file.
* @param string $folder The folder name to search.
* @param string $override_post A WP Post object to use in place of global $post.
* @param string $filter The $comic_filename_filters to use.
* @return string The absolute URL to the comic file, or false if not found.
*/
function get_comic_url($folder = 'comic', $override_post = null, $filter = 'default') {
	if (($result = get_comic_path($folder, $override_post, $filter)) !== false) {
		return get_option('home') . '/' . $result;
	} else {
		if (($folder == 'archive' || $folder == 'rss')) {
			if (($result = get_comic_path('comic', $override_post, $filter)) !== false) {
				return get_option('home') . '/' . $result;
			}
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
	//The following is deprecated...
	function comic_display($filter = 'default') { echo get_comic_url('comic', null, $filter); }

function the_comic_archive($filter = 'default') { echo get_comic_url('archive', null, $filter); }
	//The following is deprecated...
	function comic_archive($filter = 'default') { echo get_comic_url('archive', null, $filter); }

function the_comic_rss($filter = 'default') { echo get_comic_url('rss', null, $filter); }
	//The following is deprecated...
	function comic_rss($filter = 'default') { echo get_comic_url('rss', null, $filter); }

/**
 * Display the list of Storyline categories.
 */
function comicpress_list_storyline_categories($args = "") {
  global $category_tree;

  $defaults = array(
    'style' => 'list', 'title_li' => __('Storyline')
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
function comic_feed() { ?>
	<p><a href="<?php the_permalink() ?>"><img src="<?php the_comic_rss() ?>" border="0" alt="<?php the_title() ?>" title="<?php the_hovertext() ?>" /></a></p><?php
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
	register_sidebar(array('name'=>'Left Sidebar','before_widget' => '<ul><li id="%1$s" class="widget %2$s">','after_widget'  => '</li></ul>','before_title'  => '<h2 class="widgettitle">', 'after_title'   => '</h2>' ));
	register_sidebar(array('name'=>'Right Sidebar','before_widget' => '<ul><li id="%1$s" class="widget %2$s">','after_widget'  => '</li></ul>','before_title'  => '<h2 class="widgettitle">', 'after_title'   => '</h2>' ));
	register_sidebar(array('name'=>'Above Header','before_widget' => '<ul><li id="%1$s" class="widget %2$s">','after_widget'  => '</li></ul>','before_title'  => '<h2 class="widgettitle">', 'after_title'   => '</h2>' ));
	register_sidebar(array('name'=>'Header','before_widget' => '<ul><li id="%1$s" class="widget %2$s">','after_widget'  => '</li></ul>','before_title'  => '<h2 class="widgettitle">', 'after_title'   => '</h2>' ));
	register_sidebar(array('name'=>'Menubar','before_widget' => '<ul><li id="%1$s" class="widget %2$s">','after_widget'  => '</li></ul>','before_title'  => '<h2 class="widgettitle">', 'after_title'   => '</h2>' ));
	register_sidebar(array('name'=>'Over Comic','before_widget' => '<ul><li id="%1$s" class="widget %2$s">','after_widget'  => '</li></ul>','before_title'  => '<h2 class="widgettitle">', 'after_title'   => '</h2>' ));
	register_sidebar(array('name'=>'Left of Comic','before_widget' => '<ul><li id="%1$s" class="widget %2$s">','after_widget'  => '</li></ul>','before_title'  => '<h2 class="widgettitle">', 'after_title'   => '</h2>' ));
	register_sidebar(array('name'=>'Right of Comic','before_widget' => '<ul><li id="%1$s" class="widget %2$s">','after_widget'  => '</li></ul>','before_title'  => '<h2 class="widgettitle">', 'after_title'   => '</h2>' ));
	register_sidebar(array('name'=>'Under Comic','before_widget' => '<ul><li id="%1$s" class="widget %2$s">','after_widget'  => '</li></ul>','before_title'  => '<h2 class="widgettitle">', 'after_title'   => '</h2>' ));
	register_sidebar(array('name'=>'Over Blog','before_widget' => '<ul><li id="%1$s" class="widget %2$s">','after_widget'  => '</li></ul>','before_title'  => '<h2 class="widgettitle">', 'after_title'   => '</h2>' ));
	register_sidebar(array('name'=>'Blog','before_widget' => '<ul><li id="%1$s" class="widget %2$s">','after_widget'  => '</li></ul>','before_title'  => '<h2 class="widgettitle">', 'after_title'   => '</h2>' ));
	register_sidebar(array('name'=>'Under Blog','before_widget' => '<ul><li id="%1$s" class="widget %2$s">','after_widget'  => '</li></ul>','before_title'  => '<h2 class="widgettitle">', 'after_title'   => '</h2>' ));
	register_sidebar(array('name'=>'Footer','before_widget' => '<ul><li id="%1$s" class="widget %2$s">','after_widget'  => '</li></ul>','before_title'  => '<h2 class="widgettitle">', 'after_title'   => '</h2>' ));
}     

function storyline_category_list() {
	$listcats = wp_list_categories('echo=0&title_li=&include='.get_all_comic_categories_as_cat_string());
	$listcats = str_replace("<ul class='children'>", "<ul class='children'> &raquo; ", $listcats);
	echo $listcats;
}

/**
 * This is function comicpress_is_active_sidebar
 *
 * @param $name - sidebar name made with register_sidebar(array('name'=>'Name of Sidebar'), 
 * use 'Sidebar 1' .. # if no sidebar names specified.
 * @return true if sidebar with $name has widgets, false if not.
 *
 */
function comicpress_is_active_sidebar( $name ) {
	global $wp_registered_sidebars, $_wp_sidebars_widgets;
	$i = 1;
	foreach ( $wp_registered_sidebars as $sidebar => $registered_sidebar ) {
		if ( $name == $registered_sidebar['name'] && !empty($_wp_sidebars_widgets[sanitize_title("sidebar-$i")]) )
			return true;
		$i++; 
	}
	return false;
}

function cp_copyright_year() {
	$latest_comic = get_terminal_post_in_category('',true);
	$archive_year = get_post_time('Y', false, $latest_comic, true);
	$current_year = date('Y');
	if ($archive_year == $current_year) {
		$return_year = $current_year;
	} else {
		$return_year = $archive_year . '-' . $current_year;
	}
	return $return_year;
}

?>