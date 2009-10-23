<?php

require_once('MockPress/mockpress.php');
require_once('PHPUnit/Framework.php');
require_once(dirname(__FILE__) . '/../../widgets/graphical-navigation.php');

class GraphicalNavigationTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		_reset_wp();
		$this->w = new WidgetComicPressGraphicalStorylineNavigation();
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
			array('first', 1, 2, true),
			array('first', 1, 1, false),
			array('last', 1, 2, true),
			array('last', 1, 1, false),
			array('prev', 1, 2, true),
		);
	}

	/**
	 * @dataProvider providerTestIsNavLinkVisible
	 */
	function testIsNavLinkVIsible($which, $current_id, $target_id, $expected_result) {
		$current = (object)array('ID' => $current_id);
		$target  = (object)array('ID' => $target_id);

		$this->assertEquals($expected_result, $this->w->_will_display_nav_link($which, $current, $target));
	}
}

?>