<?php
/*
Widget Name: Calendar
Widget URI: http://comicpress.org/
Description: Display a calendar of this months posts.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://webcomicplanet.com/

*/

function comicpress_calendar() {
	global $post; ?>
	<div id="wp-calendar-top"></div>
	<div id="wp-calendar-wrap">
	<?php get_calendar(); ?>
	</div>
	<div id="wp-calendar-bottom"></div>
<?php }

class widget_comicpress_calendar extends WP_Widget {
	
	function widget_comicpress_calendar() {
		$widget_ops = array('classname' => 'widget_comicpress_calendar', 'description' => 'Display a calendar showing this months posts. (this calendar does not drop lines if there is no title given.)' );
		$this->WP_Widget('comicpress_calendar', 'Comicpress Calendar', $widget_ops);
	}
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		comicpress_calendar();
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
register_widget('widget_comicpress_calendar');


function widget_comicpress_calendar_init() {    
	new widget_comicpress_calendar(); 
} 

add_action('widgets_init', 'widget_comicpress_calendar_init');

?>