<?php
/*
Widget Name: Non-Member text widget
Widget URI: http://comicpress.org/
Description: Displays whatever inside to non-members.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://frumph.net/

*/	
	
class widget_comicpress_non_member_text extends WP_Widget {
	
	function widget_comicpress_non_member_text() {
		$widget_ops = array('classname' => 'widget_comicpress_non_member_text', 'description' => __('Displays Whatever is in the text box to non-members only.','comicpress') );
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('widget_comicpress_non_member_text', __('ComicPress Non-Member Text','comicpress'), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance) {
		global $post, $wp_query;
		if (!comicpress_is_member()) {
			extract($args, EXTR_SKIP); 
			echo $before_widget;
			$title = empty($instance['title']) ? '': apply_filters('widget_title', $instance['title']);
			echo stripslashes($instance['textinfo']);
			echo $after_widget;
		}
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['textinfo'] = addslashes($new_instance['textinfo']);
		return $instance;
	}
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' , 'textinfo' => '') );
		$title = strip_tags($instance['title']);
		$textinfo = stripslashes($instance['textinfo']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','comicpress'); ?><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<p><label><textarea style="width: 400px; height: 280px;" name="<?php echo $this->get_field_name('textinfo'); ?>" name="<?php echo $this->get_field_name('textinfo'); ?>"><?php echo $textinfo; ?></textarea></label></p>
		<?php
	}
}
register_widget('widget_comicpress_non_member_text');


function widget_comicpress_non_member_text_init() {    
	new widget_comicpress_non_member_text(); 
} 

add_action('widgets_init', 'widget_comicpress_non_member_text_init');

?>