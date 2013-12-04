<?php
App::uses('HobbyChild', 'Model');

/**
 * HobbyChild Test Case
 *
 */
class HobbyChildTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.hobby_child'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HobbyChild = ClassRegistry::init('HobbyChild');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HobbyChild);

		parent::tearDown();
	}

}
