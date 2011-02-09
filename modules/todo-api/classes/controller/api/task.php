<?php

class Controller_API_Task extends Controller_API
{
    public function action_index($id = NULL)
    {
        if ($id)
		{
            $task = ORM::factory('task', $id);

            if ( ! $task->loaded())
			{
			    throw new Http_Exception_404('The task id :id was not found.',
			        array(':id' => $id));
            }

            $this->_raw_response = $task;
        }
		else
		{
            $this->_raw_response = ORM::factory('task')->find_all();
        }
    }

    public function action_create()
    {
        $task = ORM::factory('task')
            ->values($this->input())
            ->save();

        $this->response->status(201);
        $this->_raw_response = array('ok' => TRUE, 'id' => $task->id);
    }

    public function action_update($id)
    {
        $task = ORM::factory('task', $id)
            ->values($this->input())
            ->save();

        $this->_raw_response = array('ok' => TRUE, 'id' => $task->id);
    }

    public function action_delete($id)
    {
        ORM::factory('task')->delete($id);

        $this->_raw_response = array('ok' => TRUE);
    }
}
