<?php
App::uses('AppController', 'Controller');

class SampleController extends AppController
{
    public function index()
    {
        $this -> autoRender = false;
        echo "<html><head></head><body>";
        echo "<h1>サンプルページ</h1>";
        echo "<p>これがサンプルのページです。</p>";
        echo "</body></html>";
    }

}
