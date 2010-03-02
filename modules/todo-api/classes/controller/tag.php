<?php

class Controller_Tag extends Controller_API
{
    public function action_index()
    {
        $tags = array();

        foreach (ORM::factory('tag')->find_all() as $tag) {
            $tags[] = $tag->as_array();
        }

        $this->response = $tags;
    }

    public function action_create() {}
    public function action_update() {}
    public function action_delete() {}
}
