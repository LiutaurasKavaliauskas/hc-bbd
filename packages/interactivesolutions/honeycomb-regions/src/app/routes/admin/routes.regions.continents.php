<?php

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function ()
{
    Route::get('regions/continents', ['as' => 'admin.regions.continents', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_continents_list'], 'uses' => 'regions\\HCContinentsController@adminView']);

    Route::group(['prefix' => 'api/regions/continents'], function ()
    {
        Route::get('/', ['as' => 'admin.api.regions.continents', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_continents_list'], 'uses' => 'regions\\HCContinentsController@listPage']);
        Route::get('list/{timestamp}', ['as' => 'admin.api.regions.continents.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_continents_list'], 'uses' => 'regions\\HCContinentsController@listUpdate']);
        Route::get('list', ['as' => 'admin.api.regions.continents.list', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_continents_list'], 'uses' => 'regions\\HCContinentsController@list']);
        Route::get('search', ['as' => 'admin.api.regions.continents.search', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_continents_list'], 'uses' => 'regions\\HCContinentsController@listSearch']);
        Route::get('{id}', ['as' => 'admin.api.regions.continents.single', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_continents_list'], 'uses' => 'regions\\HCContinentsController@getSingleRecord']);
    });
});
