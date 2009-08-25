<?php
/*
Widget Name: Graphical Navigation
Widget URI: http://comicpress.org/
Description: You can place graphical navigation buttons on your comic, for ComicPress 2.8
Author: Philip M. Hofer (Frumph)
Version: 1.01
Author URI: http://webcomicplanet.com/

*/

class widget_comicpress_graphical_navigation extends WP_Widget {
	
	function widget_comicpress_graphical_navigation() {
		$widget_ops = array('classname' => 'widget_comicpress_graphical_navigation', 'description' => 'Displays Graphical Navigation Buttons.' );
		$this->WP_Widget('graphicalnavigation', 'Comic Navigation', $widget_ops);
	}
	
	function widget($args, $instance) {
		global $wp_query, $post;
		
		$this_permalink = get_permalink();
		
		$temp_query = $wp_query->is_single;
		$wp_query->is_single = true;
		$prev_comic = get_previous_comic_permalink();
		$next_comic = get_next_comic_permalink();
		$wp_query->is_single = $temp_query;
		$temp_query = null;
		
		$first_comic = get_first_comic_permalink();
		$last_comic = get_last_comic_permalink(); 
		
		$prev_story = '';
		$next_story = '';
		?>
		<div id="comic_navi_wrapper">
		<?php if ($instance['firstlast'] != 'off') {  ?>
			<div class="comic_navi_first">
			<?php if (!empty($first_comic) && ($first_comic != $this_permalink)) { ?>
				<a href="<?php echo $first_comic; ?>" class="rollfirst" title="First">&nbsp;</a>
			<?php } else { ?>
				<div class="rollfirst rollagain"></div>
			<?php } ?>
			</div>
		<?php } 
		if ($instance['storynav'] != 'off') { ?>
			<div class="comic_navi_story_previous">
			<?php if (!empty($prev_story)) { ?>
				<a href="<?php echo $prev_story; ?>" class="rollstoryprev" title="Previous Story Start">&nbsp;</a>
			<?php } else { ?>
				<div class="rollstoryprev rollagain"></div>
			<?php } ?>
			</div>
		<?php } 
		if ($instance['previous'] != 'off') { ?>
			<div class="comic_navi_previous">
			<?php if (!empty($prev_comic)) { ?>
				<a href="<?php echo $prev_comic; ?>" class="rollprev" title="Previous">&nbsp;</a>
			<?php } else { ?>
				<div class="rollprev rollagain"></div>
			<?php } ?>
			</div>
		<?php }
		if ($instance['archives'] != 'off' && !empty($instance['archive_path'])) { ?>
			<div class="comic_navi_archives">
			<a href="<?php echo $instance['archive_path']; ?>" class="rollarchives" title="Archives">&nbsp;</a>
			</div>
		<?php } 
		if ($instance['random'] != 'off') { ?>
			<div class="comic_navi_random">
				<a href="<?php echo bloginfo('url'); ?>/?randomcomic" class="rollrandom" title="Random Comic">&nbsp;</a>
			</div>
		<?php } 
		if ($instance['comments'] != 'off') { ?>
			<div class="comic_navi_comments">
				<a href="<?php the_permalink(); ?>#respond" class="rollcomments" title="Comments"><span class="comic_navi_comments_count"><?php comments_number('0', '1', '%'); ?></span></a>
			</div>
		<?php } 		
		if ($instance['next'] != 'off') { ?>
			<div class="comic_navi_next">
			<?php if (!empty($next_comic)) { ?>
				<a href="<?php echo $next_comic; ?>" class="rollnext" title="Next">&nbsp;</a>
			<?php } else { ?>
				<div class="rollnext rollagain"></div>
			<?php } ?>
			</div>
		<?php } 
		if ($instance['storynav'] != 'off') { ?>
			<div class="comic_navi_story_next">
			<?php if (!empty($next_story)) { ?>
				<a href="<?php echo $next_story; ?>" class="rollstorynext" title="Next Story Start">&nbsp;</a>
			<?php } else { ?>
				<div class="rollstorynext rollagain"></div>
			<?php } ?>
			</div>
		<?php }
		if ($instance['firstlast'] != 'off') {  ?>
			<div class="comic_navi_latest">
			<?php if (!empty($last_comic) && ($last_comic != $this_permalink)) { ?>
				<a href="<?php echo $first_comic; ?>" class="rolllast" title="Latest">&nbsp;</a>
			<?php } else { ?>
				<div class="rolllast rollagain"></div>
			<?php } ?>
			</div>
		<?php } ?>
			<div class="clear"></div>
		</div>
<?php } 

	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['firstlast'] = $new_instance['firstlast'];
		$instance['storynav'] = $new_instance['storynav'];
		$instance['previous'] = $new_instance['previous'];
		$instance['random'] = $new_instance['random'];
		$instance['archives'] = $new_instance['archives'];
		$instance['comments'] = $new_instance['comments'];
		$instance['next'] = $new_instance['next'];
		$instance['archive_path'] = strip_tags($new_instance['archive_path']);
		return $instance;
	}
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'firstlast' => 'on', 'storynav' => 'off', 'previous' => 'on',  'random' => 'off', 'archives' => 'off', 'comments' => 'off', 'next' => 'on', 'archive_path' => '' ) );
		$firstlast = $instance['firstlast']; if (empty($firstlast)) $firstlast = 'on';
		$storynav = $instance['storynav']; 	if (empty($storynav)) $storynav = 'off';
		$previous = $instance['previous']; 	if (empty($previous)) $previous = 'on';
		$random = $instance['random']; if (empty($random)) $random = 'off';
		$archives = $instance['archives']; if (empty($archives)) $archives = 'off';
		$comments = $instance['comments']; if (empty($comments)) $comments = 'off';
		$archive_path = $instance['archive_path'];
		$next = $instance['next']; if (empty($next)) $next = 'on';
		?>
	
		<label for="<?php echo $this->get_field_id('firstlast'); ?>"><strong>First &amp; Last</strong><br />
		<input id="<?php echo $this->get_field_id('firstlast'); ?>" name="<?php echo $this->get_field_name('firstlast'); ?>" type="radio" value="on"<?php if ( $firstlast == "on") { echo " checked"; } ?> />On</label>&nbsp;<input id="<?php echo $this->get_field_id('firstlast'); ?>" name="<?php echo $this->get_field_name('firstlast'); ?>" type="radio" value="off"<?php if ( $firstlast == "off") { echo " checked"; } ?> />Off</label><br />
		<br />
		<label for="<?php echo $this->get_field_id('storynav'); ?>"><strong>Storyline Prev &amp; Next</strong><br />
		<input id="<?php echo $this->get_field_id('storynav'); ?>" name="<?php echo $this->get_field_name('storynav'); ?>" type="radio" value="on"<?php if ( $storynav == "on") { echo " checked"; } ?> />On</label>&nbsp;<input id="<?php echo $this->get_field_id('storynav'); ?>" name="<?php echo $this->get_field_name('storynav'); ?>" type="radio" value="off"<?php if ( $storynav == "off") { echo " checked"; } ?> />Off</label><br />
		<br />
		<label for="<?php echo $this->get_field_id('previous'); ?>"><strong>Previous</strong><br />
		<input id="<?php echo $this->get_field_id('previous'); ?>" name="<?php echo $this->get_field_name('previous'); ?>" type="radio" value="on"<?php if ( $previous == "on") { echo " checked"; } ?> />On</label>&nbsp;<input id="<?php echo $this->get_field_id('previous'); ?>" name="<?php echo $this->get_field_name('previous'); ?>" type="radio" value="off"<?php if ( $previous == "off") { echo " checked"; } ?> />Off</label><br />
		<br />
		<label for="<?php echo $this->get_field_id('next'); ?>"><strong>Next</strong><br />
		<input id="<?php echo $this->get_field_id('next'); ?>" name="<?php echo $this->get_field_name('next'); ?>" type="radio" value="on"<?php if ( $next == "on") { echo " checked"; } ?> />On</label>&nbsp;<input id="<?php echo $this->get_field_id('next'); ?>" name="<?php echo $this->get_field_name('next'); ?>" type="radio" value="off"<?php if ( $next == "off") { echo " checked"; } ?> />Off</label><br />
		<br />
		<label for="<?php echo $this->get_field_id('archives'); ?>"><strong>Archives</strong><br />
		<input id="<?php echo $this->get_field_id('archives'); ?>" name="<?php echo $this->get_field_name('archives'); ?>" type="radio" value="on"<?php if ( $archives == "on") { echo " checked"; } ?> />On</label>&nbsp;<input id="<?php echo $this->get_field_id('archives'); ?>" name="<?php echo $this->get_field_name('archives'); ?>" type="radio" value="off"<?php if ( $archives == "off") { echo " checked"; } ?> />Off<br />
		Archive URL:<br />
		<input class="widefat" id="<?php echo $this->get_field_id('archive_path'); ?>" name="<?php echo $this->get_field_name('archive_path'); ?>" type="text" value="<?php echo attribute_escape($archive_path); ?>" /></label><br />
		<br />
		<label for="<?php echo $this->get_field_id('comments'); ?>"><strong>Comments</strong><br />
		<input id="<?php echo $this->get_field_id('comments'); ?>" name="<?php echo $this->get_field_name('comments'); ?>" type="radio" value="on"<?php if ( $comments == "on") { echo " checked"; } ?> />On</label>&nbsp;<input id="<?php echo $this->get_field_id('comments'); ?>" name="<?php echo $this->get_field_name('comments'); ?>" type="radio" value="off"<?php if ( $comments == "off") { echo " checked"; } ?> />Off</label><br />
		<br />
		<label for="<?php echo $this->get_field_id('random'); ?>"><strong>Random</strong><br />
		<input id="<?php echo $this->get_field_id('random'); ?>" name="<?php echo $this->get_field_name('random'); ?>" type="radio" value="on"<?php if ( $random == "on") { echo " checked"; } ?> />On</label>&nbsp;<input id="<?php echo $this->get_field_id('random'); ?>" name="<?php echo $this->get_field_name('random'); ?>" type="radio" value="off"<?php if ( $random == "off") { echo " checked"; } ?> />Off</label><br />
		
		<?php
	}
}
register_widget('widget_comicpress_graphical_navigation');


function widget_comicpress_graphical_navigation_init() {    
	new widget_comicpress_graphical_navigation(); 
} 

add_action('widgets_init', 'widget_comicpress_graphical_navigation_init');

?>