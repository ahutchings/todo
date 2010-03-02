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

    public function action_create() {}
    public function action_update() {}
    public function action_delete() {}
}
