<?php

require_once('PHPUnit/Framework.php');
require_once('MockPress/mockpress.php');
require_once(dirname(__FILE__) . '/../../widgets/SocialWidget.inc');

class SocialWidgetTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		$this->w = new SocialWidget();
	}

	function testUpdate() {
		$this->assertEquals(array(
			'title' => 'title',
			'urlstr' => 'urlstr',
			'image' => 'image',
		), $this->w->update(array(
			'title' => '<em>title</em>',
			'urlstr' => '<em>urlstr</em>',
			'image' => '<em>image</em>',
		), array()));
	}
}