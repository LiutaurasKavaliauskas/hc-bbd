<?php

namespace interactivesolutions\honeycomblanguages\app\providers;

use Illuminate\Routing\Router;
use interactivesolutions\honeycombcore\providers\HCBaseServiceProvider;
use interactivesolutions\honeycomblanguages\app\http\middleware\HCLanguage;

class HCLanguagesServiceProvider extends HCBaseServiceProvider
{
    protected $homeDirectory = __DIR__;

    protected $commands = [];

    protected $namespace = 'interactivesolutions\honeycomblanguages\app\http\controllers';

    public $serviceProviderNameSpace = 'HCLanguages';

    public function registerRouterItems (Router $router)
    {
        parent::registerRouterItems($router);
        $router->pushMiddleWareToGroup ('web', HCLanguage::class);
    }

}


