<?php

namespace interactivesolutions\honeycombregions\app\models\regions;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCCities extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_regions_cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'municipality_id', 'name', 'translation_key'];

    protected $appends = ['country_id'];

    /**
     * Getting country id attribute
     *
     * @return mixed
     */
    public function getCountryIdAttribute()
    {
        return $this->belongsTo(HCMunicipalities::class, 'municipality_id', 'id')->getResults()->country_id;
    }
    
}
