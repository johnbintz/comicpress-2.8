<?php global $comicpress_options;
if (!$comicpress_options['disable_lrsidebars']) { ?>
<div id="sidebar-left">
	<div class="sidebar-head"></div>
		<div class="sidebar">
		<?php 
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Left Sidebar') ) :
				if (!is_cp_theme_layout('standard,v')) { 
					the_widget('ComicPressCalendarWidget');
					the_widget('ComicPressArchiveDropdownWidget', 'mode=storyline_order');
				}
				the_widget('ComicPressLatestComicsWidget');
			endif; 
		?>
		</div>
	<div class="sidebar-foot"></div>
</div>
<?php } ?>
