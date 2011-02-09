<?php

class Model_Task extends ORM
{
    protected $_has_many = array('tags' => array('through' => 'tags_tasks'));

    protected $_created_column = array('column' => 'created_at', 'format' => TRUE);
	protected $_updated_column = array('column' => 'updated_at', 'format' => TRUE);

    public function rules()
    {
        return array(
            'name' => array(
                array('not_empty'),
            ),
            'user_id' => array(
                array('not_empty'),
                array('digit'),
            ),
        );
    }

    public function filters()
    {
        return array(
            TRUE => array(
                array('trim'),
            ),
        );   
    }
}
