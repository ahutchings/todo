<?php

class Model_Task extends ORM
{
    protected $_has_many = array('tags' => array('through' => 'tags_tasks'));

    protected $_rules = array('name' => array('not_empty' => NULL));
    protected $_filters = array(TRUE => array('trim' => NULL));

	protected $_created_column = array('column' => 'created_at', 'format' => TRUE);
	protected $_updated_column = array('column' => 'updated_at', 'format' => TRUE);
}
