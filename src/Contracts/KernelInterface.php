<?php

namespace App\Contracts;

interface KernelInterface
{
    public function handleRequest(RequestInterface $request, RouterInterface $router);
    public function handleResponse($response);
}
