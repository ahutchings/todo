<?php

class Controller_Task extends Controller_API
{
    public function action_index()
    {
        $tasks = array();

        foreach (ORM::factory('task')->find_all() as $task) {
            $tasks[] = $task->as_array();
        }

        $this->response = $tasks;
    }

    public function action_create() {}
    public function action_update() {}
    public function action_delete() {}
}
