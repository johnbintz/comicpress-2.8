<?php if (comicpress_is_active_sidebar('Under Comic')) { ?>
<div id="sidebar-undercomic" class="customsidebar <?php global $enable_if_widgetarea_use_sidebar_css; if ($enable_widgetarea_use_sidebar_css == 'yes') { ?> sidebar<?php } ?>">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Under Comic') ) : ?><?php endif; ?>
</div>
<?php } ?>
