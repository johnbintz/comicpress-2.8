<?php

require_once('PHPUnit/Framework.php');
require_once('MockPress/mockpress.php');
require_once(dirname(__FILE__) . '/../../widgets/DisplayComicTitleWidget.inc');

class DisplayComicTitleWidgetTest extends PHPUnit_Framework_TestCase {
	function testRenderWidget() {
		global $post;

		$post = (object)array(
			'post_title' => 'title',
			'guid' => 'link'
		);

		$w = new DisplayComicTitleWidget();

		ob_start();
		$w->widget(array('before_widget' => '', 'after_widget' => ''), array());
		$result = ob_get_clean();

		$this->assertEquals('<a href="link">title</a>', $result);
	}
}
