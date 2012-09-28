<?php
App::uses('InfinitasFaqContent', 'InfinitasFaq.Model');

/**
 * InfinitasFaqContent Test Case
 *
 */
class InfinitasFaqContentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.infinitas_faq.infinitas_faq_content',
		'plugin.infinitas_faq.global_content',
		'plugin.infinitas_faq.global_layout',
		'plugin.infinitas_faq.theme',
		'plugin.infinitas_faq.global_category',
		'plugin.infinitas_faq.group',
		'plugin.infinitas_faq.view_counter_view',
		'plugin.infinitas_faq.user',
		'plugin.infinitas_faq.global_tagged',
		'plugin.infinitas_faq.global_tag',
		'plugin.infinitas_faq.infinitas_comment',
		'plugin.infinitas_faq.infinitas_comment_attribute',
		'plugin.infinitas_faq.infinitas_comment_attributes'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->InfinitasFaqContent = ClassRegistry::init('InfinitasFaq.InfinitasFaqContent');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InfinitasFaqContent);

		parent::tearDown();
	}

}
