<?php

namespace interactivesolutions\honeycombapps\app\models\apps;

use interactivesolutions\honeycombapps\app\models\traits\AppsRolesPermissions;
use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCAppsTokens extends HCUuidModel
{
    use AppsRolesPermissions;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_apps_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'expires_at', 'token', 'app_id'];
}