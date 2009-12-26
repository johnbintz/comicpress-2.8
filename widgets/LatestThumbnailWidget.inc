<?php
/*
Widget Name: Latest Thumbnail
Widget URI: http://comicpress.org/
Description: Display a thumbnail of the latest comic.
Author: Philip M. Hofer (Frumph)
Version: 1.02
Author URI: http://frumph.net/

*/

class ComicPressLatestThumbnailWidget extends WP_Widget {

	function ComicPressLatestThumbnailWidget($skip_widget_init = false) {
		if (!$skip_widget_init) {
			$widget_ops = array('classname' => __CLASS__, 'description' => __('Display a thumbnail of the latest comic, clickable to go to the comic post.','comicpress') );
			$this->WP_Widget(__CLASS__, __('ComicPress Latest Thumbnail','comicpress'), $widget_ops);
		}
	}
	
	function widget($args, $instance) {
		global $post, $wp_query;
		if (!is_home() && $instance['onlyhome']) return;
		
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; 
		$latestcomics = get_posts('numberposts=1&category='.get_all_comic_categories_as_cat_string());
		$archive_image = null;

		foreach($latestcomics as $post) :
			foreach (array("archive", "rss", "mini", "comic") as $type) {
				if (($requested_archive_image = get_comic_url($type, $post)) !== false) {
					$archive_image = "<img src=\"$requested_archive_image\" alt=\"".get_the_title()."\" title=\"".get_the_title()."\" />";
					break;
				}
			}
			if (function_exists('has_post_thumbnail')) {
				if ( has_post_thumbnail($post->ID) ) {
					$archive_image = get_the_post_thumbnail($post->ID,'full');
				}
			} 
		?>
			<a href="<?php the_permalink(); ?>"><?php echo $archive_image; ?></a>
			<?php endforeach; 
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['onlyhome'] = (bool)( $new_instance['onlyhome'] == 1 ? true : false );
		return $instance;
	}
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'onlyhome' => false ) );
		$title = strip_tags($instance['title']);
		$onlyhome = $instance['onlyhome'];
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','comicpress'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('onlyhome'); ?>"><input id="<?php echo $this->get_field_id('onlyhome'); ?>" name="<?php echo $this->get_field_name('onlyhome'); ?>" type="checkbox" value="1" <?php checked(true, $onlyhome); ?> /> Display only on the home page?</label></p>
	<?php
	}
}

?>