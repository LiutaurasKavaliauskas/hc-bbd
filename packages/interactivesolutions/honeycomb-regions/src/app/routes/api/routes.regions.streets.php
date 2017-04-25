<?php

Route::group(['prefix' => 'api', 'middleware' => ['web', 'auth']], function ()
{
    Route::get('regions/streets', ['as' => 'api.v1.regions.streets', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_streets_list'], 'uses' => 'regions\\HCStreetsController@adminView']);

    Route::group(['prefix' => 'v1/regions/streets'], function ()
    {
        Route::get('/', ['as' => 'api.v1.api.regions.streets', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_streets_list'], 'uses' => 'regions\\HCStreetsController@listPage']);
        Route::get('list/{timestamp}', ['as' => 'api.v1.api.regions.streets.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_streets_list'], 'uses' => 'regions\\HCStreetsController@listUpdate']);
        Route::get('list', ['as' => 'api.v1.api.regions.streets.list', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_streets_list'], 'uses' => 'regions\\HCStreetsController@list']);
        Route::get('search', ['as' => 'api.v1.api.regions.streets.search', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_streets_list'], 'uses' => 'regions\\HCStreetsController@listSearch']);
        Route::get('{id}', ['as' => 'api.v1.api.regions.streets.single', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_streets_list'], 'uses' => 'regions\\HCStreetsController@getSingleRecord']);

        Route::post('{id}/duplicate', ['as' => 'api.v1.api.regions.streets.duplicate', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_streets_update'], 'uses' => 'regions\\HCStreetsController@duplicate']);
        Route::post('restore', ['as' => 'api.v1.api.regions.streets.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_streets_update'], 'uses' => 'regions\\HCStreetsController@restore']);
        Route::post('merge', ['as' => 'api.v1.api.regions.streets.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_streets_update'], 'uses' => 'regions\\HCStreetsController@merge']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_streets_create'], 'uses' => 'regions\\HCStreetsController@create']);

        Route::put('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_streets_update'], 'uses' => 'regions\\HCStreetsController@update']);
        Route::put('{id}/strict', ['as' => 'api.v1.api.regions.streets.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_streets_update'], 'uses' => 'regions\\HCStreetsController@updateStrict']);

        Route::delete('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_streets_delete'], 'uses' => 'regions\\HCStreetsController@delete']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_streets_delete'], 'uses' => 'regions\\HCStreetsController@delete']);
        Route::delete('{id}/force', ['as' => 'api.v1.api.regions.streets.force', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_streets_force_delete'], 'uses' => 'regions\\HCStreetsController@forceDelete']);
        Route::delete('force', ['as' => 'api.v1.api.regions.streets.force.multi', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_streets_force_delete'], 'uses' => 'regions\\HCStreetsController@forceDelete']);
    });
});
