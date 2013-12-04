<?php
/**
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
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<div class="container">
  <div class="row">
    <div class="span2" style="background:lightgreen; height:300px;">span2</div>
    <div class="span8" style="background:lightblue; height:300px;">span6</div>
    <div class="span2" style="background:lightblue; height:300px;">span6</div>
  </div>
</div>


CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `facebook_id` bigint(19) unsigned NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `create_at` datetime default NULL,
  `update_at` datetime default NULL,
  UNIQUE UNIQUE_INDEX_1 (facebook_id),
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;