<?php

namespace App\Contracts;

interface RouterInterface
{
    /**
     * @param $method
     * @param $path
     * @param $get
     * @param $post
     * @return callable
     */
    public function getCallbackForRoute($method, $path, $get, $post);

    public function addRoute($method, $path, $controllerAction);
}
