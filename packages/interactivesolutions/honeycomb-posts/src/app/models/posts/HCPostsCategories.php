<?php

namespace interactivesolutions\honeycombposts\app\models\posts;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;

class HCPostsCategories extends HCMultiLanguageModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_posts_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'parent_id', 'cover_photo_id'];

}
