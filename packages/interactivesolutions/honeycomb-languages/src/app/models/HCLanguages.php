<?php

namespace interactivesolutions\honeycomblanguages\app\models;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCLanguages extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_languages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'language_family', 'language', 'native_name', 'iso_639_1', 'iso_639_2', 'front_end', 'back_end', 'content'];

}
