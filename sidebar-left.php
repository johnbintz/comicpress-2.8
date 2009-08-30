<?php global $disable_lrsidebars_frontpage; 
if ($disable_lrsidebars_frontpage == 'yes' && is_home()) { 
} else {  ?>
<div id="sidebar-left-top"></div>
<div id="sidebar-left">
	<div class="sidebar">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Left Sidebar') ) : ?> 
			<ul>
				<li>
					<?php $default_image = get_bloginfo('stylesheet_directory').'/images/cal/default.png'; ?>
					<?php comicpress_calendar(array('thumbnail' => $default_image)) ?>
				</li>
			</ul>
			<?php comicpress_archive_dropdown(); ?>
			<?php comicpress_latest_comics() ?>
		<?php endif; ?>
	</div>
</div>
<div id="sidebar-left-bottom"></div>
<?php } ?>