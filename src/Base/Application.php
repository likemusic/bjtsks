<?php

namespace App\Base;

use App\Contracts\ApplicationInterface;
use App\Contracts\IoCContainerInterface;
use App\Contracts\KernelInterface;
use App\Contracts\RequestInterface;
use App\Contracts\RouterInterface;

class Application implements ApplicationInterface
{
    private $basePath;

    public function __construct($basePath)
    {
        $this->basePath = $basePath;
    }

    public function run()
    {
        $container = $this->initContainer();
        $router = $this->createAndInitRouter($container);
        $request = $this->createRequest($container);
        $kernel = $this->createKernel($container);

        $response = $kernel->handleRequest($request, $router);
        $kernel->handleResponse($response);
    }

    /**
     * @return IoCContainerInterface
     */
    private function initContainer()
    {
        $container = new IoCContainer();

        $container->setValue(AppServicesEnum::BASE_DIR, $this->basePath);

        $this->setContainerValues($container);
        $this->setContainerDefs($container);

        return $container;
    }

    private function setContainerValues(IoCContainerInterface $container)
    {
        $containerValuesFilename = '{base_path}/app/config/values.php';
        $container->setDefinition(AppServicesEnum::CONTAINER_VALUES_FILENAME, $containerValuesFilename);

        $filename = $container->get(AppServicesEnum::CONTAINER_VALUES_FILENAME);
        $values = include $filename;

        foreach ($values as $key => $value) {
            $container->setValue($key, $value);
        }
    }

    private function setContainerDefs(IoCContainerInterface $container)
    {
        $filename = $container->get(AppServicesEnum::CONTAINER_DEFS_FILENAME);

        $defs = include $filename;

        //todo: implement by array for support caching
        foreach ($defs as $key => $classOrArray) {
            if (is_string($classOrArray)) {
                $container->setDefinition($key, $classOrArray);
            } else {
                $class = key($classOrArray);
                $args = current($classOrArray);
                $container->setDefinition($key, $class, $args);
            }
        }
    }

    /**
     * @return array [$interfaceName => $className]
     */
    private function getIoCContainerConfig()
    {
        $filename = $this->getConfigDir() . '/services.php';

        return include $filename;
    }

    /**
     * @return string
     */
    private function getConfigDir()
    {
        return $this->basePath.'/app/config';
    }

    private function createAndInitRouter(IoCContainerInterface $container)
    {
        $routerConfig = $this->getRouterConfig();
        $container->set('router.config', $routerConfig);

        $router = $container->get(RouterInterface::class);
        return $router;
    }

    public function getRouterConfig()
    {
        $filename = $this->getRouteConfigFilename();

        return include $filename;
    }

    private function getRouteConfigFilename()
    {
        return $filename = $this->basePath . '/app/routes/web.php';
    }


    private function createRequest(IoCContainerInterface $container)
    {
        return $container->get(RequestInterface::class);
    }

    /**
     * @param $container
     * @return KernelInterface
     */
    private function createKernel(IoCContainerInterface $container)
    {
        return $container->get(KernelInterface::class);
    }

    private function handleRequest($request)
    {

    }

    private function handleResponse($response)
    {
        echo "Hello, world! :)";
    }
}