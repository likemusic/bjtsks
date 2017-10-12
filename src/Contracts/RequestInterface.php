<?php

namespace App\Contracts;

interface RequestInterface
{
    public function getHost();
    public function getMethod();
    public function getPath();
    public function getPost();
    public function getGet();
}
