<?php
/*
Widget Name: Comic Date
Widget URI: http://comicpress.org/
Description: Display's the date of post of the comic.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://frumph.net/
*/

class ComicDateWidget extends WP_Widget {
	function ComicDateWidget() {
		$widget_ops = array('classname' => 'ComicDateWidget', 'description' => __('Displays the date of the post of the comic.','comicpress') );
		$this->WP_Widget('comic_date', __('Comic Date','comicpress'), $widget_ops);
	}

	// @codeCoverageIgnoreStart
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if ( !empty( $title ) ) { echo $title; } ?>	<?php the_time($instance['format']); ?>
		<?php echo $after_widget;
	}
	// @codeCoverageIgnoreEnd

	function _filter_instance($instance) {
		foreach (array('title', 'format') as $field) {
			if (isset($instance[$field])) {
				$instance[$field] = strip_tags($instance[$field]);
			}
			switch ($field) {
				case 'format':
					if (empty($instance[$field])) {
						$instance[$field] = 'F jS, Y';
					}
					break;
			}
		}
		return $instance;
	}

	function update($new_instance, $old_instance) {
		return $this->_filter_instance($new_instance);
	}

	// @codeCoverageIgnoreStart
	function form($instance) {
		$instance = wp_parse_args((array) $instance, array('title' => '', 'format' => ''));
		$instance = $this->_filter_instance($instance);

		foreach (array(
			'title' => __('Words to use before date:', 'comicpress'),
			'format' => __('Format of the Time/Date:', 'comicpress'),
		) as $field => $title) {
		  ?><p>
		    <label for="<?php echo esc_attr($this->get_field_id($field)); ?>">
		      <?php echo esc_html($title); ?><br />
		      <input class="widefat" id="<?php echo esc_attr($this->get_field_id($field)); ?>"
		             name="<?php echo esc_attr($this->get_field_name($field)); ?>"
		             type="text"
		             value="<?php echo esc_attr($instance[$field]); ?>" />
		    </label>
		  </p><?php
		}
		?>
		<p><a href="http://us.php.net/manual/en/function.date.php" target="_blank"><?php _e('Date String Examples','comicpress'); ?></a></p>
		<?php
	}
	// @codeCoverageIgnoreEnd
}
