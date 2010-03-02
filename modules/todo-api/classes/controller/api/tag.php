<?php

class Controller_API_Tag extends Controller_API
{
    public function action_index()
    {
        $this->response = ORM::factory('tag')->find_all();
    }

    public function action_create() {}
    public function action_update() {}
    public function action_delete() {}
}
