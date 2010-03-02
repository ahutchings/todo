<?php

Route::set('todo-api', 'api/<controller>')
    ->defaults(array(
        'directory' => 'api',
    ));
