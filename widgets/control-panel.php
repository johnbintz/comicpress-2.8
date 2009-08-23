<?php
/*
Widget Name: Control Panel
Widget URI: http://comicpress.org/
Description: Display an area for login and logout, forgot password and register.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://webcomicplanet.com/

*/

// The Control Panel function

function comicpress_show_control_panel() { 
global $wpmu_version; ?>
<ul>
	<?php if (!is_user_logged_in()) { ?>
	<li>
		<form action="<?php bloginfo('url') ?>/wp-login.php" method="post">
		UserName:<br />
		<input type="text" name="log" id="sname" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="22" /><br /><br />
		Password:<br />
		<input type="password" name="pwd" id="spassword" size="22" /><br />
		<label for="rememberme"><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> Remember me</label><br />
		<br />
		<button type="submit" class="button">Login</button>
		<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>"/>
		</form>
		<br />
		<?php if (!empty($wpmu_version)) { ?>
			<a href="<?php bloginfo('url') ?>/wp-signup.php">Register</a><br />
		<?php } else { ?>
			<a href="<?php bloginfo('url') ?>/wp-register.php">Register</a><br />
		<?php } ?>		
		<a href="<?php bloginfo('url') ?>/wp-login.php?action=lostpassword">Recover password</a>
	<?php } else { ?>
		<?php $redirect = '&amp;redirect_to='.urlencode(wp_make_link_relative(get_option('siteurl')));
		$uri = wp_nonce_url( site_url("wp-login.php?action=logout$redirect", 'login'), 'log-out' ); ?>
		<li><a href="<?php echo $uri; ?>">Logout</a></li>
		<?php wp_register(); ?>
		<li><a href="/wp-admin/profile.php">Profile</a></li>
	<?php } ?>
	</ul>
	<?php
} 


class widget_comicpress_show_control_panel extends WP_Widget {
	
	function widget_comicpress_show_control_panel() {
		$widget_ops = array('classname' => 'widget_comicpress_show_control_panel', 'description' => 'Login/Logoff menu with register/lost password links if not logged on.' );
		$this->WP_Widget('control_panel', 'Control Panel', $widget_ops);
	}
	
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		
		echo $before_widget;
		$title = empty($instance['title']) ? 'Control Panel' : apply_filters('widget_title', $instance['title']); 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		comicpress_show_control_panel();
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
register_widget('widget_comicpress_show_control_panel');


function widget_comicpress_show_control_panel_init() {    
	new widget_comicpress_show_control_panel(); 
} 

add_action('widgets_init', 'widget_comicpress_show_control_panel_init');

?>