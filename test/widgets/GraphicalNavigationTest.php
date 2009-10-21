<?php

require_once('MockPress/mockpress.php');
require_once('PHPUnit/Framework.php');
require_once(dirname(__FILE__) . '/../../widgets/graphical-navigation.php');

class GraphicalNavigationTest extends PHPUnit_Framework_TestCase {
	function testUpdateWidget() {
		$w = new widget_comicpress_graphical_navigation();

		$this->assertEquals(array(
			"next" => "<b>test</b>",
			"next_title" => "test",
			"archive_path" => "test",
		), $w->update(array(
			"next" => "<b>test</b>",
			"next_title" => "<b>test</b>",
			"archive_path" => "<b>test</b>",
		), array()));
	}
}

?>