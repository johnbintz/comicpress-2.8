<?php global $disable_lrsidebars_frontpage; 
if ($disable_lrsidebars_frontpage != 'yes') { ?>
<div id="sidebar-right">
	<div class="sidebar-head"></div>
		<div class="sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Right Sidebar') ) : ?>
				<?php comicpress_comic_bookmark() ?>
				
				<?php if (is_cp_theme_layout('standard,v')) { ?>
					<div class="widget">
						<?php comicpress_calendar(); ?>
					</div>
				<?php } ?>
				<div class="widget">
				<ul><li>
					<h2>Menu</h2>
						<ul>
							<?php wp_list_pages('title_li=') ?>
						</ul>
				</li></ul>
				</div>
				<div class="widget">
					<ul><?php wp_list_categories('title_li=<h2>Categories</h2>') ?></ul>
				</div>
			<?php endif; ?>
		</div>
	<div class="sidebar-foot"></div>
</div>
<?php } ?>
