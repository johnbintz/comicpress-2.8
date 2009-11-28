<?php

require_once('MockPress/mockpress.php');
require_once('PHPUnit/Framework.php');
require_once(dirname(__FILE__) . '/../../widgets/GraphicalNavigationWidget.inc');

class GraphicalNavigationWidgetTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		_reset_wp();
		$this->w = new GraphicalNavigationWidget();
	}

	function testUpdateWidget() {
		$result = $this->w->update(array(
			"next" => "<b>test</b>",
			"next_title" => "<b>test</b>",
			"archive_path" => "<b>test</b>",
		), array());

		foreach (array(
			"next" => "on",
			"next_title" => "test",
			"archive_path" => "test",
		) as $field => $expected_value) {
			$this->assertEquals($expected_value, $result[$field]);
		}
	}

	function providerTestIsNavLinkVisible() {
		return array(
			array('first', 1, 2, 1, 1, 'on', true),
			array('first', 1, 1, 1, 1, 'on', false),
			array('last', 1, 2, 1, 1, 'on', true),
			array('last', 1, 1, 1, 1, 'on', false),
			array('prev', 1, 2, 1, 1, 'on', true),
			array('first', 1, 1, 2, 2, 'on', true),
			array('first', 1, 1, 1, 2, 'on', false),
			array('first', 1, 1, 2, 2, 'off', false),
		);
	}

	/**
	 * @dataProvider providerTestIsNavLinkVisible
	 */
	function testIsNavLinkVisible($which, $current_id, $target_id, $_page, $_numpages, $multi_page_support, $expected_result) {
		global $page, $numpages;
		$page = $_page;
		$numpages = $_numpages;

		$current = (object)array('ID' => $current_id);
		$target  = (object)array('ID' => $target_id);

		$this->assertEquals($expected_result, $this->w->_will_display_nav_link($which, $current, $target, array('enable_multipage_support' => $multi_page_support)));
	}

  function providerTestGroupNavigationButtons() {
    return array(
      array(array(), array()),
      array(
        array('one' => 'will be left'),
        array(
          'left' => array('one' => 'will be left')
        )
      ),
      array(
        array('four' => 'will be right'),
        array(
          'right' => array('four' => 'will be right')
        )
      ),
      array(
        array('seven' => 'will be center'),
        array(
          'center' => array('seven' => 'will be center')
        )
      ),
    );
  }

  /**
   * @dataProvider providerTestGroupNavigationButtons
   */
  function testGroupNavigationButtons($buttons, $expected_grouping) {
    _set_filter_expectation('comicpress_navigation_grouping_details', array(array(
      'left' => array('one', 'two', 'three'),
      'center' => true,
      'right' => array('four', 'five', 'six'),
    )));

    $this->assertEquals($expected_grouping, $this->w->_group_navigation_buttons($buttons, array()));
  }

  /**
   * @expectedException PHPUnit_Framework_Error
   */
  function testGroupNavigationButtonsNoDefaultGroup() {
    _set_filter_expectation('comicpress_navigation_grouping_details', array(array()));
  	$this->w->_group_navigation_buttons(array(), array());
  }

  function testSetUpPostNavFilterReturnsData() {
    _set_filter_expectation('comicpress_set_up_post_nav', array(array('test')));

    $w = $this->getMock('GraphicalNavigationWidget', array('_new_comicpress_storyline', '_new_comicpress_navigation'));
    $w->expects($this->once())->method('_new_comicpress_storyline')->will($this->returnValue($this->getMock('Storyline', array('set_order_via_flattened_storyline'))));
    $w->expects($this->once())->method('_new_comicpress_navigation')->will($this->returnValue($this->getMock('Navigation', array('init', 'get_post_nav'))));

    $this->assertEquals('test', $w->set_up_post_nav(array()));
  }

  function testSetUpPostNavFilterReturnsFalse() {
    _set_filter_expectation('comicpress_set_up_post_nav', false);

    $w = $this->getMock('GraphicalNavigationWidget', array('_new_comicpress_storyline', '_new_comicpress_navigation'));
    $w->expects($this->once())->method('_new_comicpress_storyline')->will($this->returnValue($this->getMock('Storyline', array('set_order_via_flattened_storyline'))));

    $n = $this->getMock('Navigation', array('init', 'get_post_nav'));
    $n->expects($this->once())->method('get_post_nav')->will($this->returnValue('test'));

    $w->expects($this->once())->method('_new_comicpress_navigation')->will($this->returnValue($n));

    $this->assertEquals('test', $w->set_up_post_nav(array()));
  }

  function providerTestSetUpPostNavStoryPrev() {
  	return array(
  		array(
  		  array('story_prev_acts_as_prev_in' => 'off'),
  		  array('storyline-previous' => 'test', 'storyline-chapter-previous' => 'test'),
  		  array('storyline-previous' => 'test', 'storyline-chapter-previous' => 'test')
  		),
  		array(
  		  array('story_prev_acts_as_prev_in' => 'on'),
  		  array('storyline-previous' => 'test2', 'storyline-chapter-previous' => 'test'),
  		  array('storyline-previous' => 'test2', 'storyline-chapter-previous' => 'test2')
  		),
  		array(
  		  array('story_prev_acts_as_prev_in' => 'off'),
  		  array('storyline-previous' => false, 'storyline-chapter-previous' => 'test'),
  		  array('storyline-previous' => false, 'storyline-chapter-previous' => 'test')
  		),
  		array(
  		  array('story_prev_acts_as_prev_in' => 'on'),
  		  array('storyline-previous' => false, 'storyline-chapter-previous' => 'test'),
  		  array('storyline-previous' => false, 'storyline-chapter-previous' => 'test')
  		),
  	);
  }

  /**
   * @dataProvider providerTestSetUpPostNavStoryPrev
   */
  function testComicPressSetUpPostNavFilterStoryPrev($instance, $post_nav, $expected_post_nav) {
		$this->assertEquals($expected_post_nav, array_shift($this->w->_comicpress_set_up_post_nav_story_prev(array($post_nav, null, $instance))));
  }

  function providerTestComicPressSetUpPostNavFilterMultiPageSupport() {
  	return array(
  		array(
  			array('enable_multipage_support' => 'off'),
  			array('previous' => 'prev-post', 'next' => 'next-post'),
  			1, 4,
  			array('previous' => 'prev-post', 'next' => 'next-post')
  		),
  		array(
  			array('enable_multipage_support' => 'on'),
  			array('previous' => (object)array('post_content' => 'test', 'guid' => 'prev-post', 'post_status' => 'publish'), 'next' => 'next-post'),
  			1, 1,
  			array('previous' => (object)array('post_content' => 'test', 'guid' => 'prev-post', 'post_status' => 'publish'), 'next' => 'next-post')
  		),
  		array(
  			array('enable_multipage_support' => 'on'),
  			array('previous' => (object)array('post_content' => 'test<!--nextpage-->test2', 'guid' => 'prev-post', 'post_status' => 'publish'), 'next' => 'next-post'),
  			1, 1,
  			array('previous' => 'prev-post/2/', 'next' => 'next-post')
  		),
  		array(
  			array('enable_multipage_support' => 'on'),
  			array('previous' => (object)array('post_content' => 'test', 'guid' => 'prev-post', 'post_status' => 'publish'), 'next' => 'next-post'),
  			1, 2,
  			array(
  			  'previous' => (object)array('post_content' => 'test', 'guid' => 'prev-post', 'post_status' => 'publish'),
  			  'next' => 'current-post/2/',
  			  'storyline-next' => 'current-post/2/',
  			)
  		),
  		array(
  			array('enable_multipage_support' => 'on'),
  			array('previous' => 'prev-post', 'next' => 'next-post'),
  			2, 2,
  			array(
  			  'previous' => 'current-post/1/',
  			  'storyline-previous' => 'current-post/1/',
  				'next' => 'next-post'
  			)
  		),
  		array(
  			array('enable_multipage_support' => 'on'),
  			array(
  			  'previous' => 'prev-post',
  			  'next' => 'next-post',
  			  'storyline-previous' => 'prev-post',
  			  'storyline-next' => 'next-post',
  			),
  			2, 3,
  			array(
  			  'previous' => 'current-post/1/',
  			  'next' => 'current-post/3/',
  			  'storyline-previous' => 'current-post/1/',
  			  'storyline-next' => 'current-post/3/',
  			)
  		),
  	);
  }

  /**
   * @dataProvider providerTestComicPressSetUpPostNavFilterMultiPageSupport
   * @return unknown_type
   */
  function testComicPressSetUpPostNavFilterMultiPageSupport($instance, $post_nav, $_page, $_numpages, $expected_post_nav) {
		global $post, $page, $numpages;

		update_option('permalink_structure', '/test/');

		$post = (object)array('ID' => 1, 'guid' => 'current-post', 'post_status' => 'publish');
		$page = $_page;
		$numpages = $_numpages;

		$this->assertEquals($expected_post_nav, array_shift($this->w->_comicpress_set_up_post_nav_multi_page_support(array($post_nav, $post, $instance))));
  }

  function providerTestBuildInPostPageLink() {
  	return array(
  		array('', 'publish', 'post-guid&amp;page=2'),
  		array('test', 'publish', 'post-guid/2'),
  		array('test/', 'publish', 'post-guid/2/'),
  		array('test/', 'draft', 'post-guid&amp;page=2'),
  	);
  }

  /**
   * @dataProvider providerTestBuildInPostPageLink
   */
  function testBuildInPostPageLink($permalink_structure, $post_status, $expected_link) {
  	update_option('permalink_structure', $permalink_structure);
		$post = (object)array('guid' => 'post-guid', 'post_status' => $post_status);

		$this->assertEquals($expected_link, $this->w->_build_in_post_page_link($post, 2));
  }

  function testSetUpPostNav() {
  	global $post;

  	$post = 'post';

  	$css = $this->getMock('GraphicalNavigationWidget', array('_new_comicpress_storyline', '_new_comicpress_navigation'));

  	update_option('comicpress-storyline-category-order', 'test');

  	$storyline = $this->getMock('ComicPressStoryline', array('set_order_via_flattened_storyline'));
  	$storyline->expects($this->once())->method('set_order_via_flattened_storyline')->with('test');

  	$css->expects($this->once())->method('_new_comicpress_storyline')->will($this->returnValue($storyline));

  	$navigation = $this->getMock('ComicPressNavigation', array('init', 'get_post_nav'));
  	$navigation->expects($this->once())->method('init');
  	$navigation->expects($this->once())->method('get_post_nav')->with($post)->will($this->returnValue('true'));

  	$css->expects($this->once())->method('_new_comicpress_navigation')->will($this->returnValue($navigation));

  	$css->set_up_post_nav(array());
  }

  function providerTestGetLinkNaviClassNames() {
  	return array(
  		array(
  			'previous', (object)array('guid' => 'previous'), array(), array(
					'link' => 'previous',
  				'navi_class_names' => array('navi-previous', 'navi-prev')
  			)
  		),
  		array(
  			'last', (object)array('guid' => 'last'), array('lastgohome' => 'off'), array(
					'link' => 'last',
  				'navi_class_names' => array('navi-last')
  			)
  		),
  		array(
  			'last', (object)array('guid' => 'last'), array('lastgohome' => 'on'), array(
					'link' => 'home',
  				'navi_class_names' => array('navi-last')
  			)
  		),
  		array(
  			'next', 'next', array(), array(
					'link' => 'next',
  				'navi_class_names' => array('navi-next')
  			)
  		),
  	);
  }

  /**
   * @dataProvider providerTestGetLinkNaviClassNames
   */
  function testGetLinkNaviClassNames($which, $target, $instance, $expected_results) {
  	_set_bloginfo('url', 'home');
		$this->assertEquals($expected_results, $this->w->_get_link_navi_class_names($which, null, $target, $instance));
  }
}

?>
