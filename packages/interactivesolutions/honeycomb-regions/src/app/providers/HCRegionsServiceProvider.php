<?php

namespace interactivesolutions\honeycombregions\app\providers;

use interactivesolutions\honeycombcore\providers\HCBaseServiceProvider;

class HCRegionsServiceProvider extends HCBaseServiceProvider
{
    protected $homeDirectory = __DIR__;

    protected $commands = [];

    protected $namespace = 'interactivesolutions\honeycombregions\app\http\controllers';

    public $serviceProviderNameSpace = 'HCRegions';

}


