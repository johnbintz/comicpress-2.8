<?php
/*
Widget Name: comicpress archive dropdown
Widget URI: http://comicpress.org/
Description: 
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://webcomicplanet.com/

*/

function comicpress_archive_dropdown() { ?>
<ul>
	<li class="archive-dropdown-wrap">
		<select name="archive-dropdown" class="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'> 
		<option value=""><?php echo attribute_escape(__('Archives...','comicpress')); ?></option> 
		<?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?> </select>
	</li>
</ul>
<?php }

class widget_comicpress_archive_dropdown extends WP_Widget {
	
	function widget_comicpress_archive_dropdown() {
		$widget_ops = array('classname' => 'widget_comicpress_archive_dropdown', 'description' => __('Display a dropdown list of your archives, styled.','comicpress') );
		$this->WP_Widget('archive_dropdown', __('ComicPress Archive Dropdown','comicpress'), $widget_ops);
	}
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; 
		comicpress_archive_dropdown();
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
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','comicpress'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<?php
	}
}
register_widget('widget_comicpress_archive_dropdown');


function widget_comicpress_archive_dropdown_init() {    
	new widget_comicpress_archive_dropdown(); 
} 

add_action('widgets_init', 'widget_comicpress_archive_dropdown_init');



?>