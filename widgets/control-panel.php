<?php
/*
Widget Name: Control Panel
Widget URI: http://comicpress.org/
Description: Display an area for login and logout, forgot password and register.
Author: Philip M. Hofer (Frumph)
Version: 1.02
Author URI: http://webcomicplanet.com/

*/

function comicpress_show_control_panel() { 
global $wpmu_version; ?>
	<?php if (!is_user_logged_in()) { ?>
		<form action="<?php bloginfo('wpurl') ?>/wp-login.php" method="post">
		<?php _e('UserName:','comicpress'); ?><br />
		<input type="text" name="log" id="sname" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="22" /><br /><br />
		<?php _e('Password:','comicpress'); ?><br />
		<input type="password" name="pwd" id="spassword" size="22" /><br />
		<label for="rememberme"><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> Remember me</label><br />
		<br />
		<button type="submit" class="button"><?php _e('Login','comicpress'); ?></button>
		<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>"/>
		</form>
		<br />
		<ul>
		<?php if (!empty($wpmu_version)) { ?>
			<li><a href="<?php bloginfo('wpurl') ?>/wp-signup.php"><?php _e('Register','comicpress'); ?></a></li>
		<?php } else { ?>
			<li><a href="<?php bloginfo('wpurl') ?>/wp-register.php"><?php _e('Register','comicpress'); ?></a></li>
		<?php } ?>
		<li><a href="<?php bloginfo('wpurl') ?>/wp-login.php?action=lostpassword"><?php _e('Recover password','comicpress'); ?></a></li>
		</ul>
	<?php } else { ?>
		<ul>
		<?php $redirect = '&amp;redirect_to='.urlencode(wp_make_link_relative(get_bloginfo('wpurl')));
		$uri = wp_nonce_url( site_url("wp-login.php?action=logout$redirect", 'login'), 'log-out' ); ?>
		<li><a href="<?php echo $uri; ?>"><?php _e('Logout','comicpress'); ?></a></li>
		<?php wp_register(); ?>
		<li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/profile.php"><?php _e('Profile','comicpress'); ?></a></li>
		</ul>
	<?php } ?>
	<?php
} 


class widget_comicpress_show_control_panel extends WP_Widget {
	
	function widget_comicpress_show_control_panel() {
		$widget_ops = array('classname' => 'widget_comicpress_show_control_panel', 'description' => __('Login/Logoff menu with register/lost password links if not logged on. (use only if registrations are enabled.','comicpress') );
		$this->WP_Widget('control_panel', __('Control Panel','comicpress'), $widget_ops);
	}
	
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		
		echo $before_widget;
		$title = empty($instance['title']) ? __('Control Panel','comicpress') : apply_filters('widget_title', $instance['title']); 
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
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','comicpress'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<?php
	}
}
register_widget('widget_comicpress_show_control_panel');


function widget_comicpress_show_control_panel_init() {    
	new widget_comicpress_show_control_panel(); 
} 

add_action('widgets_init', 'widget_comicpress_show_control_panel_init');

?>