<?php

require_once('PHPUnit/Framework.php');
require_once('MockPress/mockpress.php');
require_once(dirname(__FILE__) . '/../../widgets/BuyThisPrintWidget.inc');

class BuyThisPrintWidgetTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		_reset_wp();
		$this->w = new BuyThisPrintWidget('id', 'name', array());
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
				array('title' => 'title'), array('title' => 'title')
			),
			array(
				array('title' => "<i>title</i>"), array('title' => 'title')
			)
		);
	}

	/**
	 * @dataProvider providerTestUpdate
	 */
	function testUpdate($input, $expected_output) {
		$this->assertEquals($expected_output, $this->w->update($input));
	}

	function testBuyThisPrintStructure() {
		global $post;

		$w = $this->getMock('BuyThisPrintWidget', array('_load_options'));
		$w->expects($this->once())->method('_load_options')->will($this->returnValue(array('buy_print_url' => 'buy_print_url_value')));

		$post = (object)array('ID' => 10);

		$result = $w->buy_print_structure();

		$this->assertTag(array(
			'tag' => 'form',
			'attributes' => array('action' => 'buy_print_url_value')
		), $result);

		$this->assertTag(array(
			'tag' => 'input',
			'attributes' => array(
				'name' => 'comic',
				'value' => 10
			)
		), $result);
	}
}
