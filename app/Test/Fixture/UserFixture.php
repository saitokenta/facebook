<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'user';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'facebook_id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'length' => 19, 'key' => 'unique'),
		'nickname' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'create_at' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'update_at' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'UNIQUE_INDEX_1' => array('column' => 'facebook_id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'facebook_id' => '',
			'nickname' => 'Lorem ipsum dolor sit amet',
			'create_at' => '2013-12-01 17:58:36',
			'update_at' => '2013-12-01 17:58:36'
		),
	);

}
