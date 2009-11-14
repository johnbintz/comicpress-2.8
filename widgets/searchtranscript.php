<?php
/*
Widget Name: Search Transcript
Widget URI: http://comicpress.org/
Description: Link to the form template for searching transcripts.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://frumph.net/

*/	
	
class widget_comicpress_search_transcripts extends WP_Widget {
	
	function widget_comicpress_search_transcripts() {
		$widget_ops = array('classname' => 'widget_comicpress_search_transcripts', 'description' => __('Displays a form input box for searching transcripts.','comicpress') );
		$this->WP_Widget('comicpress_search_transcripts', __('Search Transcripts','comicpress'), $widget_ops);
	}
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		include(get_template_directory() . '/searchform-transcript.php');
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
register_widget('widget_comicpress_search_transcripts');


function widget_comicpress_search_transcripts_init() {    
	new widget_comicpress_search_transcripts(); 
} 

add_action('widgets_init', 'widget_comicpress_search_transcripts_init');

?>