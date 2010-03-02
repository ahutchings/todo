<?php

class Controller_API_Task extends Controller_API
{
    public function action_index()
    {
        $this->response = ORM::factory('task')->find_all();
    }

    public function action_create() {}
    public function action_update() {}
    public function action_delete() {}
}
