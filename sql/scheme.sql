CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `facebook_id` bigint(19) unsigned NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `create_at` datetime default NULL,
  `update_at` datetime default NULL,
  INDEX INDEX_1 (facebook_id),
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `user_communitys` (
  `id` int(10) unsigned NOT NULL,
  `community_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

REATE TABLE IF NOT EXISTS `hobby_child` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `prarent_id` int(10) unsigned default NULL,
  `create_at` datetime default NULL,
  `update_at` datetime default NULL,
  INDEX  INDEX_1 (name),
  INDEX  INDEX_2 (prarent_id),
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
