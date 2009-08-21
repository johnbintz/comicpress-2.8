<?php
/*
Widget Name: Latest Comics
Widget URI: http://comicpress.org/
Description: Display a list of links of the latest comics.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://webcomicplanet.com/

*/

 function comicpress_latest_comics() { ?>
	<ul>
	<li>
		<h2>Latest Comics</h2>
		<ul>	
			 <?php global $post;
			$latestcomics = get_posts('numberposts=5&category='.get_all_comic_categories_as_cat_string());
			foreach($latestcomics as $post) : ?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; ?>
     	</ul>
	</li>
	</ul>
	<?php 
} 

class widget_comicpress_latest_comics extends WP_Widget {
	
	function widget_comicpress_latest_comics() {
		$widget_ops = array('classname' => 'widget_comicpress_latest_comics', 'description' => 'Display a list of the latest comics available.' );
		$this->WP_Widget('latest_comics', 'Latest Comics', $widget_ops);
	}
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		
		echo $before_widget;
		$title = empty($instance['title']) ? 'Latest Comics' : apply_filters('widget_title', $instance['title']); 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; 
		$latestcomics = get_posts('numberposts=5&category='.get_all_comic_categories_as_cat_string()); ?>
		<ul>
		<?php foreach($latestcomics as $post) : ?>
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; ?>
		</ul>
		<?php echo $after_widget;
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
register_widget('widget_comicpress_latest_comics');


function widget_comicpress_latest_comics_init() {    
	new widget_comicpress_latest_comics(); 
} 

add_action('widgets_init', 'widget_comicpress_latest_comics_init');

?>