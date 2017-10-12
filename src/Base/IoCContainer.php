<?php

namespace App\Base;

use App\Contracts\IoCContainerInterface;
use DI\ContainerBuilder;

class IoCContainer implements IoCContainerInterface
{
    private $container;

    public function __construct()
    {
        $this->container = ContainerBuilder::buildDevContainer();
    }

    public function get($key)
    {
        return $this->container->get($key);
    }

    public function setDefinition($key, $value, $args = null)
    {
        if (is_string($value)) {
            $diObject = \DI\object($value);
        } else {
            $diObject = $value;
        }

        if ($args) {
            $diArgs = array_map(function ($arg) {
                return \DI\get($arg);
            }, $args);

            call_user_func_array([$diObject, 'constructor'], $diArgs);
        }

        $this->container->set($key, $diObject);
    }

    public function setValue($key, $value)
    {
        $this->container->set($key, $value);
    }
}
