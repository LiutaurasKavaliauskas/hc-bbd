<?php

namespace interactivesolutions\honeycombapps\app\providers;

use Illuminate\Routing\Router;
use interactivesolutions\honeycombapps\app\http\middleware\HCAuthApps;
use interactivesolutions\honeycombapps\app\http\middleware\HCAuthAppsPermissions;
use interactivesolutions\honeycombcore\providers\HCBaseServiceProvider;

class HCAppsServiceProvider extends HCBaseServiceProvider
{
    public $serviceProviderNameSpace = 'HCApps';

    protected $homeDirectory = __DIR__;

    protected $commands = [];

    protected $namespace = 'interactivesolutions\honeycombapps\app\http\controllers';

    /**
     * Registering middleware
     *
     * @param Router $router
     */
    protected function registerMiddleWare (Router $router)
    {
        $router->middleware ('auth-apps', HCAuthApps::class);
        $router->middleware ('acl-apps', HCAuthAppsPermissions::class);
    }
}





