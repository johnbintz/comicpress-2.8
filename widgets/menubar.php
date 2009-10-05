<?php
/*
Widget Name: Menubar
Widget URI: http://comicpress.org/
Description: Display a calendar of this months posts.
Author: Philip M. Hofer (Frumph)
Version: 1.05
Author URI: http://webcomicplanet.com/

*/


function comicpress_menubar() {
global $contact_in_menubar,$enable_search_in_menubar,$enable_rss_in_menubar,$enable_navigation_in_menubar,$disable_dynamic_menubar_links, $themepack_directory;
	if (comicpress_check_themepack_file('menubar.php') == false) {
		if (function_exists('suckerfish')) { 
			suckerfish();
		} else { ?>
			<div id="menubar">
			
			<div id="menunav">
			<?php if ($enable_search_in_menubar == 'yes') { ?>
				<div class="menunav-search"><?php include(get_template_directory() . '/searchform.php'); ?></div>
			<?php } ?>
			<?php if ($enable_rss_in_menubar == 'yes') { ?>
				<a href="<?php bloginfo('rss2_url') ?>" title="RSS Feed" class="menunav-rss">RSS</a>
			<?php } ?>
			<?php if ($enable_navigation_in_menubar == 'yes') { ?>
				<?php if (is_home()) {
					$comicFrontpage = new WP_Query(); $comicFrontpage->query('showposts=1&cat='.get_all_comic_categories_as_cat_string());
					while ($comicFrontpage->have_posts()) : $comicFrontpage->the_post();
						global $wp_query; $wp_query->is_single = true; ?>
						<div class="menunav-prev">
						<?php previous_comic_link('%link', '&lsaquo;'); ?>
						</div>
						<?php $wp_query->is_single = false;
					endwhile; 
				} elseif (is_single() & in_comic_category()) { ?>
					<div class="menunav-prev">
					<?php previous_comic_link('%link', '&lsaquo;'); ?>
					</div>
					<div class="menunav-next">
					<?php next_comic_link('%link', '&rsaquo;'); ?>
					</div>
				<?php } ?>
			<?php } ?>
			</div>
			<?php 
			$linkcatid = get_term_by('name','menubar','link_category');
			$linkcatid = $linkcatid->term_id;
			$menulinks = wp_list_bookmarks('echo=0&title_li=&categorize=0&title_before=&title_after=&category_name=menubar');
			$menulinks = preg_replace('#<li ([^>]*)>#', '<li class="page-item link">', $menulinks);
			$menulinks = preg_replace('#<ul ([^>]*)>#', '', $menulinks);
			$menulinks = str_replace('</ul>', '', $menulinks);
			$bookmarks = wp_list_bookmarks('echo=0&title_li=&categorize=1&title_before=&title_after=&exclude_category='.$linkcatid); 
			$bookmarks = preg_replace('#<li ([^>]*)>#', '<li class="page-item link">', $bookmarks);
			$bookmarks = preg_replace('#<ul ([^>]*)>#', '<ul>', $bookmarks); 
			$listpages = '';
			if ($disable_dynamic_menubar_links != 'yes') {
				$listpages = wp_list_pages('echo=0&sort_column=menu_order&depth=4&title_li=');
			}
			if (!empty($bookmarks)) {
				$listpages = str_replace('Links</a></li>', 'Links</a>
							<ul>
							'.$bookmarks.'
							</ul>
							</li>
							', $listpages);
				$listpages .= $menulinks;
			} else { 
				$listpages = str_replace('Links</a></li>', 'Links</a>
							</li>
							', $listpages);
				$listpages .= $menulinks;			
			} 
			?>
			<ul id="menu">
			<li class="page_item page-item-home<?php if (is_home()) { ?> current_page_item<?php } ?>"><a href="<?php bloginfo('url'); ?>">Home</a></li>
			<?php echo $listpages; ?>
			<?php if ($contact_in_menubar == 'yes') { ?>
				<li class="page_item page-item-contact"><a href="mailto:<?php bloginfo('admin_email'); ?>">Contact</a></li>
			<?php } ?>
			</ul>
			<div class="clear"></div>
			</div>
		<?php } 
	}
} 

class widget_comicpress_menubar extends WP_Widget {
	
	function widget_comicpress_menubar() {
		$widget_ops = array('classname' => 'widget_comicpress_menubar', 'description' => __('Displays a menubar.','comicpress') );
		$this->WP_Widget('comicpress_menubar', __('Comicpress Menubar','comicpress'), $widget_ops);
	}
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		comicpress_menubar();
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
register_widget('widget_comicpress_menubar');


function widget_comicpress_menubar_init() {    
	new widget_comicpress_menubar(); 
} 

add_action('widgets_init', 'widget_comicpress_menubar_init');

?>