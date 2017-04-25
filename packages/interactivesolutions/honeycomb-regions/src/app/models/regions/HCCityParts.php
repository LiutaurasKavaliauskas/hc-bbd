<?php

namespace interactivesolutions\honeycombregions\app\models\regions;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCCityParts extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_regions_city_parts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'city_id', 'name', 'translation_key'];

    protected $appends = ['municipality_id', 'country_id', 'city'];

    public function city()
    {
        return $city = $this->hasOne(HCCities::class, 'id', 'city_id');
    }

    /**
     * Getting manucipality id attribute
     *
     * @return mixed
     */
    public function getMunicipalityIdAttribute()
    {
        return $this->belongsTo(HCCities::class, 'city_id', 'id')->getResults()->municipality_id;
    }

    /**
     * Getting country id attribute
     *
     * @return mixed
     */
    public function getCountryIdAttribute()
    {
        return $this->belongsTo(HCMunicipalities::class, 'municipality_id', 'id')->getResults()->country_id;
    }

    /**
     * Getting city attribute
     *
     * @return mixed
     */
    public function getCityAttribute()
    {
        return $this->belongsTo(HCCities::class, 'city_id', 'id')->getResults()->name;
    }
}
