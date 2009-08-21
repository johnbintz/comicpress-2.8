<?php
/*
Widget Name: Bookmark
Widget URI: http://comicpress.org/
Description: Adds a bookmark set of icons to save the page your own.
Author: Tyler Martin
Version: 1.01
Author URI: http://webcomicplanet.com/

*/

function comicpress_comic_bookmark() { 
global $post, $wp_query; ?>
	<div class="comic-bookmark">
		<script language="javascript" type="text/javascript">
			<!--

				/* Bookmark Config Settings */

				var cl = 31;
				var imgTag = '<?php bloginfo('template_directory'); ?>/images/1.gif';		//add tag image.
				var imgClearOff = '<?php bloginfo('template_directory'); ?>/images/3a.gif';	//no comic tagged, clear not possible
				var imgGotoOff = '<?php bloginfo('template_directory'); ?>/images/2a.gif';	//no comic tagged, goto not possible
				var imgClearOn = '<?php bloginfo('template_directory'); ?>/images/3.gif';	//clear a tag, shows when comic previously tagged
				var imgGotoOn = '<?php bloginfo('template_directory'); ?>/images/2.gif';	//shows when a comic is tagged  
				var imgInfo = '<?php bloginfo('template_directory'); ?>/images/4.gif';  	//img that displays the help
				var comicDir = '/'; 		//alter this if you run multiple comics in different directories on your site.

				/* Now write out the applicable links */

				createCookie('t', 1);
				var c = readCookie('t');
				if(c && document.getElementById) {
					var l = readCookie('bm');
					var gt = imgGotoOff;
					var ct = imgClearOff;
					if(l) {
						gt = imgGotoOn;
						ct = imgClearOn;
					}
					document.write('<div id="bmh" style="width: 173px; margin: 15px 0 0 0; padding: 5px; position: absolute; color: #eee; font-size: 11px; background-color:#222; border: 1px solid #ccc; visibility: hidden;"><strong>COMIC BOOKMARK</strong><br />Click "Tag Page" to bookmark a comic page. When you return to the site, click "Goto Tag" to continue where you left off.</div>');
					<?php if (is_home()) { ?>
						document.write('<a href="#" onClick="bmhome();return false;"><img src="'+imgTag+'" alt="Tag This Page" border="0"></a>');
						document.write('<a href="#" onClick="gto();return false;"><img src="'+gt+'" alt="Goto Tag" border="0" id="gtc"></a>');
						document.write('<a href="#" onClick="bmc();return false;"><img src="'+ct+'" alt="Clear Tag" border="0" id="rmc"></a>');
						document.write('<a href="#" onMouseOver="document.getElementById(\'bmh\').style.visibility=\'visible\';" onMouseOut="document.getElementById(\'bmh\').style.visibility=\'hidden\';" onClick="return false;"><img src="'+imgInfo+'" alt="" border="0"></a>');
					<?php } elseif (is_single() & in_comic_category()) { ?>
						document.write('<a href="#" onClick="bm();return false;"><img src="'+imgTag+'" alt="Tag This Page" border="0"></a>');
						document.write('<a href="#" onClick="gto();return false;"><img src="'+gt+'" alt="Goto Tag" border="0" id="gtc"></a>');
						document.write('<a href="#" onClick="bmc();return false;"><img src="'+ct+'" alt="Clear Tag" border="0" id="rmc"></a>');
						document.write('<a href="#" onMouseOver="document.getElementById(\'bmh\').style.visibility=\'visible\';" onMouseOut="document.getElementById(\'bmh\').style.visibility=\'hidden\';" onClick="return false;"><img src="'+imgInfo+'" alt="" border="0"></a>');
					<?php } ?>
				}

				/* Below are our functions for this little script */

					function bmhome() {
						if(document.getElementById) {
							document.getElementById('gtc').src = imgGotoOn;
							document.getElementById('rmc').src = imgClearOn;
						}
						createCookie("bm", "<?php the_permalink(); ?>", cl);	      
					}

				function bm() {
					if(document.getElementById) {
						document.getElementById('gtc').src = imgGotoOn;
						document.getElementById('rmc').src = imgClearOn;
					}
					createCookie("bm", window.location, cl);
				}

				function bmc() {
					if(document.getElementById) {
						document.getElementById('gtc').src = imgGotoOff;
						document.getElementById('rmc').src = imgClearOff;
					}
					createCookie("bm","",-1);
				}
		      
				function gto() {
					var g = readCookie('bm');
					if(g) {
						window.location = g;
					}	
				}

				/* The follow functions have been borrowed from Peter-Paul Koch. Please find them here: http://www.quirksmode.org */

				function createCookie(name,value,days) {
					if (days) {
						var date = new Date();
						date.setTime(date.getTime()+(days*24*60*60*1000));
						var expires = "; expires="+date.toGMTString();
					} else var expires = "";
					document.cookie = name+"="+value+expires+"; path="+comicDir;
				}
				function readCookie(name) {
					var nameEQ = name + "=";
					var ca = document.cookie.split(';');
					for(var i=0;i < ca.length;i++) {
						var c = ca[i];
						while (c.charAt(0)==' ') c = c.substring(1,c.length);
						if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
					}
					return null;
				}
			//-->
		</script>
	</div>
<?php } 
	

class widget_comicpress_bookmark extends WP_Widget {
	
	function widget_comicpress_bookmark() {
		$widget_ops = array('classname' => 'widget_comicpress_bookmark', 'description' => 'Creates a set of buttons that let the user return to the page they tagged.' );
		$this->WP_Widget('comicpress_bookmark', 'ComicPress Bookmark', $widget_ops);
	}
	
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		comicpress_comic_bookmark();
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<?php
	}
}
register_widget('widget_comicpress_bookmark');


function widget_comicpress_bookmark_init() {    
	new widget_comicpress_bookmark(); 
} 

add_action('widgets_init', 'widget_comicpress_bookmark_init');

?>