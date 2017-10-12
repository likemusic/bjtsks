<?php

use App\Base\HTTP_METHODS_ENUM;

return [
    [HTTP_METHODS_ENUM::GET, '/login', 'User@login', 'loginForm'],
    [HTTP_METHODS_ENUM::POST, '/login', 'User@login', 'login'],
    [HTTP_METHODS_ENUM::GET, '/logout', 'User@logout', 'logout'],

/*    [HTTP_METHODS_ENUM::GET,    '/{id}',        'Task@showItem'],//show task
    [HTTP_METHODS_ENUM::GET,    '/{id}/edit',   'Task@editItem'],//show edit form
    [HTTP_METHODS_ENUM::POST,   '/{id}/edit',   'Task@updateItem'],//update task
    [HTTP_METHODS_ENUM::GET,    '/create',      'Task@createItem'],//create task

    [HTTP_METHODS_ENUM::POST,   '/image',   'Image@upload'],//add image*/
];
