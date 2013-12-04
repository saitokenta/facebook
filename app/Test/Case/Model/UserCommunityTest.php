<?php
App::uses('UserCommunity', 'Model');

/**
 * UserCommunity Test Case
 *
 */
class UserCommunityTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_community'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserCommunity = ClassRegistry::init('UserCommunity');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserCommunity);

		parent::tearDown();
	}

}
