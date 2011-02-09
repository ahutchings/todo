<?php

class Controller_API_Tag extends Controller_API
{
    public function action_index($id = NULL)
    {
        if ($id)
		{
            $this->_raw_response = ORM::factory('tag', $id);
        }
		else
		{
            $this->_raw_response = ORM::factory('tag')->find_all();
        }
    }

    public function action_create()
    {
        // Decode the posted JSON object as an array
        $values = json_decode($this->request->body(), TRUE);
        
        $task = ORM::factory('task')
            ->values($values)
            ->save();

        $this->response->status(201);
        $this->_raw_response = array('ok' => TRUE, 'id' => $task->id);
    }

    public function action_update($id)
    {
        $tag = ORM::factory('tag', $id)
            ->values($this->input())
            ->save();

        $this->_raw_response = array('ok' => TRUE, 'id' => $tag->id);
    }

    public function action_delete($id)
    {
        ORM::factory('tag')->delete($id);
    }
}
