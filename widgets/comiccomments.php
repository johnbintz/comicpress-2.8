<?php
/*
Widget Name: Comic Comments
Widget URI: http://comicpress.org/
Description: Display a comments link to put inside the comic area.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://webcomicplanet.com/

*/	
	
class widget_comicpress_comments extends WP_Widget {
	
	function widget_comicpress_comments() {
		$widget_ops = array('classname' => 'widget_comicpress_comments', 'description' => 'Displays a comments link.' );
		$this->WP_Widget('comic_comments', 'Comic Comments', $widget_ops);
	}
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		
		echo $before_widget;
		$title = empty($instance['title']) ? 'Permalink' : apply_filters('widget_title', $instance['title']); ?>
			<?php if ('open' == $post->comment_status) { comments_popup_link('&ldquo;Comment!&rdquo;', '&ldquo;1 Comment&rdquo;', '&ldquo;% Comments&rdquo;'); } ?>
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = strip_tags($instance['title']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">New Link name:<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>		
		<?php
	}
}
register_widget('widget_comicpress_comments');


function widget_comicpress_comments_init() {    
	new widget_comicpress_comments(); 
} 

add_action('widgets_init', 'widget_comicpress_comments_init');

?>