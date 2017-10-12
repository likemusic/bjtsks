<?php

namespace App\Base;

use App\Contracts\KernelInterface;
use App\Contracts\RequestInterface;
use App\Contracts\RouterInterface;

class Kernel implements KernelInterface
{
    public function handleRequest(RequestInterface $request, RouterInterface $router)
    {
        $callback = $router->getCallbackForRoute(
            $request->getMethod(),
            $request->getPath(),
            $request->getGet(),
            $request->getPost()
        );

        return call_user_func($callback);
    }

    public function handleResponse($response)
    {
        if (is_string($response)) {
            echo $response;
        }
    }
}
