<?php

require_once('PHPUnit/Framework.php');
require_once('MockPress/mockpress.php');
require_once(dirname(__FILE__) . '/../classes/ComicPressPostMediaHandlingMetabox.inc');

class ComicPressPostMediaHandlingMetaboxTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		_reset_wp();
		$_REQUEST = array();
		$this->pmh = new ComicPressPostMediaHandlingMetabox();
	}

	function providerTestSavePost() {
		return array(
			array(array(), array()),
			array(array('urls' => false), array()),
			array(array('urls' => array()), array()),
			array(array('urls' => array('test' => 'test')), array()),
			array(array('urls' => array('comic' => 'test')), array('comic' => 'test')),
		);
	}

	/**
	 * @dataProvider providerTestSavePost
	 */
	function testSavePost($input, $expected_post_metadata) {
		$pmh = $this->getMock('ComicPressPostMediaHandlingMetabox', array('_get_valid_types', '_verify_nonce'));
		$pmh->expects($this->once())->method('_verify_nonce')->will($this->returnValue(true));
		$pmh->expects($this->any())->method('_get_valid_types')->will($this->returnValue(array('comic')));

		$_REQUEST = array('cp' => $input);

		$pmh->save_post(1);
		$this->assertEquals($expected_post_metadata, get_post_meta(1, 'backend_url_images', true));
	}
}
