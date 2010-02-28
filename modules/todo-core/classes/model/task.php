<?php

class Model_Task extends ORM
{
    protected $_has_many = array('tags' => array('through' => 'tags_tasks'));

    protected $_rules = array('content' => array('not_empty' => NULL));
    protected $_filters = array(TRUE => array('trim' => NULL));
}
