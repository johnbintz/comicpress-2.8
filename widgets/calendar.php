<?php
/*
Widget Name: ComicPress Calendar
Widget URI: http://comicpress.org/
Description: Display a calendar of this months posts.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://webcomicplanet.com/

*/

function comicpress_calendar($instance) {
	global $post; 
	$thumbnail = $instance['thumbnail'];
	$small = $instance['small'];
	$medium = $instance['medium'];
	$large = $instance['large'];
	?>
	<div id="wp-calendar-top"></div>
	<div id="wp-calendar-wrap">
	<?php if (!empty($thumbnail)) { ?>
		<img src="<?php echo $thumbnail; ?>" alt="" class="wp-calendar-thumb" /><br />
		<?php if (!empty($small)) { ?>[<a href="<?php echo $small; ?>">S</a>] <?php } ?><?php if (!empty($medium)) { ?>[<a href="<?php echo $medium; ?>">M</a>] <?php } ?><?php if (!empty($large)) { ?>[<a href="<?php echo $large; ?>">L</a>] <?php } ?>
	<?php } ?>
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
		comicpress_calendar($instance);
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['thumbnail'] = strip_tags($new_instance['thumbnail']);
		$instance['small'] = strip_tags($new_instance['small']);
		$instance['medium'] = strip_tags($new_instance['medium']);
		$instance['large'] = strip_tags($new_instance['large']);
		return $instance;
	}
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'thumbnail' => '', 'small' => '', 'medium' => '', 'large' => '') );
		$title = strip_tags($instance['title']);
		$thumbnail = strip_tags($instance['thumbnail']);
		$small = strip_tags($instance['small']);
		$medium = strip_tags($instance['medium']);
		$large = strip_tags($instance['large']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		
		<p><label for="<?php echo $this->get_field_id('thumbnail'); ?>">Thumbnail URL: <input class="widefat" id="<?php echo $this->get_field_id('thumbnail'); ?>" name="<?php echo $this->get_field_name('thumbnail'); ?>" type="text" value="<?php echo attribute_escape($thumbnail); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('small'); ?>">Wallpaper URL (Small): <input class="widefat" id="<?php echo $this->get_field_id('small'); ?>" name="<?php echo $this->get_field_name('small'); ?>" type="text" value="<?php echo attribute_escape($small); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('medium'); ?>">Wallpaper URL (Medium): <input class="widefat" id="<?php echo $this->get_field_id('medium'); ?>" name="<?php echo $this->get_field_name('medium'); ?>" type="text" value="<?php echo attribute_escape($medium); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('large'); ?>">Wallpaper URL (Large): <input class="widefat" id="<?php echo $this->get_field_id('large'); ?>" name="<?php echo $this->get_field_name('large'); ?>" type="text" value="<?php echo attribute_escape($large); ?>" /></label></p>

		<?php
	}
}
register_widget('widget_comicpress_calendar');


function widget_comicpress_calendar_init() {    
	new widget_comicpress_calendar(); 
} 

add_action('widgets_init', 'widget_comicpress_calendar_init');

?>