<?php

class ComicPressBookmarkWidget extends WP_Widget {
	var $text_fields;

	function ComicPressBookmarkWidget($skip_widget_init = false) {
		if (!$skip_widget_init) {
			$widget_ops = array('classname' => __CLASS__, 'description' => __('Allow the user to bookmark a page and then jump to it upon return.','comicpress') );
			$this->WP_Widget(__CLASS__, __('ComicPress Bookmark','comicpress'), $widget_ops);
		}

		$this->text_fields = array(
			'three-button' => array(
				'tag-page' => array(
					'label' => __('Tag page', 'comicpress'),
					'default' => __('Bookmark', 'comicpress')
				),
				'clear-tag-off' => array(
					'label' => __('Clear tag off', 'comicpress'),
					'default' => ''
				),
				'clear-tag-on' => array(
					'label' => __('Clear tag on', 'comicpress'),
					'default' => __('Clear', 'comicpress')
				),
				'goto-tag-off' => array(
					'label' => __('Goto tag off', 'comicpress'),
					'default' => ''
				),
				'goto-tag-on' => array(
					'label' => __('Goto tag on', 'comicpress'),
					'default' => __('Goto', 'comicpress')
				)
			),
			'one-button'   => array(
				'bookmark-clicker-off' => array(
					'label' => __('Set bookmark', 'comicpress'),
					'default' => __('+Bookmark', 'comicpress')
				),
				'bookmark-clicker-on' => array(
					'label' => __('Use bookmark', 'comicpress'),
					'default' => __('&gt;&gt;Bookmark', 'comicpress')
				)
			)
		);
	}

  function init() {
    add_action('wp_head', array(&$this, 'wp_head'));
  }

  function is_active() {
		add_action('template_redirect', array(&$this, 'template_redirect'));
  }

  function template_redirect() {
    wp_enqueue_script('prototype');
    wp_enqueue_script('cookiejar', get_template_directory_uri() . '/js/cookiejar.js', array('prototype'));
    wp_enqueue_script('bookmark', get_template_directory_uri() . '/js/bookmark.js', array('prototype', 'cookiejar'));
  }

  function wp_head() { ?>
    <script type="text/javascript">
      var image_root = '<?php echo get_template_directory_uri() ?>/images/';
      var permalink = '<?php the_permalink() ?>';
    </script>
  <?php }

  function form($instance) {
  	?>
  	<div id="<?php echo $this->get_field_id('wrapper') ?>">
  		<p>
  		  <label><?php _e('Title', 'comicpress') ?><br />
  		    <input class="widefat" type="text"
  		           name="<?php echo $this->get_field_name('title') ?>"
  		           value="<?php echo esc_attr($instance['title']) ?>" />
  		  </label>
  		</p>
  	<?php
  	foreach (array(
  		'three-button' => __('Three-button mode', 'comicpress'),
  		'one-button' => __('One-button mode', 'comicpress')
  	) as $mode => $label) { ?>
  		<p>
  		  <label>
  		    <input type="radio"
  		    			 id="<?php echo $this->get_field_id($mode) ?>"
  		           name="<?php echo $this->get_field_name('mode') ?>"
  		           value="<?php echo esc_attr($mode) ?>"
  		           <?php echo $instance['mode'] == $mode ? 'checked="checked"' : '' ?> /> <?php echo $label ?>
  		  </label>
  		</p>
  		<div id="<?php echo $this->get_field_id("${mode}-options") ?>"><p>
				<?php
					foreach ($this->text_fields[$mode] as $name => $info) {
						extract($info);
						$value = empty($instance[$name]) ? $default : $instance[$name];
						?>
							<label><?php echo $label ?><br />
								<input class="widefat" type="text"
								       name="<?php echo $this->get_field_name($name) ?>"
								       value="<?php echo esc_attr($value) ?>" />
							</label>
						<br /><?php
					}
				?>
  		</p></div>
  	<?php } ?>
  	</div>
  	<script type="text/javascript">
			(function($) {
				var wrapper = '<?php echo $this->get_field_id('wrapper') ?>';
				var radios = $('#' + wrapper + ' input[type=radio]');

				var show = function() {
					radios.each(function() {
						$('#' + this.id + '-options')[this.checked ? 'show' : 'hide']();
					});
				};

				radios.click(show);
				show();
			}(jQuery));
  	</script>
  <?php }

  function update($new_instance, $old_instance) {
  	$instance = array();

  	$all_text_fields = array('title');
  	foreach ($this->text_fields as $type => $fields) {
  		$all_text_fields = array_merge($all_text_fields, array_keys($fields));
  	}

		foreach ($all_text_fields as $key) {
			$instance[$key] = strip_tags($new_instance[$key]);
		}

		if (isset($this->text_fields[$new_instance['mode']])) {
			$instance['mode'] = $new_instance['mode'];
		} else {
			$instance['mode'] = array_shift(array_keys($this->text_fields));
		}

		return $instance;
  }

  function widget($args, $instance) {
  	global $post;
  	extract($args, EXTR_SKIP);

		echo $before_widget;

		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if (!empty($title)) { echo $before_title . $title . $after_title; };

		$mode = !isset($this->text_fields[$instance['mode']]) ? array_shift(array_keys($this->text_fields)) : $instance['mode'];

		$link = is_home() ? get_bloginfo('url') : get_permalink($post);

  	$id = 'comic-bookmark-' . md5(rand());
    switch ($instance['mode']) {
      case 'three-button': ?>
		    <div class="bookmark-widget" id="<?php echo $id ?>">
      		<a href="#" class="tag-page"></a>
      		<a href="#" class="goto-tag"></a>
      		<a href="#" class="clear-tag"></a>
      	</div>
				<?php break;
			case 'one-button': ?>
		    <div class="bookmark-widget" id="<?php echo $id ?>">
      		<a href="#" class="bookmark-clicker"></a>
      	</div>
				<?php break;
	 	} ?>
	  <script type="text/javascript">
			(function() {
				ComicBookmark.setup('<?php echo $id ?>', '<?php echo $mode ?>', '<?php echo $link ?>', {
					<?php
						$elements = array();
						foreach (array_keys($this->text_fields[$mode]) as $field) {
							$elements[] = "'{$field}': '{$instance[$field]}'";
						}
						echo implode(',', $elements);
					?>
				});
			}());
	  </script><?php
		echo $after_widget;
  }
}
