<?php 
	global $disable_default_menubar;
	if ($disable_default_menubar != 'yes') {
		comicpress_menubar();
	} 
?>
<?php if (comicpress_is_active_sidebar('Menubar')) { ?>
<div id="sidebar-menubar" class="customsidebar <?php global $enable_if_widgetarea_use_sidebar_css; if ($enable_widgetarea_use_sidebar_css == 'yes') { ?> sidebar<?php } ?>">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Menubar') ) : ?><?php endif; ?>
</div>
<?php } ?>

	