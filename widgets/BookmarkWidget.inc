<?php

class ComicPressAddonBookmarkWidget {
  function init($comicpress) {
    wp_register_sidebar_widget('comic-bookmark', __('Comic Bookmark', 'comicpress'), array(&$this, 'render_widget'), array('description' => __('Let your readers save their place via a cookie.', 'comicpress')));

    $this->comicpress = $comicpress;

    add_action('wp_head', array(&$this, 'wp_head'));
    
    wp_enqueue_script('prototype');
    wp_enqueue_script('cookiejar', get_template_directory_uri() . '/js/cookiejar.js', array('prototype'));
    wp_enqueue_script('bookmark', get_template_directory_uri() . '/js/bookmark.js', array('prototype', 'cookiejar'));
  }

  function wp_head() { ?>
    <script type="text/javascript">
      var image_root = '<?php bloginfo('template_directory'); ?>/images/';
      var permalink = '<?php the_permalink() ?>';        
    </script>
  <?php }

  function render_widget() {
    ?>
    <div id="comic-bookmark-holder">
      <a href="#" class="tag-page"><img src="<?php bloginfo('template_directory'); ?>/images/1.gif" /></a>
      <a href="#" class="goto-tag"><img /></a>
      <a href="#" class="clear-tag"><img /></a>
    </div>
    <?php
  }
}

?>
