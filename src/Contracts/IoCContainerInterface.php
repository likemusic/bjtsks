<?php

namespace App\Contracts;

interface IoCContainerInterface
{
    public function get($key);
    public function setDefinition($key, $value, $args = null);
    public function setValue($key, $value);
}
