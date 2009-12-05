<?php

require_once('PHPUnit/Framework.php');
require_once('MockPress/mockpress.php');
require_once(dirname(__FILE__) . '/../classes/ComicPressPostMediaHandlingMetabox.inc');

class ComicPressPostMediaHandlingMetaboxTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		_reset_wp();
		$this->pmh = new ComicPressPostMediaHandlingMetabox();
	}

	function providerTestPostMediaUpdate() {
		return array(
			array(array(), ''),
			array(array('post_id' => 'test'), ''),
			array(array('post_id' => 1), array()),
			array(array('post_id' => 1, 'urls' => false), array()),
			array(array('post_id' => 1, 'urls' => array()), array()),
			array(array('post_id' => 1, 'urls' => array('test' => 'test')), array()),
			array(array('post_id' => 1, 'urls' => array('comic' => 'test')), array('comic' => 'test')),
		);
	}

	/**
	 * @dataProvider providerTestPostMediaUpdate
	 */
	function testPostMediaUpdate($input, $expected_post_metadata) {
		$pmh = $this->getMock('ComicPressPostMediaHandlingMetabox', array('_get_valid_types'));
		$pmh->expects($this->any())->method('_get_valid_types')->will($this->returnValue(array('comic')));

		$this->pmh->handle_post_media_update($input);
		$this->assertEquals($expected_post_metadata, get_post_meta(1, 'backend_url_images', true));
	}
}
