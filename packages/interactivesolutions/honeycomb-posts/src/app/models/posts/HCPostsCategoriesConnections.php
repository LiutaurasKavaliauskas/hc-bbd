<?php

namespace interactivesolutions\honeycombposts\app\models\posts;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCPostsCategoriesConnections extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_posts_categories_connections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['post_id', 'category_id'];
}