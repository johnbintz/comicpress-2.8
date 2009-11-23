<?php global $comicpress_options;
	if ($comicpress_options['disable_lrsidebars_frontpage'] && is_home()) { 
} else {  ?>
<div id="sidebar-left">
	<div class="sidebar-head"></div>
	<div class="sidebar">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Left Sidebar') ) : ?> 
			<div class="widget">
				<?php comicpress_calendar() ?>
			</div>
			<div class="widget">
				<?php comicpress_archive_dropdown(); ?>
			</div>
			<div class="widget">
			<ul><li>
				<?php comicpress_latest_comics() ?>
			</li></ul>
			</div>
		<?php endif; ?>
	</div>
	<div class="sidebar-foot"></div>
</div>
<?php } ?>
