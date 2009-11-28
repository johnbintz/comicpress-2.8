<?php

require_once('MockPress/mockpress.php');
require_once('PHPUnit/Framework.php');
require_once(dirname(__FILE__) . '/../../widgets/GraphicalNavigationWidget.inc');

class GraphicalNavigationWidgetTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		_reset_wp();
		$this->w = new GraphicalNavigationWidget();
	}

  /**
   * @covers WidgetComicPressGraphicalStorylineNavigation::update
   */
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
			array('first', 1, 2, true),
			array('first', 1, 1, false),
			array('last', 1, 2, true),
			array('last', 1, 1, false),
			array('prev', 1, 2, true),
		);
	}

	/**
	 * @dataProvider providerTestIsNavLinkVisible
   * @covers WidgetComicPressGraphicalStorylineNavigation::_will_display_nav_link
	 */
	function testIsNavLinkVisible($which, $current_id, $target_id, $expected_result) {
		$current = (object)array('ID' => $current_id);
		$target  = (object)array('ID' => $target_id);

		$this->assertEquals($expected_result, $this->w->_will_display_nav_link($which, $current, $target));
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
   * @covers WidgetComicPressGraphicalStorylineNavigation::_group_navigation_buttons
   */
  function testGroupNavigationButtons($buttons, $expected_grouping) {
    _set_filter_expectation('comicpress_navigation_grouping_details', array(array(
      'left' => array('one', 'two', 'three'),
      'center' => true,
      'right' => array('four', 'five', 'six'),
    )));

    $this->assertEquals($expected_grouping, $this->w->_group_navigation_buttons($buttons, array()));
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
		$this->assertEquals($expected_post_nav, array_shift($this->w->_comicpress_set_up_post_nav_story_prev($post_nav, $instance)));
  }

  /*function testComicPressSetUpPostNavFilterMultiPageSupport($instance, $post_nav, $_page, $_numpages, $expected_post_nav) {
		global $post, $page, $numpages;

		$post = (object)array('ID' => 1);
  }*/

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
}

?>
