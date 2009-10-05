<?php
/*
Widget Name: Buy Comic Print
Widget URI: http://comicpress.org/
Description: Places a button that works with the Buy This template.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://webcomicplanet.com/

*/

function buy_this_print_comic() {
	global $buy_print_url;
	$buythiscomic = get_post_meta( get_the_ID(), "buythiscomic", true );
	if ( $buythiscomic !== 'sold' ) { ?>
		<div class="buythis"><form method="post" action="<?php echo $buy_print_url; ?>">
		<input type="hidden" name="comic" value="<?php echo get_the_ID(); ?>" />
		<button class="buythisbutton" type="submit" value="submit" name="submit"></button></form></div>
		<div class="clear"></div>
	<?php }
}

class widget_comicpress_buy_this_print extends WP_Widget {
	
	function widget_comicpress_buy_this_print() {
		$widget_ops = array('classname' => 'widget_comicpress_buy_this_print', 'description' => __('Adds a button that goes to the buy print template page.','comicpress') );
		$this->WP_Widget('comicpress_buyprint', __('Buy This Print','comicpress'), $widget_ops);
	}
	
	function widget($args, $instance) {
		global $buy_print_url;
		extract($args, EXTR_SKIP);
		
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		buy_this_print_comic();
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
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
register_widget('widget_comicpress_buy_this_print');


function widget_comicpress_buy_this_print_init() {    
	new widget_comicpress_buy_this_print(); 
} 

add_action('widgets_init', 'widget_comicpress_buy_this_print_init');

?>