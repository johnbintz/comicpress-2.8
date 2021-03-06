<?php
/*
Widget Name: Comic Comments Widget
Widget URI: http://comicpress.org/
Description: Display a comments link to put inside the comic area.
Author: Philip M. Hofer (Frumph)
Version: 1.02
Author URI: http://frumph.net/

*/	
	
class ComicPressCommentsWidget extends WP_Widget {

	function ComicPressCommentsWidget($skip_widget_init = false) {
		if (!$skip_widget_init) {
			$widget_ops = array('classname' => __CLASS__, 'description' => __('Displays a comments link. (used in comic sidebars)','comicpress') );
			$this->WP_Widget(__CLASS__, __('ComicPress Comic Comments','comicpress'), $widget_ops);
		}
	}
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		
		echo $before_widget;
		$title = empty($instance['title']) ? __('Permalink','comicpress') : apply_filters('widget_title', $instance['title']); ?>
		<?php if ('open' == $post->comment_status) { ?><div class="comment-link"><?php comments_popup_link('<span class="comment-balloon comment-balloon-empty"> </span> Comment ', '<span class="comment-balloon">1</span> Comment ', '<span class="comment-balloon">%</span> Comment '); ?></div><?php } ?>
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
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('New Link name:','comicpress'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>		
		<?php
	}
}

?>