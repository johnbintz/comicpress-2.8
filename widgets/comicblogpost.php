<?php
/*
Widget Name: Comic Blog Post
Widget URI: http://comicpress.org/
Description: Display's the comic's blog post.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://webcomicplanet.com/

*/	
	
class widget_comicpress_comic_blog_post extends WP_Widget {
	
	function widget_comicpress_comic_blog_post() {
		$widget_ops = array('classname' => 'widget_comicpress_comic_blog_post', 'description' => __('Displays the comic blog post, ..used to be around the comic areas.  Does not show if there is no content.','comicpress') );
		$this->WP_Widget('comic_blog_post', __('Comic Blog Post','comicpress'), $widget_ops);
	}
	
	function widget($args, $instance) {
		global $post, $wp_query;
		if (is_home() || is_single()) {
			extract($args, EXTR_SKIP);
			if (!empty($post->post_content)) {
				echo $before_widget;
				$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
				if ( !empty( $title ) ) { echo $title; } 
				
				display_comic_post();
				echo $after_widget;
			}
		}
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
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Words to use before date:<br /><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
			
		<?php
	}
}
register_widget('widget_comicpress_comic_blog_post');


function widget_comicpress_comic_blog_post_init() {    
	new widget_comicpress_comic_blog_post(); 
} 

add_action('widgets_init', 'widget_comicpress_comic_blog_post_init');

?>