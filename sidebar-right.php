<?php global $comicpress_options;
if (!$comicpress_options['disable_lrsidebars_frontpage']) { ?>
<div id="sidebar-right">
	<div class="sidebar-head"></div>
		<div class="sidebar">
		<?php 
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Right Sidebar') ) : 
//			the_widget('ComicpressBookmarkWidget','mode=three-button');
			if (is_cp_theme_layout('standard,v')) { 
				the_widget('ComicpressCalendarWidget');
//				the_widget('ComicpressArchiveDropdownWidget','mode=monthly_archive');
			}
			the_widget('WP_Widget_Pages');
			the_widget('WP_Widget_Categories','hierarchical=1&count=1');

		endif; 
		?>
		</div>
	<div class="sidebar-foot"></div>
</div>
<?php } ?>
