<?php

namespace App\Base;

interface AppServicesEnum
{
    const BASE_DIR  = 'base_dir';

    const CONTAINER_VALUES_FILENAME = 'container.values.filename';
    const CONTAINER_DEFS_FILENAME = 'container.defs.filename';

    const ROUTES_FILENAME = 'routes.filename';
    const ROUTER_CONFIG = 'router.config';
    const TWIG_TEMPLATES_DIR = 'twig.templates_dir';
    const TWIG_CACHE_DIR = 'twig.storage_dir';
    const TWIG_LOADER = 'twig.loader';
    const TWIG_CONFIG = 'twig.config';
}
