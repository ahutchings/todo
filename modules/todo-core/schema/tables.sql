CREATE TABLE tags (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  created_at int(10) unsigned NOT NULL,
  updated_at int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE tags_tasks (
  tag_id int(10) unsigned NOT NULL,
  task_id int(10) unsigned NOT NULL,
  PRIMARY KEY (tag_id,task_id),
  KEY tag_id (tag_id),
  KEY task_id (task_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE tasks (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  created_at int(10) unsigned NOT NULL,
  updated_at int(10) unsigned DEFAULT NULL,
  completed_at int(10) unsigned DEFAULT NULL,
  due_at int(10) unsigned DEFAULT NULL,
  `repeat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  priority int(1) unsigned DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `tags_tasks`
  ADD CONSTRAINT tags_tasks_ibfk_2 FOREIGN KEY (task_id) REFERENCES tasks (id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT tags_tasks_ibfk_1 FOREIGN KEY (tag_id) REFERENCES tags (id) ON DELETE CASCADE ON UPDATE CASCADE;
