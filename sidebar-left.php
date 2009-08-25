<div id="sidebar-left-top"></div>
<div id="sidebar-left">
	<div class="sidebar">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Left Sidebar') ) : ?> 
			<ul>
				<li>
					<?php get_calendar() ?>
				</li>
			</ul>
			<?php comicpress_latest_comics() ?>
			<ul>
				<li>
					<h2>Monthly Archives</h2>
					<ul>
						<?php wp_get_archives('type=monthly') ?>
					</ul>
				</li>
			</ul>
		<?php endif; ?>
	</div>
</div>
<div id="sidebar-left-bottom"></div>