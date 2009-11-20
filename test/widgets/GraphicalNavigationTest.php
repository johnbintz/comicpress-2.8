<?php

require_once('MockPress/mockpress.php');
require_once('PHPUnit/Framework.php');
require_once(dirname(__FILE__) . '/../../widgets/graphical-navigation.php');

class GraphicalNavigationTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		_reset_wp();
		$this->w = new WidgetComicPressGraphicalStorylineNavigation();
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
}

?>