<?php
/*
Widget Name: Latest Comic Jump
Widget URI: http://comicpress.org/
Description: Creates a link to the latest Comic
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://frumph.net/

*/	
	
if ( isset( $_GET['latestcomic'] ) )
	add_action( 'template_redirect', 'latest_comic_jump' );

//to use simply create a URL link to "/?latestcomic"
function latest_comic_jump() {
	wp_redirect( get_permalink( get_terminal_post_in_category(get_all_comic_categories_as_cat_string(), false) ) );
	exit;
}
	
class widget_comicpress_latest_comic_jump extends WP_Widget {
	
	function widget_comicpress_latest_comic_jump() {
		$widget_ops = array('classname' => 'widget_comicpress_latest_comic_jump', 'description' => __('Displays a link to click to go to the latest comic.','comicpress') );
		$this->WP_Widget('comicpress_latest_comic_jump', __('ComicPress Latest Comic Link','comicpress'), $widget_ops);
	}
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; ?>
			<h2><a href="?latestcomic"><span class="latest-comic-icon">?</span> Latest Comic</a></h2>
		<?php
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
register_widget('widget_comicpress_latest_comic_jump');


function widget_comicpress_latest_comic_jump_init() {    
	new widget_comicpress_latest_comic_jump(); 
} 

add_action('widgets_init', 'widget_comicpress_latest_comic_jump_init');

?>