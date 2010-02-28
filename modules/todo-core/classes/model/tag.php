<?php

class Model_Tag extends ORM
{
    protected $_has_many = array('tasks' => array('through' => 'tags_tasks'));
}
