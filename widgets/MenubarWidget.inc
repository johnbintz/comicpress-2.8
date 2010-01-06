<?php
/*
Widget Name: Menubar Widget
Widget URI: http://comicpress.org/
Description: Display a calendar of this months posts.
Author: Philip M. Hofer (Frumph)
Version: 1.05
Author URI: http://frumph.net/

*/

class ComicPressMenubarWidget extends WP_Widget {
	
	function ComicPressMenubarWidget($skip_widget_init = false) {
		if (!$skip_widget_init) {
			$widget_ops = array('classname' => __CLASS__, 'description' => __('Displays a menubar.','comicpress') );
			$this->WP_Widget(__CLASS__, __('Comicpress Menubar','comicpress'), $widget_ops);
		}
	}
	
	function comicpress_menubar() {
		global $comicpress_options;
		if (comicpress_check_child_file('menubar') == false) {
			if (file_exists(get_stylesheet_directory() . '/custom-menubar.php')) {
				include(get_stylesheet_directory() . '/custom-menubar.php');
			} else { ?>

		<div id="menubar">
			<div id="menunav">
				<?php if ($comicpress_options['enable_search_in_menubar']) { ?>
<div class="menunav-search">
					<?php include(get_template_directory().'/searchform.php'); ?>
				</div>
				<?php } ?>
<?php if ($comicpress_options['enable_rss_in_menubar']) { ?>
<a href="<?php bloginfo('rss2_url') ?>" title="RSS Feed" class="menunav-rss">RSS</a>
<?php } ?>
				<?php if ($comicpress_options['enable_navigation_in_menubar']) { ?>
					<?php if (is_home() && !$comicpress_options['disable_comic_frontpage']) {
						$comicFrontpage = new WP_Query(); $comicFrontpage->query('showposts=1&cat='.get_all_comic_categories_as_cat_string());
						while ($comicFrontpage->have_posts()) : $comicFrontpage->the_post();
							global $wp_query; $wp_query->is_single = true; ?>
							<div class="menunav-prev">
							<?php previous_comic_link('%link', '&lsaquo;'); ?>
							</div>
							<?php $wp_query->is_single = false;
						endwhile; 
					} elseif (is_single() && in_comic_category()) { ?>
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
				if ($comicpress_options['enable_blogroll_off_links']) {
					$bookmarks = wp_list_bookmarks('echo=0&title_li=&categorize=1&title_before=&title_after=&exclude_category='.$linkcatid); 
					$bookmarks = preg_replace('#<li ([^>]*)>#', '<li class="page-item link">', $bookmarks);
					$bookmarks = preg_replace('#<ul ([^>]*)>#', '<ul>', $bookmarks); 
				}
				$listpages = '';
				if (!$comicpress_options['disable_dynamic_menubar_links']) {
					$listpages = wp_list_pages('echo=0&sort_column=menu_order&depth=4&title_li=');
				}
				if (!empty($bookmarks) && $comicpress_options['enable_blogroll_off_links'])  {
					$listpages = str_replace('Links</a></li>', 'Links</a>
								<ul>
								'.$bookmarks.'
								</ul>
								</li>
								', $listpages);
				}
				$listpages .= $menulinks;
				?>
				<ul id="menu">
				<li class="page_item page-item-home<?php if (is_home()) { ?> current_page_item<?php } ?>"><a href="<?php bloginfo('url'); ?>">Home</a></li>
				<?php echo $listpages; ?>
				<?php if ($comicpress_options['contact_in_menubar']) { ?>
					<li class="page_item page-item-contact"><a href="mailto:<?php bloginfo('admin_email'); ?>">Contact</a></li>
				<?php } ?>
				</ul>
				<div class="clear"></div>
			</div>
		<?php } 
		}
	} 	
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		$this->comicpress_menubar();
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

?>