<?php if (comicpress_is_active_sidebar('Drop Bar')) { ?>
<div id="sidebar-dropbar">
	<div class="customsidebar <?php global $enable_if_widgetarea_use_sidebar_css; if ($enable_widgetarea_use_sidebar_css == 'yes') { ?> sidebar<?php } ?>">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Drop Bar') ) : ?><?php endif; ?>
	</div>
</div>
<?php } ?>
