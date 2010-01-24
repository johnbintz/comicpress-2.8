<?php

require_once('PHPUnit/Framework.php');
require_once('MockPress/mockpress.php');
require_once(dirname(__FILE__) . '/../classes/ComicPressRelatedPosts.inc');

class ComicPressRelatedPostsTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		_reset_wp();
		$this->rp = new ComicPressRelatedPosts();
	}

	function testBuildPostTable() {
		$this->markTestIncomplete();
		$posts = array(
			(object)array('ID' => 1, 'post_date' => '2009-01-01', 'post_title' => 'Post 1', 'guid' => 'post-1'),
			(object)array('ID' => 2, 'post_date' => '2009-01-02', 'post_title' => 'Post 2', 'guid' => 'post-2'),
			(object)array('ID' => 3, 'post_date' => '2009-01-03', 'post_title' => 'Post 3', 'guid' => 'post-3'),
		);

		foreach ($posts as $post) {
			wp_insert_post($post);
		}

		$categories = array(
			1 => array(1),
			2 => array(1),
			3 => array(2),
		);

		foreach ($categories as $id => $cats) {
			wp_set_post_categories($id, $cats);
		}

		$output = '<div class="related_posts"><span>Title</span><table class="month-table"><tr><td class="archive-date" align="right">Jan 3, 2009</td><td class="archive-title"><a title="Post 3" href="post-3">Post 3</a></td></tr></table></div>';

		$this->rp->related_categories = array(2);

		$this->assertEquals($output, $this->rp->build_post_table('Title', $posts));
	}
}
