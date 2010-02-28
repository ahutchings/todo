<?php

class Model_Task extends ORM
{
    protected $_has_many = array('tags' => array('through' => 'tags_tasks'));
}
