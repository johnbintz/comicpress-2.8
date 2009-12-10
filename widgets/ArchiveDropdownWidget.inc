<?php
/*
Widget Name: comicpress archive dropdown
Widget URI: http://comicpress.org/
Description:
Author: Philip M. Hofer (Frumph)
Version: 1.04
Author URI: http://frumph.net/

*/

/*
function comicpress_archive_dropdown_storyline() {
	$storyline = new ComicPressStoryline();
	$storyline->create_structure(get_option('comicpress-storyline-category-order'));
	$categories =  array_keys($storyline->_structure);
	foreach ($categories as $id) {
		$post = ComicPressDBInterface::get_instance()->get_first_comic($id);
	}
}
*/

function comicpress_archive_dropdown() { ?>
	<div class="archive-dropdown-wrap">
		<select name="archive-dropdown" class="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'>
		<option value=""><?php echo attribute_escape(__('Archives...','comicpress')); ?></option>
			<?php wp_get_archives('type=monthly&format=option&show_post_count=-1'); ?>
		</select>
	</div>
<?php }

function comicpress_archive_dropdown_comics() {
	global $post, $wp_query;
	$temp_post = $post;
	$temp_query = $wp_query;
?>
	<div class="archive-dropdown-wrap">
		<select name="archive-dropdown" class="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'>
		<option value=""><?php echo attribute_escape(__('Archives...','comicpress')); ?></option>
				<?php $comicArchive = new WP_Query(); $comicArchive->query('showposts=-1&cat='.get_all_comic_categories_as_cat_string());
				while ($comicArchive->have_posts()) : $comicArchive->the_post() ?>
					<option value="<?php echo get_permalink($post->ID) ?>"><?php the_title() ?></option>
				<?php endwhile; ?>
		</select>
	</div>
	<?php
	$post = $temp_post; $temp_post = null;
	$wp_query = $temp_query; $temp_query = null;
}

class ArchiveDropdownWidget extends WP_Widget {
	function ArchiveDropdownWidget() {
		$widget_ops = array('classname' => 'ArchiveDropdownWidget', 'description' => __('Display a dropdown list of your archives, styled.','comicpress') );
		$this->WP_Widget('archive_dropdown', __('ComicPress Archive Dropdown','comicpress'), $widget_ops);
	}

	function _verify_nonce() { return __comicpress_verify_nonce(); }

	function template_redirect() {
		if ($this->_verify_nonce() == 'follow-archive-dropdown') {

		}
	}

	function build_dropdown($entries) {
		if (is_string($entries) || is_array($entries)) {
			$id = 'archive-dropdown-' . md5(rand());

			$nonce = wp_create_nonce('comicpress');
			$action_nonce = wp_create_nonce('comicpress-follow-archive-dropdown');

			ob_start(); ?>
				<div class="archive-dropdown-wrap" id="<?php echo esc_attr($id) ?>">
					<form action="" method="get">
						<input type="hidden" name="cp[_nonce]" value="<?php echo esc_attr($nonce) ?>" />
						<input type="hidden" name="cp[action]" value="follow-archive-dropdown" />
						<input type="hidden" name="cp[_action_nonce]" value="<?php echo esc_attr($action_nonce) ?>" />

						<select name="cp[urls]">
							<option value=""><?php echo esc_html(apply_filters('comicpress_archive_dropdown_default_entry', __('Archives...', 'comicpress'))) ?></option>
							<?php
							  if (is_string($entries)) {
							  	echo $entries;
							  } else {
							  	foreach ($entries as $url => $value) { ?>
										<option value="<?php echo esc_attr($url) ?>"><?php echo esc_html($value) ?></option>
							  	<?php	}
							  }
							?>
						</select>
						<input type="submit" value="<?php echo esc_attr(apply_filters('comicpress_archive_dropdown_submit_button', __('Go', 'comicpress'))) ?>" />
					</form>
				</div>
				<script type="text/javascript">

				</script>
			<?php return ob_get_clean();
		}
		return '';
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		if ($instance['showcomicposts'] == 'on') {
			comicpress_archive_dropdown_comics();
		} else {
			comicpress_archive_dropdown();
		}
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['showcomicposts'] = $new_instance['showcomicposts'];
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'showcomicposts' => 'off' ) );
		$title = strip_tags($instance['title']);
		$showcomicposts = $instance['showcomicposts']; if (empty($showcomicposts)) $showcomicposts = 'off';
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','comicpress'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('showcomicposts'); ?>"><strong><?php _e('Show individual comic posts?','comicpress'); ?></strong><br />
		<input id="<?php echo $this->get_field_id('showcomicposts'); ?>" name="<?php echo $this->get_field_name('showcomicposts'); ?>" type="radio" value="on"<?php if ( $showcomicposts == "on") { echo " checked"; } ?> />On</label>&nbsp;<input id="<?php echo $this->get_field_id('showcomicposts'); ?>" name="<?php echo $this->get_field_name('showcomicposts'); ?>" type="radio" value="off"<?php if ( $showcomicposts == "off") { echo " checked"; } ?> />Off</label></p>
		<?php
	}
}
