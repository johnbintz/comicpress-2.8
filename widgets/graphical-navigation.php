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

class widget_comicpress_graphical_navigation extends WP_Widget {
	function widget_comicpress_graphical_navigation() {
		$widget_ops = array('classname' => 'widget_comicpress_graphical_navigation', 'description' => __('Displays Graphical Navigation Buttons. (used in comic sidebars)','comicpress') );
		$this->WP_Widget('graphicalnavigation', __('Comic Navigation','comicpress'), $widget_ops);
	}

	function comicpress_display_navigation_link($which, $current, $target, $title, $content = '') {
		switch ($which) {
			case 'first':
			
		}
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

	function comicpress_display_navigation_order($order = array()) {
    return array(
			'first', 'storyline-previous', 'previous', 'archives', 'random', 'comictitle', 'comments', 'buyprint', 'next', 'storynext', 'last'
		);
	}

	function widget($args, $instance) {
		global $post;

		if (is_home() || is_single()) {
			$storyline = new ComicPressStoryline();
			$storyline->create_structure(get_option('comicpress-storyline-category-order'));

			$dbi = ComicPressDBInterface::get_instance();
			$dbi->set_comic_categories($storyline->get_comic_categories());

			$navigation = new ComicPressNavigation();
			$navigation->init($storyline);

			$storyline_to_nav_mapping = array(
				
			);

			$this_permalink = get_permalink();

			$temp_query = $wp_query->is_single;
			$wp_query->is_single = true;
			$prev_comic = get_previous_comic_permalink();
			$next_comic = get_next_comic_permalink();
			$wp_query->is_single = $temp_query;
			$temp_query = null;

			$first_comic = get_first_comic_permalink();
			$last_comic = get_last_comic_permalink();

			$prev_story = get_previous_storyline_start_permalink();
			$next_story = get_next_storyline_start_permalink();
			?>

			<div id="comic_navi_wrapper">
			<table id="comic_navi" cellpadding="0" cellspacing="0"><tr><td>
			<?php if ($instance['first'] != 'off') {
				if (!empty($first_comic) && ($first_comic != $this_permalink)) { ?>
					<a href="<?php echo $first_comic; ?>" class="navi navi-first" title="<?php echo $instance['first_title']; ?>"><?php echo $instance['first_title']; ?></a>
				<?php } else { ?>
					<div class="navi navi-first navi-void"><?php echo $instance['first_title']; ?></div>
				<?php }
			}
			if ($instance['story_prev'] != 'off') {
				if (!empty($prev_story)) { ?>
					<a href="<?php echo $prev_story; ?>" class="navi navi-prevchap" title="<?php echo $instance['story_prev_title']; ?>"><?php echo $instance['story_prev_title']; ?></a>
				<?php } else { ?>
					<div class="navi navi-prevchap navi-void"><?php echo $instance['story_prev_title']; ?></div>
				<?php }
			}
			if ($instance['previous'] != 'off') {
				if (!empty($prev_comic)) { ?>
					<a href="<?php echo $prev_comic; ?>" class="navi navi-prev" title="<?php echo $instance['previous_title']; ?>"><?php echo $instance['previous_title']; ?></a>
				<?php } else { ?>
					<div class="navi navi-prev navi-void"><?php echo $instance['previous_title']; ?></div>
				<?php }
			}
			if ($instance['archives'] != 'off' && !empty($instance['archive_path'])) { ?>
				<a href="<?php echo $instance['archive_path']; ?>" class="navi navi-archive" title="<?php echo $instance['archives_title']; ?>"><?php echo $instance['archives_title']; ?></a>
			<?php }
			if ($instance['random'] != 'off') { ?>
				<a href="<?php echo bloginfo('url'); ?>/?randomcomic" class="navi navi-random" title="<?php echo $instance['random_title']; ?>"><?php echo $instance['random_title']; ?></a>
			<?php }
			if ($instance['comictitle'] != 'off') { ?>
				<div class="navi-comictitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
			<?php }
			if ($instance['comments'] != 'off') { ?>
				<a href="<?php the_permalink(); ?>#comment" class="navi navi-comments" title="<?php echo $instance['comments_title']; ?>"><span class="navi-comments-count"><?php comments_number('0', '1', '%'); ?></span><?php echo $instance['comments_title']; ?></a>
			<?php }
			if ($instance['buyprint'] != 'off') { ?>
				<form method="post" title="<?php echo $instance['buyprint_title']; ?>" action="<?php global $buy_print_url; echo $buy_print_url; ?>" class="navi-buyprint-form">
				<input type="hidden" name="comic" value="<?php echo get_the_ID(); ?>" />
				<button class="navi navi-buyprint" type="submit" value="submit"><?php echo $instance['buyprint_title']; ?></button>
				</form>
			<?php }
			if ($instance['next'] != 'off') {
				if (!empty($next_comic)) { ?>
					<a href="<?php echo $next_comic; ?>" class="navi navi-next" title="<?php echo $instance['next_title']; ?>"><?php echo $instance['next_title']; ?></a>
				<?php } else { ?>
					<div class="navi navi-next navi-void"><?php echo $instance['next_title']; ?></div>
				<?php }
			}
			if ($instance['story_next'] != 'off') {
				if (!empty($next_story) && !is_home()) { ?>
					<a href="<?php echo $next_story; ?>" class="navi navi-nextchap" title="<?php echo $instance['story_next_title']; ?>"><?php echo $instance['story_next_title']; ?></a>
				<?php } else { ?>
					<div class="navi navi-nextchap navi-void"><?php echo $instance['story_next_title']; ?></div>
				<?php }
			}
			if ($instance['last'] != 'off') {
				if (!empty($last_comic) && ($last_comic != $this_permalink)) { ?>
					<a href="<?php echo $last_comic; ?>" class="navi navi-last" title="<?php echo $instance['last_title']; ?>"><?php echo $instance['last_title']; ?></a>
				<?php } else { ?>
					<div class="navi navi-last navi-void"><?php echo $instance['last_title']; ?></div>
				<?php }
			} ?>
			</td></tr></table>
			</div>

		<?php }
	}

  /**
	 * Update the current widget instance.
   * @param array $new_instance The new widget instance data.
   * @param array $old_instance The old widget instance data.
   */
	function update($new_instance, $old_instance) {
		$instance = array();

    $all_fields = explode(' ', 'first last story_prev story_next previous random archives comments next buyprint comictitle');

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
			'last' => 'on',
			'story_prev' => 'off',
			'story_next' => 'off',
			'previous' => 'on',
			'random' => 'off',
			'archives' => 'off',
			'comments' => 'off',
			'next' => 'on',
			'archive_path' => '',
			'buyprint' => 'off',
			'comictitle' => 'off'
		);

		$title_defaults = array(
			'first_title' => __('First', 'comicpress'),
			'last_title' => __('Latest', 'comicpress'),
			'story_prev_title' => __('Chapter', 'comicpress'),
			'story_next_title' => __('Chapter', 'comicpress'),
			'previous_title' => __('Previous', 'comicpress'),
			'random_title' => __('Random', 'comicpress'),
			'archives_title' => __('Archives', 'comicpress'),
			'comments_title' => __('Comments', 'comicpress'),
			'next_title' => __('Next', 'comicpress'),
			'buyprint_title' => __('Buy Print', 'comicpress')
	  );

		$instance = wp_parse_args((array)$instance, array_merge($field_defaults, $title_defaults));

		foreach (array(
			'first' => __('First', 'comicpress'),
			'last' => __('Last', 'comicpress'),
			'previous' => __('Previous', 'comicpress'),
			'next' => __('Next', 'comicpress'),
			'story_prev' => __('Previous Chapter', 'comicpress'),
			'story_next' => __('Next Chapter', 'comicpress'),
			'comictitle' => __('Comic Title', 'comicpress'),
			'archives' => __('Archives', 'comicpress'),
			'comments' => __('Comments', 'comicpress'),
			'random' => __('Random', 'comicpress'),
			'buyprint' => __('Buy Print', 'comicpress'),
		) as $field => $label) {
		  $title_field = "${field}_title"; ?>
			<div class="comicpress-field-holder">
				<label>
				  <input id="<?php echo $this->get_field_id($field); ?>"
								 name="<?php echo $this->get_field_name($field); ?>"
								 type="checkbox" class="comicpress-field" value="yes"<?php if ($instance[$field] == "on") { echo ' checked="checked"'; } ?> />
					<strong><?php echo $label; ?><strong>
				</label>

				<div class="comicpress-field">
					<?php if (isset($title_defaults[$title_field])) { ?>
						<input class="widefat"
									 id="<?php echo $this->get_field_id($title_field); ?>"
									 name="<?php echo $this->get_field_name($title_field); ?>"
									 type="text"
									 value="<?php echo attribute_escape($instance[$title_field]); ?>" />
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
						}
					?>
				</div>
		  </div>
		<?php }

		?>

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
register_widget('widget_comicpress_graphical_navigation');

function widget_comicpress_graphical_navigation_init() {
	new widget_comicpress_graphical_navigation();
}

add_action('widgets_init', 'widget_comicpress_graphical_navigation_init');

?>