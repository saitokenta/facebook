<?php
/**
 * HobbyChildFixture
 *
 */
class HobbyChildFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'hobby_child';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'prarent_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index'),
		'create_at' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'update_at' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'INDEX_1' => array('column' => 'name', 'unique' => 0),
			'INDEX_2' => array('column' => 'prarent_id', 'unique' => 0)
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
			'name' => 'Lorem ipsum dolor sit amet',
			'prarent_id' => 1,
			'create_at' => '2013-12-03 21:23:40',
			'update_at' => '2013-12-03 21:23:40'
		),
	);

}
