<?php

namespace interactivesolutions\honeycombregions\app\models\regions;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCContinents extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_regions_continents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'translation_key'];

    /**
     * The attributes that are hidden
     *
     * @var array
     */
    protected $hidden = ['translation_key'];

    /**
     * The attributes which will be added automatically
     *
     * @var array
     */
    protected $appends = ['name'];

    /**
     * Getting real translation
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return trans($this->translation_key);
    }
}
