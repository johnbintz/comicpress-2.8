<?php
/*
Widget Name: Search Transcript
Widget URI: http://comicpress.org/
Description: Link to the form template for searching transcripts.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://frumph.net/

*/	
	
class ComicPressTranscriptSearchWidget extends WP_Widget {

	function ComicPressTranscriptSearchWidget($skip_widget_init = false) {
		if (!$skip_widget_init) {
			$widget_ops = array('classname' => __CLASS__, 'description' => __('Displays a form input box for searching transcripts.','comicpress') );
			$this->WP_Widget(__CLASS__, __('ComicPress Search Transcripts','comicpress'), $widget_ops);
		}
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

?>