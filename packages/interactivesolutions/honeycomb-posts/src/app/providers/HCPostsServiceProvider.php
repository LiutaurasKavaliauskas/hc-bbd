<?php

namespace interactivesolutions\honeycombposts\app\providers;

use interactivesolutions\honeycombcore\providers\HCBaseServiceProvider;

class HCPostsServiceProvider extends HCBaseServiceProvider
{
    protected $homeDirectory = __DIR__;

    protected $commands = [];

    protected $namespace = 'interactivesolutions\honeycombposts\app\http\controllers';

    public $serviceProviderNameSpace = 'HCPosts';
}





