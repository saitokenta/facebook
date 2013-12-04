<?php
App::uses('AppModel', 'Model');
/**
 * HobbyChild Model
 *
 */
class HobbyChild extends AppModel
{
/**
 * Use table
 *
 * @var mixed False or table name
 */
    public $useTable = 'hobby_child';

/**
 * Display field
 *
 * @var string
 */
    public $displayField = 'name';

    public function get_children_hobbys ($prarent_id)
    {
        $children_hobbys = $this->find('list', array(
            'conditions' => array('HobbyChild.prarent_id' => $prarent_id),
            'fields' => array('HobbyChild.name')
        ));
        return $children_hobbys;
    }
}
