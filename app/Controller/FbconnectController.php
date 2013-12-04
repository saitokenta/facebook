<?php
App::import ( 'Vendor', 'facebook', array (
        'file' => 'facebook' . DS . 'src' . DS . 'facebook.php'
) ); // facebook認証

class FbconnectController extends AppController
{
    public $uses = array('User');
    public $name = 'Fbconnect';
    public function index()
    {
    }
    public function showdata() { // トップページ
        #$facebook = $this->createFacebook (); // セッション切れ対策 (?)
        #$myFbData = $this->Session->read ( 'mydata' ); // facebookのデータ
        #pr ( $myFbData ); // 表示
        #$this->fbpost ( "hello world" ); // facebookに投稿
    }

    public function auth() { // facebookの認証処理部分
        $this->autoRender = false;
        $this->facebook = $this->createFacebook ();

        $user = $this->facebook->getUser ();
        if ($user) {
            $me = $this->facebook->api
                ( '/me', 'GET', array (
                    'locale' => 'ja_JP'
                 ) );
            $this->Session->write ( 'mydata', $me );
            $myFbData = $this->Session->read ( 'mydata' );
            if ($this->User->is_regist()) {
                $this->redirect(
                        array('controller' => 'mypage',
                                'action' => 'index')
                );
            } else {
                $this->redirect(
                    array('controller' => 'common',
                          'action' => 'signup')
                );
            }

        } else {
            $url = $this->facebook->getLoginUrl ( array (
                    'scope' => 'email,publish_stream,user_birthday',
                    'canvas' => 1,
                    'fbconnect' => 0
            ) );
            $this->redirect ( $url );
        }
    }
    private function createFacebook() { // appID, secretを記述
        return new Facebook ( array (
                'appId' => '607540619281377',
                'secret' => '53842d2f5aa62fefebbc1356927a88bd'
        ) );
    }
    public function fbpost($postData) { // facebookのwallにpostする処理
        /*
        $facebook = $this->createFacebook ();
        $attachment = array (
                'access_token' => $facebook->getAccessToken (), // access_token入手
                'message' => $postData,
                'name' => "test",
                'link' => "",
                'description' => "test"
        );
        $facebook->api ( '/me/feed', 'POST', $attachment );
        */
    }
}
