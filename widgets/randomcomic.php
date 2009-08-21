<?php
/*
Widget Name: Random Comic
Widget URI: http://comicpress.org/
Description: Display a link to click on to go to a random comic.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://webcomicplanet.com/

*/	
	
	
//Generate a random comic page - to use simply create a URL link to "/?randomcomic"
function random_comic() {
	$randomComicQuery = new WP_Query(); $randomComicQuery->query('showposts=1&orderby=rand&cat='.get_all_comic_categories_as_cat_string());
	while ($randomComicQuery->have_posts()) : $randomComicQuery->the_post();
		$random_comic_id = get_the_ID();
	endwhile;
	wp_redirect( get_permalink( $random_comic_id ) );
	exit;
}

if ( isset( $_GET['randomcomic'] ) )
	add_action( 'template_redirect', 'random_comic' );
	
class widget_comicpress_random_comic extends WP_Widget {
	
	function widget_comicpress_random_comic() {
		$widget_ops = array('classname' => 'widget_comicpress_random_comic', 'description' => 'Displays a link to click to trigger a random comic.' );
		$this->WP_Widget('random_comic', 'Random Comic', $widget_ops);
	}
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; ?>
			<h2><a href="?randomcomic"><span class="random-comic-icon">?</span> Random Comic</a></h2>
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
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<?php
	}
}
register_widget('widget_comicpress_random_comic');


function widget_comicpress_random_comic_init() {    
	new widget_comicpress_random_comic(); 
} 

add_action('widgets_init', 'widget_comicpress_random_comic_init');

?>