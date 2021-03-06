<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Create initial schema
 */
class Migration_Todo_core_20110401234802 extends Minion_Migration_Base {

	/**
	 * Run queries needed to apply this migration
	 *
	 * @param Kohana_Database Database connection
	 */
	public function up(Kohana_Database $db)
	{
        $db->query(NULL, 'CREATE TABLE roles (
          id int(11) unsigned NOT NULL AUTO_INCREMENT,
          `name` varchar(32) NOT NULL,
          description varchar(255) NOT NULL,
          PRIMARY KEY (id),
          UNIQUE KEY uniq_name (`name`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8');

        $db->query(NULL, 'CREATE TABLE roles_users (
          user_id int(10) unsigned NOT NULL,
          role_id int(10) unsigned NOT NULL,
          PRIMARY KEY (user_id,role_id),
          KEY fk_role_id (role_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8');
        
        $db->query(NULL, 'CREATE TABLE tags (
          id int(11) unsigned NOT NULL AUTO_INCREMENT,
          `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
          created_at int(10) unsigned NOT NULL,
          updated_at int(10) unsigned DEFAULT NULL,
          user_id int(11) unsigned NOT NULL,
          PRIMARY KEY (id),
          KEY user_id (user_id)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

        $db->query(NULL, 'CREATE TABLE tags_tasks (
          tag_id int(11) unsigned NOT NULL,
          task_id int(11) unsigned NOT NULL,
          PRIMARY KEY (tag_id,task_id),
          KEY tag_id (tag_id),
          KEY task_id (task_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

        $db->query(NULL, 'CREATE TABLE tasks (
          id int(11) unsigned NOT NULL AUTO_INCREMENT,
          `name` text COLLATE utf8_unicode_ci NOT NULL,
          created_at int(10) unsigned NOT NULL,
          updated_at int(10) unsigned DEFAULT NULL,
          completed_at int(10) unsigned DEFAULT NULL,
          due_at int(10) unsigned DEFAULT NULL,
          `repeat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
          priority int(1) unsigned DEFAULT NULL,
          user_id int(11) unsigned NOT NULL,
          PRIMARY KEY (id),
          KEY user_id (user_id)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

        $db->query(NULL, 'CREATE TABLE users (
          id int(11) unsigned NOT NULL AUTO_INCREMENT,
          email varchar(127) NOT NULL,
          username varchar(32) NOT NULL DEFAULT \'\',
          `password` char(50) NOT NULL,
          logins int(10) unsigned NOT NULL DEFAULT \'0\',
          last_login int(10) unsigned DEFAULT NULL,
          PRIMARY KEY (id),
          UNIQUE KEY uniq_username (username),
          UNIQUE KEY uniq_email (email)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8');
        
        $db->query(NULL, 'CREATE TABLE user_tokens (
          id int(11) unsigned NOT NULL AUTO_INCREMENT,
          user_id int(11) unsigned NOT NULL,
          user_agent varchar(40) NOT NULL,
          token varchar(32) NOT NULL,
          created int(10) unsigned NOT NULL,
          expires int(10) unsigned NOT NULL,
          PRIMARY KEY (id),
          UNIQUE KEY uniq_token (token),
          KEY fk_user_id (user_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8');

        $db->query(NULL, 'ALTER TABLE `roles_users`
          ADD CONSTRAINT roles_users_ibfk_1 FOREIGN KEY (user_id) REFERENCES `users` (id) ON DELETE CASCADE,
          ADD CONSTRAINT roles_users_ibfk_2 FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE CASCADE');
        
        $db->query(NULL, 'ALTER TABLE `tags`
          ADD CONSTRAINT tags_ibfk_1 FOREIGN KEY (user_id) REFERENCES `users` (id) ON DELETE CASCADE ON UPDATE CASCADE');

        $db->query(NULL, 'ALTER TABLE `tags_tasks`
          ADD CONSTRAINT tags_tasks_ibfk_2 FOREIGN KEY (task_id) REFERENCES tasks (id) ON DELETE CASCADE ON UPDATE CASCADE,
          ADD CONSTRAINT tags_tasks_ibfk_1 FOREIGN KEY (tag_id) REFERENCES tags (id) ON DELETE CASCADE ON UPDATE CASCADE');
        
        $db->query(NULL, 'ALTER TABLE `tasks`
          ADD CONSTRAINT tasks_ibfk_1 FOREIGN KEY (user_id) REFERENCES `users` (id) ON DELETE CASCADE ON UPDATE CASCADE');

        $db->query(NULL, 'ALTER TABLE `user_tokens`
          ADD CONSTRAINT user_tokens_ibfk_1 FOREIGN KEY (user_id) REFERENCES `users` (id) ON DELETE CASCADE');
	}

	/**
	 * Run queries needed to remove this migration
	 *
	 * @param Kohana_Database Database connection
	 */
	public function down(Kohana_Database $db)
	{
        $db->query(NULL, 'DROP TABLE roles_users, roles, user_tokens,
            tags_tasks, tags, tasks, users');
	}
}
