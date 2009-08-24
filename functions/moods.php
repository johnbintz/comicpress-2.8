<?php
/**
 * Theme Function: Moods
 * Author: Philip M. Hofer (Frumph)
 * Created: 08/22/2009
 * Lets you set and make moods for your blog posts.
 * 
 * Usage:  if (function_exists('comicpress_show_mood_in_post')) comicpress_show_mood_in_post();
 * 
 * Edit a post and it you will see the possible moods you can use, select one.
 * 
 */

function comicpress_show_mood_in_post() {
	global $post;
	$moods_directory = get_option('comicpress-moods_directory');
	$mood_file = get_post_meta( get_the_ID(), "mood", true );
	$mood = explode(".", $mood);
	$mood = reset($mood);
	if ( !empty($mood_file) && file_exists(get_template_directory() . '/images/moods/'.$moods_directory.'/'.$mood_file) ) { ?>
		<div class="post-mood post-<?php echo $mood; ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/moods/default/<?php echo $mood_file; ?>" alt="<?php echo $mood; ?>" title="<?php echo $mood; ?>" /></div>
	<?php }
}

function comicpress_showmood_edit_post() { 
	global $post;
	$moods_directory = get_option('comicpress-moods_directory');
?>
	<div id="mooddiv" class="postbox">
		<h3><?php _e("Available Moods", 'comicpress') ?></h3>
		<div class="inside" style="overflow: hidden">
		Available Moods here, you can set which mood images to use in the ComicPress Options.<br />
		<br />
		<?php 
		
		$currentmood = get_post_meta( $post->ID, "mood", true );

		if (empty($currentmood)) { 
			$mood = 'none';
		} else {
			$mood = explode(".", $currentmood);
			$mood = reset($mood);
		}
		
		$filtered_glob_results = array();
		$count = count($results = glob(get_template_directory() . '/images/moods/'.$moods_directory.'/*'));
		echo $count .' moods are available.<br />
		Using Moods from directory: '.$moods_directory.'<br />
		Current Mood: '.$mood.'<br /><br />';
		if (!empty($results)) { ?>
			<div style="float:left; margin-top: 10px; text-align: center; width: 68px; padding-top: 64px;">
			None.<br />
			<label><input  name="postmood" id="postmood-none" type="radio" value="none"<?php if ( $mood == "none" ) { echo " checked"; } ?> /></label>
			</div>
			<?php foreach ($results as $file) {
				$newmood_file = basename($file);
				$newmood = explode(".", $newmood_file); 
				$newmood = $newmood[0]; ?>
				<div style="float:left; margin-top: 10px; text-align: center; width: 68px; overflow: hidden;">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/images/moods/<?php echo $moods_directory; ?>/<?php echo basename($file); ?>"><br />
					<?php echo $newmood; ?><br />
					<label><input  name="postmood" style="margin-top: 3px;" id="postmood-<?php echo $newmood; ?>" type="radio" value="<?php echo $newmood_file; ?>"<?php if ( $mood == $newmood ) { echo " checked"; } ?> /></label>
				</div>
			<?php }
		} ?>
		</div>
	</div>
<?php }

function comicpress_handle_edit_post_mood_save($post_id) {
	if (empty($_POST['postmood']) || $_POST['postmood'] == 'none') {
		$postmood = 'none';
	} else {
		$postmood = $_POST['postmood'];
	}
	update_post_meta($post_id, 'mood', $postmood);
}

add_action('edit_form_advanced', 'comicpress_showmood_edit_post', 5, 1);
add_action('save_post', 'comicpress_handle_edit_post_mood_save' ,5, 1);
?>