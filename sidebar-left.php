<?php global $disable_lrsidebars_frontpage; 
if ($disable_lrsidebars_frontpage == 'yes' && is_home()) { 
} else {  ?>
<div id="sidebar-left-top"></div>
<div id="sidebar-left">
	<div class="sidebar">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Left Sidebar') ) : ?> 
			<ul>
				<li>
					<?php comicpress_calendar() ?>
				</li>
			</ul>
			<div style="padding-top:20px;"></div>
			<?php comicpress_archive_dropdown(); ?>
			<?php comicpress_latest_comics() ?>
		<?php endif; ?>
	</div>
</div>
<div id="sidebar-left-bottom"></div>
<?php } ?>