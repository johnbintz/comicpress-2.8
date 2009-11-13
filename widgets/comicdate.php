<?php
/*
Widget Name: Comic Date
Widget URI: http://comicpress.org/
Description: Display's the date of post of the comic.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://webcomicplanet.com/

*/	
	
class widget_comicpress_comic_date extends WP_Widget {
	
	function widget_comicpress_comic_date() {
		$widget_ops = array('classname' => 'widget_comicpress_comic_date', 'description' => __('Displays the date of the post of the comic.','comicpress') );
		$this->WP_Widget('comic_date', __('Comic Date','comicpress'), $widget_ops);
	}
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if ( !empty( $title ) ) { echo $title; } ?>	<?php the_time($instance['format']); ?>
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['format'] = strip_tags($new_instance['format']);
		if (empty($instance['format'])) $instance['format'] = 'F jS, Y';
		return $instance;
	}
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'format' => '' ) );
		$title = strip_tags($instance['title']);
		$format = strip_tags($instance['format']);
		if (empty($format)) $format = 'F jS, Y';
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Words to use before date:','comicpress'); ?><br /><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('format'); ?>"><?php _e('Format of the Time/Date:','comicpress'); ?><br /><input class="widefat" id="<?php echo $this->get_field_id('format'); ?>" name="<?php echo $this->get_field_name('format'); ?>" type="text" value="<?php echo attribute_escape($format); ?>" /></label></p>
		<p><a href="http://us.php.net/manual/en/function.date.php" target="_blank"><?php _e('Date String Examples','comicpress'); ?></a></p>
		
		<?php
	}
}
register_widget('widget_comicpress_comic_date');


function widget_comicpress_comic_date_init() {    
	new widget_comicpress_comic_date(); 
} 

add_action('widgets_init', 'widget_comicpress_comic_date_init');

?>