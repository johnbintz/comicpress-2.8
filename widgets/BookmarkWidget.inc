<?php

class BookmarkWidget extends WP_Widget {
	function BookmarkWidget() {
		$widget_ops = array('classname' => __CLASS__, 'description' => __('Allow the user to bookmark a page and then jump to it upon return.','comicpress') );
		$this->WP_Widget('comicpress-bookmark', __('ComicPress Bookmark','comicpress'), $widget_ops);
	}

  function init() {
    add_action('wp_head', array(&$this, 'wp_head'));

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

  function widget() {
    ?>
    <div id="comic-bookmark-holder">
      <a href="#" class="tag-page"><img src="<?php echo get_template_directory_uri()  ?>/images/1.gif" /></a>
      <a href="#" class="goto-tag"><img /></a>
      <a href="#" class="clear-tag"><img /></a>
    </div>
    <?php
  }
}

?>
