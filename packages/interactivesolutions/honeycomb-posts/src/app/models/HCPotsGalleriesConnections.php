<?php

namespace interactivesolutions\honeycombposts\app\models;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCPotsGalleriesConnections extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_posts_galleries_connections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['post_id', 'gallery_id'];
}