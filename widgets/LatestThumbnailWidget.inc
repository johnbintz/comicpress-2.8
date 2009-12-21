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
		global $post;
		if (is_home()) {
			extract($args, EXTR_SKIP); 
			
			echo $before_widget;
			$title = empty($instance['title']) ? __('Latest Comic','comicpress') : apply_filters('widget_title', $instance['title']); 
			if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; 
			$latestcomics = get_posts('numberposts=1&category='.get_all_comic_categories_as_cat_string());
			$archive_image = null;

			foreach($latestcomics as $post) : 
			foreach (array("archive", "rss", "mini", "comic") as $type) {
				if (($requested_archive_image = get_comic_url($type, $post)) !== false) {
					$archive_image = $requested_archive_image; break;
				}
			} ?>
				<center>
				<a href="<?php the_permalink(); ?>"><img src="<?php echo $archive_image ?>" alt="<?php the_title() ?> - <?php the_date(); ?>" title="<?php the_hovertext() ?>" /></a><br />
				<span class="latest_thumbnail_date"><?php the_date(); ?></span>
				</center>
				<?php endforeach; 
			echo $after_widget;
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
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','comicpress'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<?php
	}
}

?>