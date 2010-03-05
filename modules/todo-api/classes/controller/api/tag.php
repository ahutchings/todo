<?php

class Controller_API_Tag extends Controller_API
{
    public function action_index($id = null)
    {
        if (!is_null($id)) {
            $this->response = ORM::factory('tag', $id);
        } else {
            $this->response = ORM::factory('tag')->find_all();
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
        $tag = ORM::factory('tag', $id)
            ->values($this->input())
            ->save();

        $this->response = array('ok' => TRUE, 'id' => $tag->id);
    }

    public function action_delete($id)
    {
        ORM::factory('tag')->delete($id);
    }
}
