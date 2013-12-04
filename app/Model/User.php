<?php
App::uses('AppModel', 'Model');
App::import('Model','UserCommunity');
/**
 * User Model
 *
 */
class User extends AppModel
{
/**
 * Use table
 *
 * @var mixed False or table name
 */
    public $useTable = 'user';

/**
 * Display field
 *
 * @var string
 */
    public $displayField = 'id';
    // 1対多
    public $hasMany = array( 'UserCommunity' );

    public function regist_user ($new_user_data)
    {
      $user_data = array('User' => $new_user_data);
      $user_fields = array('nickname', 'facebook_id');
      $this->begin();
      $user = $this->save($user_data, false, $user_fields);
      $user_community_date = array('UserCommunity' =>
          array('id' => $this->id,
                'community_id' => TUTORIAL_COMUNITY_ID
          )
      );
      $user_community_fields = array('id', 'community_id');
      $user_community = $this->UserCommunity->save($user_community_date, false, $user_community_fields);
      if ($user !== false && $user_community !== false) {
          #$this->commit();
      } else {
          $this->rollback();
          throw new Exception('error');
      }
    }

    public function is_regist ()
    {
        return $this->id ? 1 : 0;
    }

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'nickname' => array(
            array('rule' => 'notEmpty',
                  'message' => 'タイトル名を入力して下さい。'
            )
      )
  );
}
