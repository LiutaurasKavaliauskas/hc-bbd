<?php

namespace interactivesolutions\honeycombposts\app\models\posts;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCPostsCategoriesTranslations extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_posts_categories_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'record_id', 'language_code', 'title', 'slug', 'content', 'cover_photo_id'];
}