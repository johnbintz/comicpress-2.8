<?php
/*
Widget Name: comictitle
Widget URI: http://comicpress.org/
Description: Display a Title of the Comic that can be used in any area around the comic.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://frumph.net/

*/

class DisplayComicTitleWidget extends WP_Widget {
	function DisplayComicTitleWidget() {
		$widget_ops = array('classname' => 'DisplayComicTitleWidget', 'description' => __('Displays the title of the comic. (used in comic sidebars)','comicpress') );
		$this->WP_Widget('comictitle', __('Comic Title','comicpress'), $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php
		echo $after_widget;
	}
}
