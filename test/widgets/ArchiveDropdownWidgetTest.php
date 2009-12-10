<?php

require_once('PHPUnit/Framework.php');
require_once('MockPress/mockpress.php');
require_once(dirname(__FILE__) . '/../../widgets/ArchiveDropdownWidget.inc');

class ArchiveDropdownWidgetTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		_reset_wp();

		$this->w = new ArchiveDropdownWidget();
	}

	function providerTestBuildDropdown() {
		return array(
			array(null, 'Archives...', null, 'Go'),
			array('Test', 'Test', 'Test2', 'Test2'),
		);
	}

	/**
	 * @dataProvider providerTestBuildDropdown
	 */
  function testBuildDropdown($default_value, $expected_default, $button_value, $expected_button) {
  	if (!is_null($default_value)) {
  		_set_filter_expectation('comicpress_archive_dropdown_default_entry', $default_value);
  	}

   	if (!is_null($button_value)) {
  		_set_filter_expectation('comicpress_archive_dropdown_submit_button', $button_value);
  	}

  	foreach (array(
  		array('test' => 'Test',	'test2' => 'Test2'),
  		'<option value="test">Test</option><option value="test2">Test2</option>'
  	) as $entries) {
	  	$html = $this->w->build_dropdown($entries);

	  	foreach (array(
	  		array('tag' => 'div', 'attributes' => array('class' => 'archive-dropdown-wrap')),
	  		array('tag' => 'form', 'attributes' => array('action' => '', 'method' => 'get')),
	  		array('tag' => 'select', 'attributes' => array('name' => 'cp[urls]')),
	  		array('tag' => 'input', 'attributes' => array('name' => 'cp[_nonce]')),
	  		array('tag' => 'input', 'attributes' => array('name' => 'cp[_action_nonce]')),
	  		array('tag' => 'input', 'attributes' => array('name' => 'cp[action]', 'value' => 'follow-archive-dropdown')),
	  		array('tag' => 'option', 'attributes' => array('value' => ''), 'content' => $expected_default),
	  		array('tag' => 'input', 'attributes' => array('type' => 'submit', 'value' => $expected_button)),
	  		array('tag' => 'option', 'attributes' => array('value' => 'test'), 'content' => 'Test'),
	  		array('tag' => 'option', 'attributes' => array('value' => 'test2'), 'content' => 'Test2'),
	  	) as $matcher) {
	  		$this->assertTag($matcher, $html);
	  	}
  	}
  }

  function testBuildDropdownNotStringOrArray() {
  	$html = $this->w->build_dropdown(false);

  	$this->assertTrue(empty($html));
  }
}