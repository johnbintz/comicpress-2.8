<?php
/*
Widget Name: Show Transcription
Widget URI: http://comicpress.org/
Description: Show the stylized transcription in a widget area.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://webcomicplanet.com/

*/


class widget_comicpress_show_transcription extends WP_Widget {
	
	function widget_comicpress_show_transcription() {
		$widget_ops = array('classname' => 'widget_comicpress_show_transcription', 'description' => 'Display the transcription of the current post if there is one.' );
		$this->WP_Widget('transcript', 'Transcript', $widget_ops);
	}
	
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$transtype = empty($instance['transtype']) ? 'empty' : apply_filters('widget_transtype', $instance['transtype']); 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		the_transcript($transtype);	
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['transtype'] = strip_tags($new_instance['transtype']);
		return $instance;
	}
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'transtype' => '' ) );
		$title = strip_tags($instance['title']);
		$transtype = strip_tags($instance['transtype']);
		if (empty($transtype)) $transtype = 'styled';
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<p>
		<label><input name="<?php echo $this->get_field_name('transtype'); ?>" id="<?php echo $this->get_field_id('transtype'); ?>-styled" type="radio" value="styled"<?php if ( $transtype == "styled") { echo " checked"; } ?> />Styled</label><br />
		<label><input name="<?php echo $this->get_field_name('transtype'); ?>" id="<?php echo $this->get_field_id('transtype'); ?>-br" type="radio" value="br"<?php if ( $transtype == "br") { echo " checked"; } ?> />Add BR's</label><br />
		<label><input name="<?php echo $this->get_field_name('transtype'); ?>" id="<?php echo $this->get_field_id('transtype'); ?>-raw" type="radio" value="raw"<?php if ( $transtype == "raw") { echo " checked"; } ?> />Raw Output</label>
		</p>		
		<?php
	}
}
register_widget('widget_comicpress_show_transcription');


function widget_comicpress_show_transcription_init() {    
	new widget_comicpress_show_transcription(); 
} 

add_action('widgets_init', 'widget_comicpress_show_transcription_init');

?>