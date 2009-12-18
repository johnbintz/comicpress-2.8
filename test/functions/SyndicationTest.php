<?php

require_once('PHPUnit/Framework.php');
require_once('MockPress/mockpress.php');
require_once(dirname(__FILE__) . '/../../functions/syndication.php');

class SyndicationTest extends PHPUnit_Framework_TestCase {
	function providerTestTheTitleRSS() {
		return array(

		);
	}

	/**
	 * TODO Add get_comments_number to MockPress
	 * @dataProvider providerTestTheTitleRSS
	 */
	function testTheTitleRSS($number_of_comments, $expected_title) {
		$this->markTestIncomplete();
	}
}
