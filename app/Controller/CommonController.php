<?php
class CommonController extends AppController
{
    public $components = array('Security');

    public function signup()
    {
      $hobbys = array(1 => "スポーツ",
          2 => "芸術",
      );
      array_unshift($hobbys, "---");
      $purposes = array(1 => "メル友",
              2 => "一緒に趣味を楽しめる友達",
              3 => "一緒に趣味を楽しめる恋人",
      );
      $this->set('hobbys', $hobbys);
      $this->set('purposes', $purposes);
      $this->render();
    }
}
