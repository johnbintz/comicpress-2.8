<?php if (comicpress_is_active_sidebar('Footer')) { ?>
<div id="sidebar-footer" class="customsidebar <?php if ($comicpress_options['enable_widgetarea_use_sidebar_css']) { ?> sidebar<?php } ?>">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer') ) : ?><?php endif; ?>
</div>
<?php } ?>
