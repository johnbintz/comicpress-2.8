<?php

function comicpress_notice_debug() {
	global $current_user, $comiccat, $blogcat, $comic_folder, $wpdb, $category_tree;

	if( substr( $_SERVER[ 'PHP_SELF' ], -19 ) != '/wp-admin/index.php' )
		return;

	$comicpress_options = comicpress_load_options();
	
	$error = array();
	$post_cat_link = get_bloginfo('wpurl') . '/wp-admin/categories.php';
	
	// Check Categories
	if ($comiccat == $blogcat) {
		$error[] = array('header', __('Primary Comic and Blog categories are not configured properly.','comicpress'));
		$error[] = __('ComicPress requires 2 categories to be added to the ','comicpress') . '<a href="'.$post_cat_link.'">' . __('post categories.','comicpress') . '</a>' . 
			__(' It is necessary to have 2 more categories in addition to the uncategorized category, a Blog and Comic primary categories.  These two additional categories will be the root categories that seperate the difference between the comic and blog posts.  When you post a new comic you will be posting it into the comic category or heirarchal children of the comic category.   When posting a new blog post you need to set it into the blog category or child of the blog category.   Uncategorized will act as a blog post category (do not rename uncategorized).  You can configure the categories to set as the primary blog and comic category from within the comicpress-config.php file or use ComicPress Manager - ComicPress Config','comicpress');
	}
	
	if (empty($error)) {
		// Check Comics Folder
		if (!is_dir(ABSPATH . '/' . $comic_folder)) {
			$error[] = array('header', __('Comics Folder is not configured and is unable to be found.','comicpress'));
			$error[] = __('ComicPress stores the files it uses inside a specific directory and that directory is set within the comicpress-config.php or you can configure it from within ComicPress Manager.  When this error is present it means that the theme is unable to find the appropriate directory to read the comics from.','comicpress');
		}
	}
	
	if (empty($error)) {
		// Make sure the ComicPress theme is installed in themes/comicpress
		if (ABSPATH . 'wp-content/themes/comicpress' != get_template_directory()) {
			$error[] = array('header', __('ComicPress theme is not installed into the correct folder.','comicpress'));
			$error[] = __('As of version 2.9, the ComicPress main core theme is required to be installed into the wp-content/themes/comicpress directory.  It is currently not installed into that directory.','comicpress');
		}
	}
	
	if (empty($error)) {
		$founderror = FALSE;
		$blog_query = '&show_posts=-1&posts_per_page=-1';

		$comic_categories = array();
		$founderrorpost = array();
		foreach ($category_tree as $node) {
			$comic_categories[] = end(explode("/", $node));
		}
		query_posts($blog_query);
		if (have_posts()) {
			while (have_posts()) : the_post();
				$founderrorpost[] = wp_get_post_categories($post->ID);
				if (count(array_intersect($comic_categories, wp_get_post_categories($post->ID))) > 0) {
					$founderror = TRUE;
				}
			endwhile;
		}
//		if ($founderror) {
			$error[] = array('header', __('A post is in both a comic category and blog category.','comicpress'));
			$error[] = __('*duel category error message and fix*','comicpress');
//		}
	}
	
	if (!empty($error)) {
	?>
	<div class="error">
		<h2>ComicPress Debug</h2>
		ComicPress doesn't seem to be fully installed at this time, check out these messages.<br />
		<br />
		<?php
		var_dump($founderrorpost);
//		var_dump($comic_categories);
			foreach ($error as $info) {
				unset($text);
				if (is_array($info)) {
					list($type, $text) = $info;
				} else {
					if (is_string($info)) {
						$text = $info;
						$type = 'paragraph';
					}
				}
				if (!empty($text) && !empty($type)) {
					switch ($type) {
						case 'header': echo "<h3>${text}</h3>"; break;
						case 'raw': echo $text; break;
						default: echo "<p>${text}</p>"; break;
					}
				}	  	  
			}
		?>
		<br />
		<br />
	</div>
<?php 
	}
}

add_action( 'admin_notices', 'comicpress_notice_debug' );

?>