<?php

Route::group(['prefix' => 'api', 'middleware' => ['web', 'auth']], function ()
{
    Route::get('regions/continents', ['as' => 'api.v1.regions.continents', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_continents_list'], 'uses' => 'regions\\HCContinentsController@adminView']);

    Route::group(['prefix' => 'v1/regions/continents'], function ()
    {
        Route::get('/', ['as' => 'api.v1.api.regions.continents', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_continents_list'], 'uses' => 'regions\\HCContinentsController@listPage']);
        Route::get('list/{timestamp}', ['as' => 'api.v1.api.regions.continents.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_continents_list'], 'uses' => 'regions\\HCContinentsController@listUpdate']);
        Route::get('list', ['as' => 'api.v1.api.regions.continents.list', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_continents_list'], 'uses' => 'regions\\HCContinentsController@list']);
        Route::get('search', ['as' => 'api.v1.api.regions.continents.search', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_continents_list'], 'uses' => 'regions\\HCContinentsController@listSearch']);
        Route::get('{id}', ['as' => 'api.v1.api.regions.continents.single', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_continents_list'], 'uses' => 'regions\\HCContinentsController@getSingleRecord']);
    });
});
