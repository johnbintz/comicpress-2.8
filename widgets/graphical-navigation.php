<?php
/*
Widget Name: Graphical Navigation
Widget URI: http://comicpress.org/
Description: This widget places graphical navigation buttons on your comic. For ComicPress 2.8
Author: Philip M. Hofer (Frumph) &amp; John Bintz
Version: 1.2
Author URI: http://webcomicplanet.com/

*/

class widget_comicpress_graphical_navigation extends WP_Widget {

	function widget_comicpress_graphical_navigation() {
		$widget_ops = array('classname' => 'widget_comicpress_graphical_navigation', 'description' => __('Displays Graphical Navigation Buttons. (used in comic sidebars)','comicpress') );
		$this->WP_Widget('graphicalnavigation', __('Comic Navigation','comicpress'), $widget_ops);
	}

	function widget($args, $instance) {
		global $wp_query, $post;

		if (is_home() || is_single()) {

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
      if (isset($new_instance[$field])) {
        $instance[$field] = $new_instance[$field];
      }
      if (isset($new_instance["${field}_title"])) {
        $instance["${field}_title"] = strip_tags($new_instance["${field}_title"]);
      }
    }

    $instance['archive_path'] = strip_tags($new_instance['archive_path']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array(
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
					'first_title' => 'First',
					'last_title' => 'Latest',
					'story_prev_title' => 'Chapter',
					'story_next_title' => 'Chapter',
					'previous_title' => 'Previous',
					'random_title' => 'Random',
					'archives_title' => 'Archives',
					'comments_title' => 'Comments',
					'next_title' => 'Next',
					'buyprint_title' => 'Buy Print',
					'comictitle' => 'off'
		 ) );
		$first = $instance['first']; if (empty($first)) $first = 'on';
		$last = $instance['last']; if (empty($last)) $last = 'on';
		$story_prev = $instance['story_prev']; 	if (empty($story_prev)) $story_prev = 'off';
		$story_next = $instance['story_next']; 	if (empty($story_next)) $story_next = 'off';
		$previous = $instance['previous']; 	if (empty($previous)) $previous = 'on';
		$random = $instance['random']; if (empty($random)) $random = 'off';
		$archives = $instance['archives']; if (empty($archives)) $archives = 'off';
		$comments = $instance['comments']; if (empty($comments)) $comments = 'off';
		$archive_path = $instance['archive_path'];
		$next = $instance['next']; if (empty($next)) $next = 'on';
		$buyprint = $instance['buyprint']; if (empty($buyprint)) $buyprint = 'off';
		$comictitle = $instance['comictitle']; if (empty($comictitle)) $comictitle = 'off';


		$first_title = $instance['first_title'];
		$last_title = $instance['last_title'];
		$story_prev_title = $instance['story_prev_title'];
		$story_next_title = $instance['story_next_title'];
		$previous_title = $instance['previous_title'];
		$random_title = $instance['random_title'];
		$archives_title = $instance['archives_title'];
		$comments_title = $instance['comments_title'];
		$next_title = $instance['next_title'];
		$buyprint_title = $instance['buyprint_title'];




		?>

		<label for="<?php echo $this->get_field_id('first'); ?>"><strong><?php _e('First','comicpress'); ?></strong><br />
		<input id="<?php echo $this->get_field_id('first'); ?>" name="<?php echo $this->get_field_name('first'); ?>" type="radio" value="on"<?php if ( $first == "on") { echo " checked"; } ?> />On</label>&nbsp;<input id="<?php echo $this->get_field_id('first'); ?>" name="<?php echo $this->get_field_name('first'); ?>" type="radio" value="off"<?php if ( $first == "off") { echo " checked"; } ?> />Off</label><br />
		Title:<br />
		<input class="widefat" id="<?php echo $this->get_field_id('first_title'); ?>" name="<?php echo $this->get_field_name('first_title'); ?>" type="text" value="<?php echo attribute_escape($first_title); ?>" /></label><br />

		<br />
		<label for="<?php echo $this->get_field_id('last'); ?>"><strong><?php _e('Last','comicpress'); ?></strong><br />
		<input id="<?php echo $this->get_field_id('last'); ?>" name="<?php echo $this->get_field_name('last'); ?>" type="radio" value="on"<?php if ( $last == "on") { echo " checked"; } ?> />On</label>&nbsp;<input id="<?php echo $this->get_field_id('last'); ?>" name="<?php echo $this->get_field_name('last'); ?>" type="radio" value="off"<?php if ( $last == "off") { echo " checked"; } ?> />Off</label><br />
		Title:<br />
		<input class="widefat" id="<?php echo $this->get_field_id('last_title'); ?>" name="<?php echo $this->get_field_name('last_title'); ?>" type="text" value="<?php echo attribute_escape($last_title); ?>" /></label><br />

		<br />
		<label for="<?php echo $this->get_field_id('previous'); ?>"><strong><?php _e('Previous','comicpress'); ?></strong><br />
		<input id="<?php echo $this->get_field_id('previous'); ?>" name="<?php echo $this->get_field_name('previous'); ?>" type="radio" value="on"<?php if ( $previous == "on") { echo " checked"; } ?> />On</label>&nbsp;<input id="<?php echo $this->get_field_id('previous'); ?>" name="<?php echo $this->get_field_name('previous'); ?>" type="radio" value="off"<?php if ( $previous == "off") { echo " checked"; } ?> />Off</label><br />
		Title:<br />
		<input class="widefat" id="<?php echo $this->get_field_id('previous_title'); ?>" name="<?php echo $this->get_field_name('previous_title'); ?>" type="text" value="<?php echo attribute_escape($previous_title); ?>" /></label><br />

		<br />
		<label for="<?php echo $this->get_field_id('next'); ?>"><strong><?php _e('Next','comicpress'); ?></strong><br />
		<input id="<?php echo $this->get_field_id('next'); ?>" name="<?php echo $this->get_field_name('next'); ?>" type="radio" value="on"<?php if ( $next == "on") { echo " checked"; } ?> />On</label>&nbsp;<input id="<?php echo $this->get_field_id('next'); ?>" name="<?php echo $this->get_field_name('next'); ?>" type="radio" value="off"<?php if ( $next == "off") { echo " checked"; } ?> />Off</label><br />
		Title:<br />
		<input class="widefat" id="<?php echo $this->get_field_id('next_title'); ?>" name="<?php echo $this->get_field_name('next_title'); ?>" type="text" value="<?php echo attribute_escape($next_title); ?>" /></label><br />

		<br />
		<label for="<?php echo $this->get_field_id('story_prev'); ?>"><strong><?php _e('Previous Chapter','comicpress'); ?></strong><br />
		<input id="<?php echo $this->get_field_id('story_prev'); ?>" name="<?php echo $this->get_field_name('story_prev'); ?>" type="radio" value="on"<?php if ( $story_prev == "on") { echo " checked"; } ?> />On</label>&nbsp;<input id="<?php echo $this->get_field_id('story_prev'); ?>" name="<?php echo $this->get_field_name('story_prev'); ?>" type="radio" value="off"<?php if ( $story_prev == "off") { echo " checked"; } ?> />Off</label><br />
		Title:<br />
		<input class="widefat" id="<?php echo $this->get_field_id('story_prev_title'); ?>" name="<?php echo $this->get_field_name('story_prev_title'); ?>" type="text" value="<?php echo attribute_escape($story_prev_title); ?>" /></label><br />

		<br />
		<label for="<?php echo $this->get_field_id('story_next'); ?>"><strong><?php _e('Next Chapter','comicpress'); ?></strong><br />
		<input id="<?php echo $this->get_field_id('story_next'); ?>" name="<?php echo $this->get_field_name('story_next'); ?>" type="radio" value="on"<?php if ( $story_next == "on") { echo " checked"; } ?> />On</label>&nbsp;<input id="<?php echo $this->get_field_id('story_next'); ?>" name="<?php echo $this->get_field_name('story_next'); ?>" type="radio" value="off"<?php if ( $story_next == "off") { echo " checked"; } ?> />Off</label><br />
		Title:<br />
		<input class="widefat" id="<?php echo $this->get_field_id('story_next_title'); ?>" name="<?php echo $this->get_field_name('story_next_title'); ?>" type="text" value="<?php echo attribute_escape($story_next_title); ?>" /></label><br />

		<br />
		<label for="<?php echo $this->get_field_id('comictitle'); ?>"><strong><?php _e('Comic Title','comicpress'); ?></strong><br />
		<input id="<?php echo $this->get_field_id('comictitle'); ?>" name="<?php echo $this->get_field_name('comictitle'); ?>" type="radio" value="on"<?php if ( $comictitle == "on") { echo " checked"; } ?> />On</label>&nbsp;<input id="<?php echo $this->get_field_id('comictitle'); ?>" name="<?php echo $this->get_field_name('comictitle'); ?>" type="radio" value="off"<?php if ( $comictitle == "off") { echo " checked"; } ?> />Off<br />

		<br />
		<label for="<?php echo $this->get_field_id('archives'); ?>"><strong><?php _e('Archives','comicpress'); ?></strong><br />
		<input id="<?php echo $this->get_field_id('archives'); ?>" name="<?php echo $this->get_field_name('archives'); ?>" type="radio" value="on"<?php if ( $archives == "on") { echo " checked"; } ?> />On</label>&nbsp;<input id="<?php echo $this->get_field_id('archives'); ?>" name="<?php echo $this->get_field_name('archives'); ?>" type="radio" value="off"<?php if ( $archives == "off") { echo " checked"; } ?> />Off<br />
		Title:<br />
		<input class="widefat" id="<?php echo $this->get_field_id('archives_title'); ?>" name="<?php echo $this->get_field_name('archives_title'); ?>" type="text" value="<?php echo attribute_escape($archives_title); ?>" /></label><br />
		Archive URL:<br />
		<input class="widefat" id="<?php echo $this->get_field_id('archive_path'); ?>" name="<?php echo $this->get_field_name('archive_path'); ?>" type="text" value="<?php echo attribute_escape($archive_path); ?>" /></label><br />

		<br />
		<label for="<?php echo $this->get_field_id('comments'); ?>"><strong><?php _e('Comments','comicpress'); ?></strong><br />
		<input id="<?php echo $this->get_field_id('comments'); ?>" name="<?php echo $this->get_field_name('comments'); ?>" type="radio" value="on"<?php if ( $comments == "on") { echo " checked"; } ?> />On</label>&nbsp;<input id="<?php echo $this->get_field_id('comments'); ?>" name="<?php echo $this->get_field_name('comments'); ?>" type="radio" value="off"<?php if ( $comments == "off") { echo " checked"; } ?> />Off</label><br />
		Title:<br />
		<input class="widefat" id="<?php echo $this->get_field_id('comments_title'); ?>" name="<?php echo $this->get_field_name('comments_title'); ?>" type="text" value="<?php echo attribute_escape($comments_title); ?>" /></label><br />

		<br />
		<label for="<?php echo $this->get_field_id('random'); ?>"><strong><?php _e('Random','comicpress'); ?></strong><br />
		<input id="<?php echo $this->get_field_id('random'); ?>" name="<?php echo $this->get_field_name('random'); ?>" type="radio" value="on"<?php if ( $random == "on") { echo " checked"; } ?> />On</label>&nbsp;<input id="<?php echo $this->get_field_id('random'); ?>" name="<?php echo $this->get_field_name('random'); ?>" type="radio" value="off"<?php if ( $random == "off") { echo " checked"; } ?> />Off</label><br />
		Title:<br />
		<input class="widefat" id="<?php echo $this->get_field_id('random_title'); ?>" name="<?php echo $this->get_field_name('random_title'); ?>" type="text" value="<?php echo attribute_escape($random_title); ?>" /></label><br />

		<br />
		<label for="<?php echo $this->get_field_id('buyprint'); ?>"><strong><?php _e('Buy Print','comicpress'); ?></strong><br />
		<input id="<?php echo $this->get_field_id('buyprint'); ?>" name="<?php echo $this->get_field_name('buyprint'); ?>" type="radio" value="on"<?php if ( $buyprint == "on") { echo " checked"; } ?> />On</label>&nbsp;<input id="<?php echo $this->get_field_id('buyprint'); ?>" name="<?php echo $this->get_field_name('buyprint'); ?>" type="radio" value="off"<?php if ( $buyprint == "off") { echo " checked"; } ?> />Off</label><br />
		Title:<br />
		<input class="widefat" id="<?php echo $this->get_field_id('buyprint_title'); ?>" name="<?php echo $this->get_field_name('buyprint_title'); ?>" type="text" value="<?php echo attribute_escape($buyprint_title); ?>" /></label><br />


		<?php
	}
}
register_widget('widget_comicpress_graphical_navigation');


function widget_comicpress_graphical_navigation_init() {
	new widget_comicpress_graphical_navigation();
}

add_action('widgets_init', 'widget_comicpress_graphical_navigation_init');

?>