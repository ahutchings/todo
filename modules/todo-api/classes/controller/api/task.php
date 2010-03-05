<?php

class Controller_API_Task extends Controller_API
{
    public function action_index($id = null)
    {
        if (!is_null($id)) {
            $this->response = ORM::factory('task', $id);
        } else {
            $this->response = ORM::factory('task')->find_all();
        }
    }

    public function action_create()
    {
        $task = ORM::factory('task')
            ->values($this->input())
            ->save();

        $this->request->status = 201;
        $this->response = array('ok' => TRUE, 'id' => $task->id);
    }

    public function action_update($id)
    {
        $task = ORM::factory('task', $id)
            ->values($this->input())
            ->save();

        $this->response = array('ok' => TRUE, 'id' => $task->id);
    }

    public function action_delete($id)
    {
        ORM::factory('task')->delete($id);

        $this->response = array('ok' => TRUE);
    }
}
