<?php

function comicpress_notice_debug() {
	global $current_user, $comiccat, $blogcat, $comic_folder, $wpdb, $category_tree, $non_comic_categories, $comicpress_options;

	if( substr( $_SERVER[ 'PHP_SELF' ], -19 ) != '/wp-admin/index.php' || !$comicpress_options['enable_comicpress_debug'])
		return;

	$comicpress_options = comicpress_load_options();
	
	$error = array();
	$post_cat_link = get_bloginfo('wpurl') . '/wp-admin/categories.php';
	
	// Check Categories
	if ($comiccat == $blogcat) {
		$error[] = array('header', __('Primary Comic and Blog categories are not configured properly.','comicpress'));
		$error[] = __('ComicPress requires 2 categories to be added to the ','comicpress') . '<a href="'.$post_cat_link.'">' . __('post categories.','comicpress') . '</a>' . 
			__(' It is necessary to have 2 more categories in addition to the uncategorized category, a Blog and Comic primary categories.  These two additional categories will be the root categories that seperate the difference between the comic and blog posts.  When you post a new comic you will be posting it into the comic category or heirarchal children of the comic category.   When posting a new blog post you need to set it into the blog category or child of the blog category.   Uncategorized will act as a blog post category (do not rename uncategorized).  You can configure the categories to set as the primary blog and comic category from within the ComicPress Manager plugin.','comicpress');
	}
	
	if (empty($error)) {
		// Check Comics Folder
		if (!is_dir(ABSPATH . '/' . $comic_folder)) {
			$error[] = array('header', __('Comics Folder is not configured and is unable to be found.','comicpress'));
			$error[] = __('ComicPress stores the files it uses inside a specific directory and that directory is set from within ComicPress Manager.  When this error is present it means that the theme is unable to find the appropriate directory to read the comics from.','comicpress');
		}
	}
	
	if (empty($error)) {
		// Make sure the ComicPress theme is installed in themes/comicpress
		if (ABSPATH . 'wp-content/themes/comicpress' != get_template_directory()) {
			$error[] = array('header', __('ComicPress theme is not installed into the correct folder.','comicpress'));
			$error[] = __('As of version 2.9, the ComicPress main core theme is required to be installed into the wp-content/themes/comicpress directory.  It is currently not installed into that directory.','comicpress');
		}
	}
	
	if (empty($error) && $comicpress_options['enable_full_post_check']) {
		// Check to make sure posts are not in blogcat and comiccat both
		$founderror = false;
		$non_comic_categories = str_replace(' and ', ',', $non_comic_categories);
		$blog_query = '&show_posts=-1&posts_per_page=-1&cat='.$non_comic_categories;

		query_posts($blog_query);
		if (have_posts()) {
			while (have_posts()) : the_post();
				if (in_comic_category()) {
					$founderrorpostlist .= '<a href="'.get_bloginfo('wpurl').'/wp-admin/post.php?action=edit&post='.get_the_ID().'">'.get_the_title().'</a> - Error: Category Crossover<br />';
					$founderror = true;
				}
			endwhile;
		}
		if ($founderror) {
			$error[] = array('header', __('Post\'s are in both a comic category and blog category.','comicpress'));
			$error[] = __('The following posts are set both in a comic category and a blog category, with ComicPress the designations of categories is very important.  The rule of thumb is to make sure that all posts are only in a single category.   If a post is in both the comic category and blog category there will be issues with both navigation and execution of the ComicPress code.','comicpress');
			$error[] = $founderrorpostlist;
		}
	}
	
	if (empty($error) && $comicpress_options['enable_full_post_check']) {
		$founderror = false;
		$blog_query = '&show_posts=-1&posts_per_page=-1';
		$posts = query_posts($blog_query);
		foreach ($posts as $testpost) {
			$post_title_slug = $testpost->post_name;
			if (is_numeric($post_title_slug)) {
				$founderror = true;
				$founderrorpostname .= '<a href="'.get_bloginfo('wpurl').'/wp-admin/post.php?action=edit&post='.$testpost->ID.'">'.get_the_title($testpost->ID).'</a> - Error: Post Slug (Permalink) is Numeric<br />';
			}
		}
		if ($founderror) {
			$error[] = array('header', __('Post\'s slug is a numeric.','comicpress'));
			$error[] = __('The following posts have a post slug (permalink) that is numeric.  This will cause problems with permalinks.   Post slugs must have at least one alphabetic character in them for Wordpress to handle correctly.','comicpress');
			$error[] = $founderrorpostname;
		}
	}	
	
	if (!empty($error)) {
	?>
	<div class="error">
		<h2>ComicPress Debug</h2>
		ComicPress doesn't seem to be fully installed at this time, check out these messages.<br />
		<br />
		<?php
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