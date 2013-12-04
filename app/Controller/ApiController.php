<?php
class ApiController extends AppController
{
    public $uses = array('User', 'HobbyChild');
    #public $components = array('Security');
    public $components = array('Session');

    public function beforeFilter()
    {
        parent::beforeFilter();
        if (!$this->request->is('ajax')) {
            print json_encode(array('result_type' => FAIL,
                    'error' => array('exception' => ERROR_MSG_INVALID_ACCESS)
                )
            );
            return;
        }
    }
    public function get_children_hobbys()
    {
        $this->autoRender = false;
        $parent_id = null;
        if (!isset($this->params['data']['prarent_id'])) {
            $parent_id = "";
        } else {
            $parent_id = $this->params['data']['prarent_id'];
        }
        $this->HobbyChild->set($this->params['data']);
        if ($this->HobbyChild->validates()) {
            try {
                $children_hobbys = $this->HobbyChild->get_children_hobbys($parent_id);
                print json_encode(array('result_type' => SUCCESS,
                    'children_hobbys' => $children_hobbys,
                    )
                );
            } catch (Exception $e) {
                $this->log($e->getMessage(), $type = LOG_ERROR);
                print json_encode(array('result_type' => FAIL,
                        'error' => array('exception' => ERROR_MSG_FAIL_REGIST)
                    )
                );
            }
        } else {
            print json_encode(array('result_type' => FAIL,
                    'error' => $this->User->validationErrors
                )
            );
        }
    }

    public function regist_user()
    {
        $this->autoRender = false;
        $check = array('nickname');

        $user_facebook_data = $this->Session->read('mydata');
        $user_input_data = $this->params['data'];

        foreach ($check as $key => $val) {
            if (!isset($user_input_data[$val])) {
                $user_input_data[$val] = '';
            }
        }
        $regist_user_data = array('nickname' => $user_input_data['nickname'],
                                  'facebook_id' => $user_facebook_data['id']
        );
        $this->User->set($regist_user_data);
        if ($this->User->validates()) {
            try {
                $this->User->regist_user($user_regist_param);
                print json_encode(array('result_type' => SUCCESS));
            } catch (Exception $e) {
                # /app/tmp/logs/
                $this->log($e->getMessage(), $type = LOG_ERROR);
                print json_encode(array('result_type' => FAIL,
                        'error' => array('exception' => ERROR_MSG_FAIL_REGIST)
                    )
                );
            }
        } else {
            print json_encode(array('result_type' => FAIL,
                'error' => $this->User->validationErrors
                )
            );
        }
    }
}
