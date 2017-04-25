<?php

Route::group(['prefix' => 'api', 'middleware' => ['web', 'auth']], function ()
{
    Route::get('regions/municipalities', ['as' => 'api.v1.regions.municipalities', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_municipalities_list'], 'uses' => 'regions\\HCMunicipalitiesController@adminView']);

    Route::group(['prefix' => 'v1/regions/municipalities'], function ()
    {
        Route::get('/', ['as' => 'api.v1.api.regions.municipalities', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_municipalities_list'], 'uses' => 'regions\\HCMunicipalitiesController@listPage']);
        Route::get('list/{timestamp}', ['as' => 'api.v1.api.regions.municipalities.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_municipalities_list'], 'uses' => 'regions\\HCMunicipalitiesController@listUpdate']);
        Route::get('list', ['as' => 'api.v1.api.regions.municipalities.list', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_municipalities_list'], 'uses' => 'regions\\HCMunicipalitiesController@list']);
        Route::get('search', ['as' => 'api.v1.api.regions.municipalities.search', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_municipalities_list'], 'uses' => 'regions\\HCMunicipalitiesController@listSearch']);
        Route::get('{id}', ['as' => 'api.v1.api.regions.municipalities.single', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_municipalities_list'], 'uses' => 'regions\\HCMunicipalitiesController@getSingleRecord']);

        Route::post('{id}/duplicate', ['as' => 'api.v1.api.regions.municipalities.duplicate', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_municipalities_update'], 'uses' => 'regions\\HCMunicipalitiesController@duplicate']);
        Route::post('restore', ['as' => 'api.v1.api.regions.municipalities.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_municipalities_update'], 'uses' => 'regions\\HCMunicipalitiesController@restore']);
        Route::post('merge', ['as' => 'api.v1.api.regions.municipalities.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_municipalities_update'], 'uses' => 'regions\\HCMunicipalitiesController@merge']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_municipalities_create'], 'uses' => 'regions\\HCMunicipalitiesController@create']);

        Route::put('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_municipalities_update'], 'uses' => 'regions\\HCMunicipalitiesController@update']);
        Route::put('{id}/strict', ['as' => 'api.v1.api.regions.municipalities.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_municipalities_update'], 'uses' => 'regions\\HCMunicipalitiesController@updateStrict']);

        Route::delete('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_municipalities_delete'], 'uses' => 'regions\\HCMunicipalitiesController@delete']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_municipalities_delete'], 'uses' => 'regions\\HCMunicipalitiesController@delete']);
        Route::delete('{id}/force', ['as' => 'api.v1.api.regions.municipalities.force', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_municipalities_force_delete'], 'uses' => 'regions\\HCMunicipalitiesController@forceDelete']);
        Route::delete('force', ['as' => 'api.v1.api.regions.municipalities.force.multi', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_municipalities_force_delete'], 'uses' => 'regions\\HCMunicipalitiesController@forceDelete']);
    });
});
