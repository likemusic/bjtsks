<?php

namespace Base;

use Contracts\TemplatingInterface;

class Templating implements TemplatingInterface
{
    private $templating;

    public function __construct(\Twig_Environment $templating)
    {
        $this->templating;
    }

    public function render($name, $values)
    {
        return $this->templating->render($name . '.html.twig', $values);
    }
}
