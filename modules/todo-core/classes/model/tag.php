<?php

class Model_Tag extends ORM
{
    protected $_has_many = array('tasks' => array('through' => 'tags_tasks'));

    protected $_rules = array('name' => array('not_empty' => NULL));
    protected $_filters = array(TRUE => array('trim' => NULL));
}
