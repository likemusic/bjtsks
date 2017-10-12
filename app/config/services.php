<?php

use App\Base\AppServicesEnum;

return [
    \App\Contracts\KernelInterface::class   => App\Base\Kernel::class,
    \App\Contracts\RequestInterface::class  => \App\Base\Request::class,
    \App\Contracts\ResponseInterface::class => App\Base\Response::class,
    \App\Contracts\RouterInterface::class   => \App\Base\Router::class,
    \App\Base\Router::class => [null => [App\Base\AppServicesEnum::ROUTER_CONFIG]],

    \App\Contracts\RoutesProviderInterface::class => \Base\RoutesProvider::class,

    //twig
    AppServicesEnum::TWIG_LOADER => Twig_Loader_Filesystem::class,
    Twig_Loader_Filesystem::class => [null => [AppServicesEnum::TWIG_TEMPLATES_DIR]],
    Twig_Environment::class => [null => [AppServicesEnum::TWIG_LOADER, ]]
];
