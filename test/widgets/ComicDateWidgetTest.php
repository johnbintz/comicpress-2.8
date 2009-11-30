<?php

require_once('PHPUnit/Framework.php');
require_once('MockPress/mockpress.php');
require_once(dirname(__FILE__) . '/../../widgets/ComicDateWidget.inc');

class ComicDateWidgetTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		_reset_wp();
		$this->w = new ComicDateWidget();
	}

	function providerTestFilterInstance() {
		return array(
			array(array(), array('format' => 'F jS, Y')),
			array(array('title' => 'test'), array('title' => 'test', 'format' => 'F jS, Y')),
			array(array('title' => '<em>test</em>'), array('title' => 'test', 'format' => 'F jS, Y')),
			array(array('title' => '<em>test</em>', 'format' => 'test'), array('title' => 'test', 'format' => 'test')),
			array(array('title' => '<em>test</em>', 'format' => ''), array('title' => 'test', 'format' => 'F jS, Y')),
		);
	}

	/**
	 * @dataProvider providerTestFilterInstance
	 */
	function testFilterInstance($new_instance, $expected_result) {
		$this->assertEquals($expected_result, $this->w->_filter_instance($new_instance, array()));
	}

	function testUpdate() {
		$w = $this->getMock('ComicDateWidget', array('_filter_instance'));
		$w->expects($this->once())->method('_filter_instance');

		$w->update(array(), array());
	}
}
