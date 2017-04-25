<?php

namespace interactivesolutions\honeycombpages\database\seeds;

use DB;
use Illuminate\Database\Seeder;
use interactivesolutions\honeycombresources\app\http\controllers\HCUploadController;
use interactivesolutions\honeycombresources\app\models\HCResources;
use File;

class PagesSeeder extends Seeder
{
    public function run()
    {
        $image = new HCUploadController();
        $location = __DIR__ . '/../../app/commands/templates/images/dereva.jpg';
        $image->downloadResource($location, true, 'dereva.jpg', 'image/jpg');
    }
}