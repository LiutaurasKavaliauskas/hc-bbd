<?php

namespace interactivesolutions\honeycombposts\app\models;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCPostsTranslations extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_posts_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'record_id', 'language_code', 'title', 'slug', 'summary', 'content', 'cover_photo_id', 'author_id', 'publish_at', 'expires_at'];
}