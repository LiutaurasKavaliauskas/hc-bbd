<?php

namespace interactivesolutions\honeycombregions\app\models\regions;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCCountriesLanguagesConnections extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_regions_countries_languages_connections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['country_id', 'language_id', 'official'];

}
