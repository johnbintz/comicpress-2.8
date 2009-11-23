<?php 
	if (!$comicpress_options['disable_default_menubar']) {
		comicpress_menubar();
	} 
?>
<?php if (comicpress_is_active_sidebar('Menubar')) { ?>
<div id="sidebar-menubar" class="customsidebar <?php if ($comicpress_options['enable_widgetarea_use_sidebar_css']) { ?> sidebar<?php } ?>">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Menubar') ) : ?><?php endif; ?>
</div>
<?php } ?>
