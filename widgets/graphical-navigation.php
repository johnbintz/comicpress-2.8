<?php
/*
Widget Name: Graphical Navigation
Widget URI: http://comicpress.org/
Description: This widget places graphical navigation buttons on your comic. For ComicPress 2.8
Author: Philip M. Hofer (Frumph) &amp; John Bintz
Version: 1.2
Author URI: http://webcomicplanet.com/
*/

require_once(dirname(__FILE__) . '/../classes/ComicPressNavigation.inc');

class WidgetComicPressGraphicalStorylineNavigation extends WP_Widget {
	function WidgetComicPressGraphicalStorylineNavigation() {
		$widget_ops = array('classname' => 'WidgetComicPressGraphicalStorylineNavigation', 'description' => __('Displays Graphical Navigation Buttons. (used in comic sidebars)','comicpress') );
		$this->WP_Widget('graphicalstorylinenavigation', __('Comic Navigation','comicpress'), $widget_ops);
	}

	/**
	 * Initialize the widget class.
	 */
	function init() {
		add_filter('comicpress_display_navigation_order', array(&$this, 'comicpress_display_navigation_order'));
		add_filter('comicpress_display_navigation_link', array(&$this, 'comicpress_display_navigation_link'), 10, 5);
		add_filter('comicpress_wrap_navigation_buttons', array(&$this, 'comicpress_wrap_navigation_buttons'), 10, 2);
    add_filter('comicpress_navigation_grouping_details', array(&$this, 'comicpress_navigation_grouping_details'));

		// these two need to be moved one level up
		add_filter('comicpress_get_random_link_url', array(&$this, 'comicpress_get_random_link_url'));
		add_filter('comicpress_get_buy_print_url', array(&$this, 'comicpress_get_buy_print_url'));
	}

	/**
	 * Get the random link URL.
	 */
	function comicpress_get_random_link_url($url = '') {
		return get_bloginfo('url') . '/?randomcomic';
	}

	/**
	 * Get the URL to buy a print.
	 * Handles hitting the global namespace for you.
	 */
	function comicpress_get_buy_print_url($url = '') {
		global $buy_print_url;
		return $buy_print_url;
	}

	/**
	 * Render a button.
	 */
	function comicpress_display_navigation_link($which, $current, $target, $instance, $content = '') {
		global $id;

    $css_name_mapping = array(
      'story_prev' => 'prevchap',
      'previous'   => 'prev',
      'story_next' => 'nextchap'
    );

		$ok = true;
		switch ($which) {
      case 'first':
      case 'last':
				$ok = $this->_will_display_nav_link($which, $current, $target);
				break;
      case 'previous':
      case 'next':
      case 'story_prev':
      case 'story_next':
      case 'story_prev_in':
      case 'story_next_in':
				$ok = !empty($target);
			  break;
			case 'archives':
				$ok = !empty($instance['archive_path']);
				break;
		}

		ob_start();
		switch ($which) {
      case 'first':
      case 'previous':
      case 'next':
      case 'last':
      case 'story_prev':
      case 'story_next':
      case 'story_prev_in':
      case 'story_next_in':
        $navi_class_names = array("navi-${which}");
        if (isset($css_name_mapping[$which])) { $navi_class_names[] = "navi-{$css_name_mapping[$which]}"; }

				$link = get_permalink($target->ID);
				if (($which == 'last') && ($instance['lastgohome'] == 'on')) { $link = get_bloginfo('url'); }
				if ($ok) {
				  ?><a href="<?php echo $link; ?>"
					  	 class="navi <?php echo implode(" ", $navi_class_names); ?>"
					title="<?php echo $instance["${which}_title"]; ?>"><?php echo htmlspecialchars_decode($instance["${which}_title"]); ?></a><?php
				} else {
					?><div class="navi <?php echo implode(" ", $navi_class_names); ?> navi-void"><?php echo htmlspecialchars_decode($instance["${which}_title"]); ?></div><?php
				}
			  break;
			case 'archives':
				?><a href="<?php echo $instance['archive_path']; ?>"
				     class="navi navi-archives navi-archive"
						 title="<?php echo $instance['archives_title']; ?>"><?php echo $instance['archives_title']; ?></a><?php
				break;
			case 'random':
			  ?><a href="<?php echo apply_filters('comicpress_get_random_link_url', '') ?>"
					   class="navi navi-random"
						 title="<?php echo $instance['random_title']; ?>"><?php echo $instance['random_title']; ?></a><?php
				break;
			case 'comictitle':
			  ?><div class="navi-comictitle"><a href="<?php echo get_permalink($current) ?>"><?php echo get_the_title($current->ID); ?></a></div><?php
				break;
			case 'comments':
				$temp_id = $id;
				$id = $current->ID;
			  ?><a href="<?php echo get_permalink($current); ?>#comment"
						 class="navi navi-comments"
						 title="<?php echo $instance['comments_title']; ?>"><span class="navi-comments-count"><?php comments_number('0', '1', '%'); ?></span><?php echo $instance['comments_title']; ?></a><?php
				$id = $temp_id;
				break;
			case 'buyprint':
				?><form method="post"
								title="<?php echo $instance['buyprint_title']; ?>"
								action="<?php echo apply_filters('comicpress_get_buy_print_url', ''); ?>"
								class="navi-buyprint-form">
						<input type="hidden" name="comic" value="<?php echo $current->ID; ?>" />
						<button class="navi navi-buyprint"
									  type="submit"
										value="submit"><?php echo $instance['buyprint_title']; ?></button>
				</form><?php
				break;
		}
		return array($which, $current, $target, $instance, ob_get_clean());
	}

	/**
	 * Returns true if the combination of target and current post will show or hide this nav link.
	 * Different from whether or not a user explicitly hid this link.
	 * @param string $which The link to test.
	 * @param object $current The currently visible post.
	 * @param object $target The target post to comare to.
	 * @return boolean True if this link should be visible.
	 */
	function _will_display_nav_link($which, $current, $target) {
		switch ($which) {
			case 'first':
			case 'last':
				return ($target->ID != $current->ID);
			default:
				return true;
		}
	}

	/**
	 * Get the order of the buttons to be displayed on-screen.
	 */
	function comicpress_display_navigation_order($order = array()) {
    return array(
			'first', 'previous', 'story_prev_in', 'story_prev', 'archives', 'random', 'comictitle', 'comments', 'buyprint', 'story_next', 'story_next_in', 'next', 'last'
		);
	}

  function comicpress_navigation_grouping_details($details = array()) {
    return array(
      'comic_navi_left' => array('first', 'previous', 'story_prev_in', 'story_prev'),
      'comic_navi_center' => true,
      'comic_navi_right' => array('story_next', 'story_next_in', 'next', 'last')
    );
  }

  function _group_navigation_buttons($buttons = array(), $grouped_buttons = array()) {
    $grouping_hash = array();

    $default_group = null;
    foreach (apply_filters('comicpress_navigation_grouping_details', array()) as $group => $members) {
      if ($members === true) {
        $default_group = $group;
      } else {
        foreach ($members as $member) { $grouping_hash[$member] = $group; }
      }
    }

    if (is_null($default_group)) {
      trigger_error('No default group defined for filter comicpress_navigation_grouping_details', E_USER_WARNING);
    }

    $groups = array();
    foreach ($buttons as $key => $button) {
      $group = isset($grouping_hash[$key]) ? $grouping_hash[$key] : $default_group;
      if (!empty($group)) {
        if (!isset($groups[$group])) { $groups[$group] = array(); }
        $groups[$group][$key] = $button;
      }
    }

    return $groups;
  }

	/**
	 * Wrap navigation buttons in a holder.
	 * @param string|array $buttons The buttons to wrap.
	 * @param string $content The wrapped content.
	 */
	function comicpress_wrap_navigation_buttons($buttons = '', $content = '') {
		$buttons_text = $buttons;
	  if (is_array($buttons)) {
      $output = array();
      foreach ($this->_group_navigation_buttons($buttons) as $group => $grouped_buttons) {
        $output[] = '<div class="' . $group . '">' . implode('', array_values($grouped_buttons)) . '</div>';
      }

      $buttons_text = implode('', $output);
    }
		ob_start(); ?>
			<div id="comic_navi_wrapper">
				<div class="comic_navi">
					<?php echo $buttons_text; ?>
					<div class="clear"></div>
				</div>
			</div>
		<?php
		return array($buttons, $content);
	}

	/**
	 * Render the widget.
	 */
	function widget($args, $instance) {
		global $post;

		if (is_home() || is_single()) {
			$storyline = new ComicPressStoryline();
			$storyline->create_structure(get_option('comicpress-storyline-category-order'));

			$dbi = ComicPressDBInterface::get_instance();
			$dbi->set_comic_categories($storyline->get_comic_categories());

			$navigation = new ComicPressNavigation();
			$navigation->init($storyline);
			$post_nav = $navigation->get_post_nav($post);

			if ($instance['story_prev_acts_as_prev_in']) {
				if ($post_nav['storyline-previous'] !== false) {
					$post_nav['storyline-chapter-previous'] = $post_nav['storyline-previous'];
				}
			}

			$storyline_to_nav_mapping = array(
				'story_prev' => 'storyline-chapter-previous',
				'story_next' => 'storyline-chapter-next',
        'story_prev_in' => 'storyline-previous',
        'story_next_in' => 'storyline-next'
			);

			$nav_links = array();
			foreach (apply_filters('comicpress_display_navigation_order', array()) as $order) {
				if ($instance[$order] == "on") {
					$target_post_nav = (isset($storyline_to_nav_mapping[$order])) ? $storyline_to_nav_mapping[$order] : $order;

					$target_post = null;
					if (isset($post_nav[$target_post_nav])) { $target_post = $post_nav[$target_post_nav]; }

					$nav_links[$order] = end(apply_filters('comicpress_display_navigation_link', $order, $post, $target_post, $instance, ''));
				}
			}

			echo end(apply_filters('comicpress_wrap_navigation_buttons', $nav_links, ''));
		}
	}

  /**
	 * Update the current widget instance.
   * @param array $new_instance The new widget instance data.
   * @param array $old_instance The old widget instance data.
   */
	function update($new_instance, $old_instance) {
		$instance = array();

    $all_fields = array(
		  'first', 'story_prev', 'story_next', 'story_prev_in',
		  'story_next_in', 'previous', 'random', 'archives',
			'comments', 'next', 'last', 'buyprint', 'comictitle', 'lastgohome',
			'story_prev_acts_as_prev_in'
		);

    foreach ($all_fields as $field) {
      $instance[$field] = (isset($new_instance[$field])) ? 'on' : 'off';
      if (isset($new_instance["${field}_title"])) {
				$instance["${field}_title"] = strip_tags($new_instance["${field}_title"]);
      }
    }

    $instance['archive_path'] = strip_tags($new_instance['archive_path']);

		return $instance;
	}

	function form($instance) {
		$field_defaults = array(
			'first' => 'on',
			'story_prev' => 'off',
      'story_prev_in' => 'off',
			'story_next' => 'off',
      'story_next_in' => 'off',
			'previous' => 'on',
			'random' => 'off',
			'archives' => 'off',
			'comments' => 'off',
			'next' => 'on',
			'last' => 'on',
			'archive_path' => '',
			'buyprint' => 'off',
			'comictitle' => 'off',
			'lastgohome' => 'off',
			'story_prev_acts_as_prev_in' => 'on'
		);

		$title_defaults = array(
			'first_title' => __('&lsaquo;&lsaquo; First', 'comicpress'),
			'story_prev_title' => __('Chapter', 'comicpress'),
			'story_next_title' => __('Chapter', 'comicpress'),
      'story_prev_in_title' => __('In Chapter', 'comicpress'),
      'story_next_in_title' => __('In Chapter', 'comicpress'),
			'previous_title' => __('&lsaquo; Previous', 'comicpress'),
			'random_title' => __('Random', 'comicpress'),
			'archives_title' => __('Archives', 'comicpress'),
			'comments_title' => __('Comments', 'comicpress'),
			'next_title' => __('Next &rsaquo;', 'comicpress'),
			'last_title' => __('Last &rsaquo;&rsaquo;', 'comicpress'),
			'buyprint_title' => __('Buy Print', 'comicpress')
	  );

		$instance = wp_parse_args((array)$instance, array_merge($field_defaults, $title_defaults));

		foreach (array(
			'first' => __('&lsaquo;&lsaquo; First', 'comicpress'),
			'previous' => __('&lsaquo; Previous', 'comicpress'),
			'next' => __('Next &rsaquo;', 'comicpress'),
			'last' => __('Last &rsaquo;&rsaquo;', 'comicpress'),
			'story_prev' => __('Previous Chapter', 'comicpress'),
			'story_next' => __('Next Chapter', 'comicpress'),
      'story_prev_in' => __('Previous In Chapter', 'comicpress'),
      'story_next_in' => __('Next In Chapter', 'comicpress'),
			'comictitle' => __('Comic Title', 'comicpress'),
			'archives' => __('Archives', 'comicpress'),
			'comments' => __('Comments', 'comicpress'),
			'random' => __('Random', 'comicpress'),
			'buyprint' => __('Buy Print', 'comicpress')
		) as $field => $label) {
		  $title_field = "${field}_title"; ?>
			<div class="comicpress-field-holder">
				<label>
				  <input id="<?php echo $this->get_field_id($field); ?>"
								 name="<?php echo $this->get_field_name($field); ?>"
								 type="checkbox" class="comicpress-field" value="yes"<?php if ($instance[$field] == "on") { echo ' checked="checked"'; } ?> />
					<strong><?php echo $label; ?></strong>
				</label>

				<div class="comicpress-field">
					<?php if (isset($title_defaults[$title_field])) { ?>
						<input class="widefat"
									 id="<?php echo $this->get_field_id($title_field); ?>"
									 name="<?php echo $this->get_field_name($title_field); ?>"
									 type="text"
				value="<?php echo htmlspecialchars($instance[$title_field]); ?>" />
					<?php } ?>

					<?php
					  switch($field) {
							case "archives": ?>
								<div>
									<?php _e('Archive URL:', 'comicpress') ?>
									<br />
									<input class="widefat"
												 id="<?php echo $this->get_field_id('archive_path'); ?>"
												 name="<?php echo $this->get_field_name('archive_path'); ?>"
												 type="text"
												 value="<?php echo attribute_escape($instance['archive_path']); ?>" />
								</div>
							<?php break;
							case "last": ?>
								<div>
									<label>
									  <input id="<?php echo $this->get_field_id('lastgohome'); ?>"
													 name="<?php echo $this->get_field_name('lastgohome'); ?>"
													 type="checkbox" class="comicpress-field" value="yes"<?php if ($instance['lastgohome'] == "on") { echo ' checked="checked"'; } ?> />
										<strong><?php _e('...go Home instead of Last', 'comicpress'); ?></strong>
									</label>
								</div>
							<?php break;
							case "story_prev": ?>
								<div>
									<label>
									  <input id="<?php echo $this->get_field_id('story_prev_acts_as_prev_in'); ?>"
													 name="<?php echo $this->get_field_name('story_prev_acts_as_prev_in'); ?>"
													 type="checkbox" class="comicpress-field" value="yes"<?php if ($instance['story_prev_acts_as_prev_in'] == "on") { echo ' checked="checked"'; } ?> />
										<strong><?php _e('...only go prev. chapter if at start', 'comicpress'); ?></strong>
									</label>
								</div>
							<?php break;
						}
					?>
				</div>
		  </div>
		<?php }	?>

		<script type="text/javascript">
			var _get_comicpress_show_hide_text = function(container, immediate) {
			  return function(e) {
					var checkbox = jQuery('.comicpress-field[type=checkbox]', container).get(0);
					if (checkbox) {
						jQuery('div.comicpress-field', container)[checkbox.checked ? 'show' : 'hide'](immediate ? null : 'fast');
					}
				}
			};

			jQuery('.comicpress-field-holder').each(function(fh) {
				jQuery('.comicpress-field[type=checkbox]', this).bind('click', _get_comicpress_show_hide_text(this, false));
				_get_comicpress_show_hide_text(this, true)();
			});
		</script>

		<?php
	}
}
register_widget('WidgetComicPressGraphicalStorylineNavigation');

/**
 * Handle pre-init stuff.
 * In this case, instantiate a copy of the widget and hook up its filters.
 * The original will hang around due to the callback references. Don't use any
 * object properties in those filters!
 */
function WidgetComicPressGraphicalStorylineNavigation_init() {
	$a = new WidgetComicPressGraphicalStorylineNavigation();
	$a->init();
}

add_action('widgets_init', 'WidgetComicPressGraphicalStorylineNavigation_init');

?>