<?php

require_once('PHPUnit/Framework.php');
require_once('MockPress/mockpress.php');
require_once('vfsStream/vfsStream.php');
require_once(dirname(__FILE__) . '/../classes/ComicPressMediaHandling.inc');

class ComicPressMediaHandlingTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		_reset_wp();
		$this->cpmh = new ComicPressMediaHandling();
		$this->default_filter = $this->cpmh->default_filter;

		vfsStreamWrapper::register();
		vfsStreamWrapper::setRoot(new vfsStreamDirectory('root'));
	}

	function testBundleGlobalVariables() {
		global $comic_folder, $archive_comic_folder, $rss_comic_folder, $mini_comic_folder;

		$comic_folder = 'comic';
		$archive_comic_folder = 'archive';
		$rss_comic_folder = 'rss';
		$mini_comic_folder = 'mini';

		$this->assertEquals(array(
			'comic'   => 'comic',
			'archive' => 'archive',
			'rss'     => 'rss',
			'mini'    => 'mini'
		), $this->cpmh->_bundle_global_variables());
	}

	function providerTestGetFilter() {
		$cpmh = new ComicPressMediaHandling();

		return array(
			array(null, $cpmh->default_filter),
			array('fail', $cpmh->default_filter),
			array(array(), $cpmh->default_filter),
			array('test', 'test')
		);
	}

	/**
	 * @dataProvider providerTestGetFilter
	 */
	function testGetFilter($filter_to_use, $expected_result) {
		global $comic_filename_filters;

		$comic_filename_filters['test'] = 'test';

		$cpmh = $this->getMock('ComicPressMediaHandling', array('_convert_to_percent_filter'));
		if ($expected_result !== $cpmh->default_filter) {
			$cpmh->expects($this->once())->method('_convert_to_percent_filter')->with($expected_result)->will($this->returnValue($expected_result));
		} else {
			$cpmh->expects($this->never())->method('_convert_to_percent_filter');
		}

		$this->assertEquals($expected_result, $cpmh->_get_filter($filter_to_use));
	}

	function providerTestConvertToPercentFilter() {
		return array(
			array('', '%wordpress%/%type-folder%/'),
			array('{date}', '%wordpress%/%type-folder%/%date-Y-m-d%'),
			array('%wordpress%/%type-folder%/{date}', '%wordpress%/%type-folder%/{date}'),
		);
	}

	/**
	 * @dataProvider providerTestConvertToPercentFilter
	 */
	function testConvertToPercentFilter($old_filter, $new_filter) {
		$this->assertEquals($new_filter, $this->cpmh->_convert_to_percent_filter($old_filter));
	}

	function providerTestExpandFilter() {
		return array(
			array('', ''),
			array('%test%', '%test%'),
			array('%wordpress%', vfsStream::url('root')),
			array('%wordpress%%wordpress%', vfsStream::url('root') . vfsStream::url('root')),
			array('%test test%', '%test test%'),
			array('%wordpress%/%type-folder%', vfsStream::url('root') . '/comic'),
			array('%date-Y%', '2009'),
			array('%wordpress%/%type-folder%/%date-Y-m-d%*.*', vfsStream::url('root') . '/comic/2009-01-01.*\..*'),
		);
	}

	/**
	 * @dataProvider providerTestExpandFilter
	 */
	function testExpandFilter($filter, $expected_result) {
		$cpmh = $this->getMock('ComicPressMediaHandling', array('_abspath'));
		$cpmh->expects($this->any())->method('_abspath')->will($this->returnValue(vfsStream::url('root')));

		$this->assertEquals($expected_result, $cpmh->_expand_filter($filter, 'comic', (object)array('ID' => 1, 'post_date' => '2009-01-01 15:00:00')));
	}
}
