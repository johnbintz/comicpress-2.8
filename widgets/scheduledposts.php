<?php
/*
Widget Name: Scheduled Posts
Widget URI: http://comicpress.org/
Description: Display a list of posts that are due to be scheduled.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://webcomicplanet.com/

*/

class widget_comicpress_show_scheduled_posts extends WP_Widget {
	
	function widget_comicpress_show_scheduled_posts() {
		$widget_ops = array('classname' => 'widget_comicpress_show_scheduled_posts', 'description' => 'Display a list of posts that are scheduled to be published.' );
		$this->WP_Widget('show_scheduled_posts', 'Scheduled Posts', $widget_ops);
	}
	
	function widget($args, $instance) {
		extract($args, EXTR_SKIP); 
		
		echo '<div class="scheduled-post-wrap">';
		echo $before_widget;
		$title = empty($instance['title']) ? 'Scheduled Posts' : apply_filters('widget_title', $instance['title']); 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; 
		$scheduled_posts = get_posts('post_status=future&numberposts=-1');
		if (empty($scheduled_posts)) {
			echo '<ul><li>None.</li></ul>';
		} else {
			foreach($scheduled_posts as $post) : ?>
				<ul>
				<li><span class="scheduled-post-title"><?php echo $post->post_title; ?></span>
				<span class="scheduled-post-date"><?php echo date('d/m/Y',$post->post_date); ?></span> </li>
				</ul>
			<?php endforeach;
		} 
		echo $after_widget;
		echo '</div>';
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
register_widget('widget_comicpress_show_scheduled_posts');


function widget_comicpress_show_scheduled_posts_init() {    
	new widget_comicpress_show_scheduled_posts(); 
} 

add_action('widgets_init', 'widget_comicpress_show_scheduled_posts_init');

?>