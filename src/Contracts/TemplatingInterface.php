<?php

namespace Contracts;

interface TemplatingInterface
{
    public function render($name, $values);
}
