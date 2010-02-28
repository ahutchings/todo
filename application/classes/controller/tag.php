<?php

class Controller_Tag extends Controller_Website
{
    public function action_show($id)
    {
        $this->template->content = View::factory('tag/show')
            ->bind('tag', $tag);

        $tag = ORM::factory('tag', $id);
    }
}
