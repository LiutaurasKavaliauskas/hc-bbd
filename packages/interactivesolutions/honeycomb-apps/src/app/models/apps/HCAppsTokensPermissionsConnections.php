<?php

namespace interactivesolutions\honeycombapps\app\models\apps;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCAppsTokensPermissionsConnections extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_apps_tokens_permissions_connections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['token_id', 'permission_id'];
}