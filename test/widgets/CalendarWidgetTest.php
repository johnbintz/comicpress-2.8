<?php

require_once('PHPUnit/Framework.php');
require_once('MockPress/mockpress.php');
require_once(dirname(__FILE__) . '/../../widgets/CalendarWidget.inc');

class CalendarWidgetTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		_reset_wp();
		$this->w = new CalendarWidget('id', 'name', array());
	}

	function providerTestUpdate() {
		return array(
			array(
				array(), array()
			),
			array(
				array('test' => 'test'), array()
			),
			array(
				array('thumbnail' => 'title'), array('thumbnail' => 'title')
			),
			array(
				array('thumbnail' => "<i>title</i>"), array('thumbnail' => 'title')
			),
			array(
				array(
					'thumbnail' => "test",
					'small' => "test",
					'medium' => "test",
					'large' => "test",
					'link' => "test",
				), array(
					'thumbnail' => "test",
					'small' => "test",
					'medium' => "test",
					'large' => "test",
					'link' => "test",
				)
			),
		);
	}

	/**
	 * @dataProvider providerTestUpdate
	 */
	function testUpdate($input, $expected_output) {
		$this->assertEquals($expected_output, $this->w->update($input));
	}
}
