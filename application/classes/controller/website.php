<?php

class Controller_Website extends Controller_Template
{
    public function before()
    {
        parent::before();

        if ($this->auto_render) {
            $this->template->styles = array(
                'http://yui.yahooapis.com/combo?3.0.0/build/cssreset/reset-min.css&3.0.0/build/cssfonts/fonts-min.css&3.0.0/build/cssgrids/grids-min.css' => 'screen',
                'css/website.css' => 'screen'
            );

            $this->template->scripts = array(
                'http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js',
                'js/website.js'
            );
        }

        $page = $this->request->param('page', 'index');

        if (isset($this->titles[$page])) {
            // Use the defined page title
            $this->template->title = $this->titles[$page];
        } else {
            // Use the page name as the title
            $this->template->title = ucwords(str_replace('_', ' ', $page));
        }
    }

    public function action_index()
    {
        $this->template->content = View::factory('home/index')
            ->bind('tags', $tags);

        $tags = ORM::factory('tag')->find_all();
    }
}
