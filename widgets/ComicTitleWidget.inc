<?php
/*
Widget Name: Comic Title Widget
Widget URI: http://comicpress.org/
Description: Display a Title of the Comic that can be used in any area around the comic.
Author: Philip M. Hofer (Frumph)
Version: 1.02
Author URI: http://frumph.net/

*/	
	
class ComicPressComicTitleWidget extends WP_Widget {
	
	function ComicPressComicTitleWidget($skip_widget_init = false) {
		if (!$skip_widget_init) {
			$widget_ops = array('classname' => __CLASS__, 'description' => __('Displays the title of the comic. (used in comic sidebars)','comicpress') );
			$this->WP_Widget(__CLASS__, __('ComicPress Comic Title','comicpress'), $widget_ops);
		}
	}
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		
		echo $before_widget;?>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		return $instance;
	}
	
	function form($instance) {
	}
}

?>