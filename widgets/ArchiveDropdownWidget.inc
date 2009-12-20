<?php
/*
Widget Name: comicpress archive dropdown
Widget URI: http://comicpress.org/
Description:
Author: Philip M. Hofer (Frumph) & John Bintz
Version: 1.1
Author URI: http://frumph.net/

*/

class ArchiveDropdownWidget extends WP_Widget {
	var $modes;

	function ArchiveDropdownWidget() {
		$widget_ops = array('classname' => 'ArchiveDropdownWidget', 'description' => __('Display a dropdown list of your archives, styled.','comicpress') );
		$this->WP_Widget('archive_dropdown', __('ComicPress Archive Dropdown','comicpress'), $widget_ops);

		$this->modes = array(
			'monthly_archive' => __('Monthly archive', 'comicpress'),
			'comic_archive'   => __('Comic archive', 'comicpress'),
			'storyline_order'   => __('Storyline archive pages', 'comicpress'),
			'storyline_order_post_link'   => __('Storyline posts', 'comicpress'),
		);
	}

	function _verify_nonce() { return __comicpress_verify_nonce(); }

	function template_redirect() {
		if (ArchiveDropdownWidget::_verify_nonce() == 'follow-archive-dropdown') {
			wp_redirect($_GET['cp']['urls']);
		}
	}

	/**
	 * Build a dropdown geared toward quick links to posts.
	 */
	function build_dropdown($entries) {
		if (is_string($entries) || is_array($entries)) {
			$id = 'archive-dropdown-' . md5(rand());
			$button_id = 'archive-dropdown-submit-' . md5(rand());

			$nonce = wp_create_nonce('comicpress');
			$action_nonce = wp_create_nonce('comicpress-follow-archive-dropdown');

			ob_start(); ?>
			<ul>
				<li class="archive-dropdown-wrap" id="<?php echo esc_attr($id) ?>">
					<form action="" method="get">
						<input type="hidden" name="cp[_nonce]" value="<?php echo esc_attr($nonce) ?>" />
						<input type="hidden" name="cp[action]" value="follow-archive-dropdown" />
						<input type="hidden" name="cp[_action_nonce]" value="<?php echo esc_attr($action_nonce) ?>" />

						<select name="cp[urls]" class="archive-dropdown">
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
						<input id="<?php echo esc_attr($button_id) ?>" type="submit" value="<?php echo esc_attr(apply_filters('comicpress_archive_dropdown_submit_button', __('Go', 'comicpress'))) ?>" />
					</form>
				</li>
			</ul>
				<script type="text/javascript">
					document.getElementById('<?php echo esc_js($button_id) ?>').style.display = 'none';
					document.getElementById('<?php echo esc_js($id) ?>').onchange = function(e) {
						document.location.href = e.target.options[e.target.selectedIndex].value;
					};
				</script>
			<?php return ob_get_clean();
		}
		return '';
	}

	/**
	 * Build the monthly archive dropdown.
	 */
	function build_monthly_archive_dropdown() {
		return $this->build_dropdown(wp_get_archives('type=monthly&format=option&show_post_count=-1&echo=0'));
	}

	function _new_comicpressstoryline() { return new ComicPressStoryline(); }
	function _new_comicpressdbinterface() { return new ComicPressDBInterface(); }
	function _new_wp_query() { return new WP_Query(); }

	/**
	 * Build the comic archive dropdown.
	 */
	function build_comic_archive_dropdown() {
		$storyline = $this->_new_comicpressstoryline();
		$storyline->read_from_options();

		$query = $this->_new_wp_query();
		$query->query(array(
			'showposts' => -1,
			'category__in' => $storyline->build_from_restrictions()
		));

		$results = array();
		while($query->have_posts()) {
			$post = $query->next_post();
			$results[get_permalink($post)] = get_the_title($post);
		}

		return $this->build_dropdown($results);
	}

	/**
	 * Build dropdown based on storyline order.
	 */
	function build_storyline_order_dropdown() {
		$storyline = $this->_new_comicpressstoryline();
		$storyline->read_from_options();

		$results = array();
		if (!empty($storyline->_structure)) {
			foreach ($storyline->_structure as $id => $info) {
				$category = get_category($id);
				if (!empty($category)) {
					$results[get_category_link($id)] = str_repeat('&nbsp;', ($info['level'] - 1) * 3) . $category->name;
				}
			}
		}

		return $this->build_dropdown($results);
	}

	/**
	 * Build dropdown based on storyline order, linking to the first post in each category.
	 */
	function build_storyline_order_post_link_dropdown() {
		$storyline = $this->_new_comicpressstoryline();
		$storyline->read_from_options();

		$dbi = $this->_new_comicpressdbinterface();

		$results = array();
		if (!empty($storyline->_structure)) {
			foreach ($storyline->_structure as $id => $info) {
				$category = get_category($id);
				if (!empty($category)) {
					$post = $dbi->get_first_post($id);
					if (!empty($post)) {
						$results[get_permalink($post)] = str_repeat('&nbsp;', ($info['level'] - 1) * 3) . $category->name;
					}
				}
			}
		}

		return $this->build_dropdown($results);
	}

	/**
	 * Render the widget.
	 */
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if (!empty($title)) { echo $before_title . $title . $after_title; };

		if (method_exists($this, "build_{$instance['mode']}_dropdown")) {
			echo $this->{"build_{$instance['mode']}_dropdown"}();
		}

		echo $after_widget;
	}

	/**
	 * Update widget parameters.
	 */
	function update($new_instance, $old_instance) {
		$instance = array();

		foreach (array('title', 'mode') as $field) {
			if (isset($new_instance[$field])) {
				switch ($field) {
					case 'mode':
						if (isset($this->modes[$new_instance[$field]])) {
							$instance[$field] = $new_instance[$field];
						}
						break;
					default:
						$instance[$field] = strip_tags($new_instance[$field]);
						break;
				}
			}
		}

		return $instance;
	}

	/**
	 * Show the widget editor.
	 */
	function form($instance) {
		$valid_mode = array_shift(array_keys($this->modes));
		$instance = wp_parse_args((array)$instance, array('title' => '', 'mode' => $valid_mode));

		foreach (array(
			'title' => __('Title:', 'comicpress'),
			'mode' => __('Show in widget:', 'comicpress')
		) as $field => $label) { ?>
			<p>
				<?php switch ($field) {
					case 'mode': ?>
						<?php echo $label ?><br />
						<?php	foreach ($this->modes as $mode => $label) { ?>
							<label><input type="radio" name="<?php echo $this->get_field_name($field); ?>" value="<?php echo $mode ?>" <?php echo ($mode == $instance['mode']) ? 'checked="checked"' : '' ?> /> <?php echo $label ?></label><br />
						<?php }
						break;
						default: ?>
							<label for="<?php echo $this->get_field_id($field); ?>"><?php echo $label ?>
								<input class="widefat" id="<?php echo $this->get_field_id($field); ?>" name="<?php echo $this->get_field_name($field); ?>" type="text" value="<?php echo esc_attr($instance[$field]) ?>" />
							</label>
							<br />
							<?php break;
				} ?>
			</p>
		<?php }
	}
}

add_action('template_redirect', array('ArchiveDropdownWidget', 'template_redirect'));
