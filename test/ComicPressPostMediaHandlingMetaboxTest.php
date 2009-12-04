<?php

require_once('PHPUnit/Framework.php');
require_once('MockPress/mockpress.php');
require_once(dirname(__FILE__) . '/../classes/ComicPressPostMediaHandlingMetabox.inc');

class ComicPressPostMediaHandlingMetaboxTest extends PHPUnit_Framework_TestCase {
	function providerTestUpdate() {
		return array(
			array(array(), array())
		);
	}

	/**
	 * @dataProvider providerTestUpdate
	 */
	function testUpdate($input, $expected_post_metadata) {

	}
}
