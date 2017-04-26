<?php

namespace interactivesolutions\honeycombposts\app\models;

use interactivesolutions\honeycombacl\app\models\HCUsers;
use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;

class HCPosts extends HCMultiLanguageModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'author_id', 'publish_at', 'expires_at', 'cover_photo_id', 'type'];

    /**
     *  Returns author
     *
     * @return mixed
     */
    public function users()
    {
        return $this->hasOne(HCUsers::class, 'id', 'author_id');
    }

}
