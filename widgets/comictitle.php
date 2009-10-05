<?php
/*
Widget Name: comictitle
Widget URI: http://comicpress.org/
Description: Display a Title of the Comic that can be used in any area around the comic.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://webcomicplanet.com/

*/	
	
class widget_comicpress_comictitle extends WP_Widget {
	
	function widget_comicpress_comictitle() {
		$widget_ops = array('classname' => 'widget_comicpress_comictitle', 'description' => __('Displays the title of the comic. (used in comic sidebars)','comicpress') );
		$this->WP_Widget('comictitle', __('Comic Title','comicpress'), $widget_ops);
	}
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		
		echo $before_widget; 
			the_title();
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		return $instance;
	}
	
	function form($instance) {
	}
}
register_widget('widget_comicpress_comictitle');


function widget_comicpress_comictitle_init() {    
	new widget_comicpress_comictitle(); 
} 

add_action('widgets_init', 'widget_comicpress_comictitle_init');

?>