<?php
/*
Widget Name: Random Post
Widget URI: http://comicpress.org/
Description: Display a link to click on to go to a random blog post (not comic).
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://frumph.net/

*/	

//Generate a random post page - to use simply create a URL link to "/?randompost"
function random_post() {
	$randomComicQuery = new WP_Query(); $randomComicQuery->query('showposts=1&orderby=rand&cat=-'.exclude_comic_categories());
	while ($randomComicQuery->have_posts()) : $randomComicQuery->the_post();
		$random_comic_id = get_the_ID();
	endwhile;
	wp_redirect( get_permalink( $random_comic_id ) );
	exit;
}

if ( isset( $_GET['randompost'] ) )
	add_action( 'template_redirect', 'random_post' );
	
class widget_comicpress_random_post extends WP_Widget {
	
	function widget_comicpress_random_post() {
		$widget_ops = array('classname' => 'widget_comicpress_random_post', 'description' => __('Displays a link to click to trigger a random blog post.','comicpress') );
		$this->WP_Widget('random_post', __('Random Post','comicpress'), $widget_ops);
	}
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; ?>
			<h2><a href="?randompost"><span class="random-post-icon">?</span> <?php _e('Random Post','comicpress'); ?></a></h2>
		<?php
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
register_widget('widget_comicpress_random_post');


function widget_comicpress_random_post_init() {    
	new widget_comicpress_random_post(); 
} 

add_action('widgets_init', 'widget_comicpress_random_post_init');

?>