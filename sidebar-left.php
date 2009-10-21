<?php global $disable_lrsidebars_frontpage; 
if ($disable_lrsidebars_frontpage == 'yes' && is_home()) { 
} else {  ?>
<div id="sidebar-left">
	<div class="sidebar-top"></div>
	<div class="sidebar">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Left Sidebar') ) : ?> 
			<?php $default_image = get_bloginfo('stylesheet_directory').'/images/cal/default.png'; ?>
			<div class="widget">
				<?php comicpress_calendar(array('thumbnail' => $default_image)) ?>
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
	<div class="sidebar-bottom"></div>
</div>
<?php } ?>