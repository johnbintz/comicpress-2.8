<?php
/*
Plugin Name: Keenspot Newsbox Widget
Plugin URI: http://shivae.net/
Description: Newsbox Widget
Author: Tiffany Ross
Version: 1
Author URI: http://shivae.net
*/

class widget_keenspot_newsbox extends WP_Widget {
	
	function widget_keenspot_newsbox() {
		$widget_ops = array('classname' => 'widget_keenspot_newsbox', 'description' => 'Displays the keenspot newsbox.' );
		$this->WP_Widget('keenspotnewsbox', 'Keenspot Newsbox', $widget_ops);
	}
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo '<center><script language="javascript" src="http://www.keenspot.com/ks_Gnewsbox.js"></script></center>';
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
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<?php
	}
}
register_widget('widget_keenspot_newsbox');


function widget_keenspot_newsbox_init() {    
	new widget_keenspot_newsbox(); 
} 

add_action('widgets_init', 'widget_keenspot_newsbox_init');
?>
