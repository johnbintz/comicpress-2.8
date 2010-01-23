<?php
/*
Widget Name: Comic Blog Post Widget
Widget URI: http://comicpress.org/
Description: Display's the comic's blog post.
Author: Philip M. Hofer (Frumph)
Version: 1.05
Author URI: http://frumph.net/

*/
	
class ComicPressComicBlogPostWidget extends WP_Widget {
	
	function ComicPressComicBlogPostWidget($skip_widget_init = false) {
		if (!$skip_widget_init) {
			$widget_ops = array('classname' => __CLASS__, 'description' => __('Displays the comic blog post. (used within the comic sidebar areas)','comicpress') );
			$this->WP_Widget(__CLASS__, __('ComicPress Comic Blog Post','comicpress'), $widget_ops);
		}
	}
	
	function widget($args, $instance) {
		global $post, $wp_query;
		if (!is_home() && $instance['onlyhome'])  return;
		if (is_page() || is_search() || is_archive()) return;
		extract($args, EXTR_SKIP);
		if (!empty($post->post_content)) {
			echo $before_widget;
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			if ( !empty( $title ) ) { echo "<div class=\"comic-post-header\">".$title."</div>\r\n"; }
			the_content();
			echo $after_widget;
		}
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['onlyhome'] = (bool)( $new_instance['onlyhome'] == 1 ? true : false );		
		return $instance;
	}
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'onlyhome' => false  ) );
		$title = strip_tags($instance['title']);
		$onlyhome = $instance['onlyhome'];
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Heading:<br /><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('onlyhome'); ?>"><input id="<?php echo $this->get_field_id('onlyhome'); ?>" name="<?php echo $this->get_field_name('onlyhome'); ?>" type="checkbox" value="1" <?php checked(true, $onlyhome); ?> /> Display only on the home page?</label></p>			
		<?php
	}
}

?>