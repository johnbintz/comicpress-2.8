<?php
/*
Widget Name: Graphical Navigation
Widget URI: http://comicpress.org/
Description: You can place graphical navigation buttons on your comic, for ComicPress 2.8
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://webcomicplanet.com/

*/


function comic_navigation() {
	global $post,$wp_query;
	$this_permalink = get_permalink();
	
	$temp_query = $wp_query->is_single;
	$wp_query->is_single = true;
	$prev_comic = get_previous_comic_permalink();
	$next_comic = get_next_comic_permalink();
	$wp_query->is_single = $temp_query;
	$temp_query = null;
	
	$first_comic = get_first_comic_permalink();
	$last_comic = get_last_comic_permalink();
	
	echo '<div id="comic_navi_wrapper">';
	echo '	<div class="comic_navi">';
	echo '		<div class="comic_navi_left">';
	
	if (!empty($first_comic) && ($first_comic != $this_permalink)) {
		echo '		<a href="'.$first_comic.'" class="rollfirst" title="First">&nbsp;</a>';
	} else {
		echo '		<div class="rollfirst rollagain"></div>';
	}
	
	if (!empty($prev_comic)) {
		echo '		<a href="'.$prev_comic.'" class="rollprev" title="Previous">&nbsp;</a>';
	} else { 
		echo '		<div class="rollprev rollagain"></div>';
	}
	echo '          <div class="clear"></div>';
	echo '		</div>';
	echo '		<div class="comic_navi_right">';
	
	if (!empty($next_comic)) {
		echo '		<a href="'.$next_comic.'" class="rollnext" title="Next">&nbsp;</a>';
	} else {
		echo '		<div class="rollnext rollagain"></div>';
	}
	
	if (!empty($last_comic) && ($last_comic != $this_permalink)) {
		echo '		<a href="'.$last_comic.'" class="rolllast" title="Last">&nbsp;</a>';
	} else {
		echo '		<div class="rolllast rollagain"></div>';
	}
	echo '          <div class="clear"></div>';
	echo '		</div>';
	echo '		<div class="comic_navi_center_spacer">';
	echo '			<div class="comic_navi_center">';
	echo '				<a href="'.get_bloginfo('url').'?randomcomic" class="rollrandom" title="Random Comic">&nbsp;</a>';
	echo '			</div>';
	echo '		</div>';
	echo '		<div class="clear"></div>';
	echo '	</div>';
	echo '</div>';
	
}


class widget_comicpress_graphical_navigation extends WP_Widget {
	
	function widget_comicpress_graphical_navigation() {
		$widget_ops = array('classname' => 'widget_comicpress_graphical_navigation', 'description' => 'Displays Graphical Navigation Buttons.' );
		$this->WP_Widget('graphicalnavigation', 'Comic Navigation', $widget_ops);
	}
	
	function widget($args, $instance) {
		global $wp_query, $post;
		extract($args, EXTR_SKIP);
		echo $before_widget;
		comic_navigation();		
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
	}
	
	function form($instance) {
	}
}
register_widget('widget_comicpress_graphical_navigation');


function widget_comicpress_graphical_navigation_init() {    
	new widget_comicpress_graphical_navigation(); 
} 

add_action('widgets_init', 'widget_comicpress_graphical_navigation_init');

?>