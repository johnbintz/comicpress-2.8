<?php
/*
Widget Name: Latest Thumbnail
Widget URI: http://comicpress.org/
Description: Display a thumbnail of the latest comic.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://webcomicplanet.com/

*/

class widget_comicpress_latest_thumbnail extends WP_Widget {
	
	function widget_comicpress_latest_thumbnail() {
		$widget_ops = array('classname' => 'widget_comicpress_latest_thumbnail', 'description' => 'Display a thumbnail of the latest comic, clickable to go to the comic post.' );
		$this->WP_Widget('latest_thumbnail', 'Latest Comic', $widget_ops);
	}
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		
		echo $before_widget;
		$title = empty($instance['title']) ? 'Latest Comic' : apply_filters('widget_title', $instance['title']); 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; 
		$latestcomics = get_posts('numberposts=1&category='.get_all_comic_categories_as_cat_string());
		foreach($latestcomics as $post) : ?>
		<center>
			<a href="<?php the_permalink(); ?>"><img src="<?php the_comic_rss() ?>" alt="<?php the_title() ?>" title="<?php the_hovertext() ?>" /></a><br />
		</center>
		<?php endforeach; 
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
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<?php
	}
}
register_widget('widget_comicpress_latest_thumbnail');


function widget_comicpress_latest_thumbnail_init() {    
	new widget_comicpress_latest_thumbnail(); 
} 

add_action('widgets_init', 'widget_comicpress_latest_thumbnail_init');

?>