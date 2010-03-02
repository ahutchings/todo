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

    public function action_create() {}
    public function action_update() {}
    public function action_delete() {}
}
