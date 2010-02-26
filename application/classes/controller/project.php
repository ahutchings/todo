<?php

class Controller_Project extends Controller_Website
{
    public function action_show($id)
    {
        $this->template->content = View::factory('project/show')
            ->bind('project', $project);

        $project = ORM::factory('project', $id);
    }
}
