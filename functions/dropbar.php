<?php
/*
Widget Name: Drop Bar
Widget URI: http://comicpress.org/
Description: Creates a Drop Bar with a widget area for it.
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://webcomicplanet.com/

*/

function comicpress_dropbar() { ?>
	<div onmouseover="DropBarMover.mouseOver(event)" onmouseout="DropBarMover.mouseOut(event)" style="zoom:1;top: -100px;height:110px;position:absolute;width:100%;z-index:10000;left:0;" id="DropBar">
		<div class="dropbar">
		<div style="margin: 0 auto;">
			<?php get_sidebar('dropbar'); ?>
			<div style="clear:both;"></div>
		</div>
		<div class="droptab"></div>
		</div>
	</div>
<?php }

function comicpress_dropbar_load() { ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/dropbar.js"></script>
<?php }

add_action('wp_head', 'comicpress_dropbar_load');

add_action('comicpress-header',  'comicpress_dropbar', 10);


?>