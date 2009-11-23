<?php if (comicpress_is_active_sidebar('Left of Comic')) { ?>
<div id="sidebar-comicleft" class="customsidebar <?php if ($comicpress_options['enable_widgetarea_use_sidebar_css']) { ?> sidebar<?php } ?>">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Left of Comic') ) : ?><?php endif; ?>
</div>
<?php } ?>
