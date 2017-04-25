<?php

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function ()
{
    Route::get('regions/cities', ['as' => 'admin.regions.cities', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_cities_list'], 'uses' => 'regions\\HCCitiesController@adminView']);

    Route::group(['prefix' => 'api/regions/cities'], function ()
    {
        Route::get('/', ['as' => 'admin.api.regions.cities', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_cities_list'], 'uses' => 'regions\\HCCitiesController@listPage']);
        Route::get('list/{timestamp}', ['as' => 'admin.api.regions.cities.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_cities_list'], 'uses' => 'regions\\HCCitiesController@listUpdate']);
        Route::get('list', ['as' => 'admin.api.regions.cities.list', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_cities_list'], 'uses' => 'regions\\HCCitiesController@list']);
        Route::get('search', ['as' => 'admin.api.regions.cities.search', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_cities_list'], 'uses' => 'regions\\HCCitiesController@listSearch']);
        Route::get('{id}', ['as' => 'admin.api.regions.cities.single', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_cities_list'], 'uses' => 'regions\\HCCitiesController@getSingleRecord']);

        Route::post('{id}/duplicate', ['as' => 'admin.api.regions.cities.duplicate', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_cities_update'], 'uses' => 'regions\\HCCitiesController@duplicate']);
        Route::post('restore', ['as' => 'admin.api.regions.cities.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_cities_update'], 'uses' => 'regions\\HCCitiesController@restore']);
        Route::post('merge', ['as' => 'admin.api.regions.cities.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_cities_update'], 'uses' => 'regions\\HCCitiesController@merge']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_cities_create'], 'uses' => 'regions\\HCCitiesController@create']);

        Route::put('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_cities_update'], 'uses' => 'regions\\HCCitiesController@update']);
        Route::put('{id}/strict', ['as' => 'admin.api.regions.cities.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_cities_update'], 'uses' => 'regions\\HCCitiesController@updateStrict']);

        Route::delete('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_cities_delete'], 'uses' => 'regions\\HCCitiesController@delete']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_cities_delete'], 'uses' => 'regions\\HCCitiesController@delete']);
        Route::delete('{id}/force', ['as' => 'admin.api.regions.cities.force', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_cities_force_delete'], 'uses' => 'regions\\HCCitiesController@forceDelete']);
        Route::delete('force', ['as' => 'admin.api.regions.cities.force.multi', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_cities_force_delete'], 'uses' => 'regions\\HCCitiesController@forceDelete']);
    });
});
