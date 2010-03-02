<?php

Route::set('todo-api', 'api/<controller>(/<id>)')
    ->defaults(array(
        'directory' => 'api',
    ));
