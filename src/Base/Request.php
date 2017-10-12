<?php

namespace App\Base;

use App\Contracts\RequestInterface;
use Symfony\Component\Debug\Tests\Fixtures2\RequiredTwice;

class Request implements RequestInterface
{
    public function getHost()
    {
        return $_SERVER['HTTP_HOST'];
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getPath()
    {
        $uri =  $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        return $uri;
    }

    public function getPost()
    {
        return $_POST;
    }

    public function getGet()
    {
        return $_GET;
    }
}
