<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

App::import ( 'Vendor', 'facebook', array (
'file' => 'facebook' . DS . 'src' . DS . 'facebook.php'
) ); // facebook認証

class AppController extends Controller
{
    public $helpers = array(
            'Session',
            'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
            'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
            'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
    );
    public $layout = 'TwitterBootstrap.default';

    public function beforeFilter()
    {
        $this->auth();
    }

    private function auth() { // facebookの認証処理部分
        $this->autoRender = false;
        $this->facebook = $this->createFacebook ();
        $user = $this->facebook->getUser (); // ユーザ情報取得
        if ($user) { // 認証後
            $me = $this->facebook->api ( '/me', 'GET', array (
                    'locale' => 'ja_JP'
            ) ); // ユーザ情報を日本語で取得
            $this->Session->write ( 'mydata', $me ); // fbデータをセッションに保存
        } else { // 認証前
            $url = $this->facebook->getLoginUrl ( array (
                    'scope' => 'email,publish_stream,user_birthday',
                    'canvas' => 1,
                    'fbconnect' => 0
            ) );
        }
    }
    private function createFacebook() { // appID, secretを記述
        return new Facebook ( array (
                'appId' => '607540619281377',
                'secret' => '53842d2f5aa62fefebbc1356927a88bd'
        ) );
    }
}
