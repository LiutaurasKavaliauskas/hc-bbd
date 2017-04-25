<?php

namespace interactivesolutions\honeycombregions\app\models\regions;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCMunicipalities extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_regions_municipalities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'country_id', 'name', 'translation_key'];

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
    protected $appends = ['translation'];

    /**
     * Getting real translation
     *
     * @return string
     */
    public function getTranslationAttribute()
    {
        return trans($this->translation_key);
    }

}
