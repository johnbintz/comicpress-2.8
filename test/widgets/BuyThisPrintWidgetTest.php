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
		global $post, $buy_print_url;

		$buy_print_url = 'buy print url';
		$post = (object)array('ID' => 10);

		$result = $this->w->buy_print_structure();

		$this->assertTag(array(
			'tag' => 'form',
			'attributes' => array('action' => $buy_print_url)
		), $result);

		$this->assertTag(array(
			'tag' => 'input',
			'attributes' => array(
				'name' => 'comic',
				'value' => 10
			)
		), $result);
	}

	function providerTestWidget() {
		return array(
			array(
				array(), array(), array(), array('beforeafter'),
			),
			array(
				array('title' => 'title'), array(), array(), array('before:bt:title:at:after'),
			),
			array(
				array('title' => 'title'), array(), array('widget_title' => 'newtitle'), array('before:bt:newtitle:at:after'),
			),
			array(
				array(), array(), array('comicpress_buy_print_structure' => 'buy'), array('beforebuyafter'),
			),
			array(
				array(), array('buythiscomic' => 'yes'), array('comicpress_buy_print_structure' => 'buy'), array('beforebuyafter'),
			),
			array(
				array(), array('buythiscomic' => 'sold'), array('comicpress_buy_print_structure' => 'buy'), array('beforeafter'),
			),
		);
	}

	/**
	 * @dataProvider providerTestWidget
	 */
	function testWidget($instance, $post_meta, $filter_expectations, $expected_matches) {
		global $post;

		$post = (object)array('ID' => 1);
		foreach ($post_meta as $meta => $value) {
			update_post_meta(1, $meta, $value);
		}

		foreach ($filter_expectations as $name => $result) {
			_set_filter_expectation($name, $result);
		}

		ob_start();
		$this->w->widget(array('before_widget' => 'before', 'after_widget' => 'after', 'before_title' => ':bt:', 'after_title' => ':at:'), $instance);
		$content = ob_get_clean();

		foreach ($expected_matches as $match) {
			$this->assertTrue(preg_match("#${match}#mis", $content) > 0);
		}
	}

	function testForm() {
		ob_start();
		$this->w->form(array('title' => 'title'));
		$content = ob_get_clean();

		$this->assertTag(array(
			'tag' => 'input',
			'attributes' => array(
				'type' => 'text',
				'value' => 'title'
			)
		), $content);
	}
}
