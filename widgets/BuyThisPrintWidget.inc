<?php
/*
Widget Name: Buy Comic Print
Widget URI: http://comicpress.org/
Description: Places a button that works with the Buy This template.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://frumph.net/

*/

class BuyThisPrintWidget extends WP_Widget {
	function BuyThisPrintWidget() {
		$widget_ops = array('classname' => 'ComicPressBuyThisPrint', 'description' => __('Adds a button that goes to the buy print template page.','comicpress') );
		$this->WP_Widget('comicpress_buyprint', __('Buy This Print','comicpress'), $widget_ops);
	}

	// @codeCoverageIgnoreStart
	function init() {
		add_filter('comicpress_buy_print_structure', array(&$this, 'buy_print_structure'));
	}
	// @codeCoverageIgnoreEnd

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = apply_filters('widget_title', $instance['title']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };

		if ( get_post_meta( get_the_ID(), "buythiscomic", true ) !== 'sold' ) {
			echo apply_filters('comicpress_buy_print_structure', '');
		}

		echo $after_widget;
	}

	function buy_print_structure($content = '') {
		$comicpress_options = comicpress_load_options(); ?>
			<div class="buythis"><form method="post" action="<?php echo $comicpress_options['buy_print_url']; ?>">
			<input type="hidden" name="comic" value="<?php echo get_the_ID(); ?>" />
			<button class="buythisbutton" type="submit" value="submit" name="submit"></button></form></div>
			<div class="clear"></div>
		<?php
		return ob_get_clean();
	}

	function update($new_instance, $old_instance = array()) {
		$instance = array();
		foreach (array('title') as $field) {
			if (isset($new_instance[$field])) { $instance[$field] = strip_tags($new_instance[$field]); }
		}
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','comicpress'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<?php
	}
}
