<?php
App::uses('AllTestsBase', 'Test/Lib');

class AllInfinitasFaqTestsTest extends AllTestsBase {

/**
 * Suite define the tests for this suite
 *
 * @return void
 */
	public static function suite() {
		$suite = new CakeTestSuite('All InfinitasFaq test');

		$path = CakePlugin::path('InfinitasFaq') . 'Test' . DS . 'Case' . DS;
		$suite->addTestDirectoryRecursive($path);

		return $suite;
	}
}
