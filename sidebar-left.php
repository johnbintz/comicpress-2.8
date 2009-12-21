<?php global $comicpress_options;
if (!$comicpress_options['disable_lrsidebars_frontpage']) { ?>
<div id="sidebar-left">
	<div class="sidebar-head"></div>
		<div class="sidebar">
		<?php 
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Left Sidebar') ) :
				if (!is_cp_theme_layout('standard,v')) { 
					the_widget('CalendarWidget');
					the_widget('ArchiveDropdownWidget','mode=monthly_archive');
				}
				the_widget('LatestComicsWidget');
			endif; 
		?>
		</div>
	<div class="sidebar-foot"></div>
</div>
<?php } ?>
