<?php

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function ()
{
    Route::get('regions/parts', ['as' => 'admin.regions.parts', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_parts_list'], 'uses' => 'regions\\HCCityPartsController@adminView']);

    Route::group(['prefix' => 'api/regions/parts'], function ()
    {
        Route::get('/', ['as' => 'admin.api.regions.parts', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_parts_list'], 'uses' => 'regions\\HCCityPartsController@listPage']);
        Route::get('list/{timestamp}', ['as' => 'admin.api.regions.parts.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_parts_list'], 'uses' => 'regions\\HCCityPartsController@listUpdate']);
        Route::get('list', ['as' => 'admin.api.regions.parts.list', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_parts_list'], 'uses' => 'regions\\HCCityPartsController@list']);
        Route::get('search', ['as' => 'admin.api.regions.parts.search', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_parts_list'], 'uses' => 'regions\\HCCityPartsController@listSearch']);
        Route::get('{id}', ['as' => 'admin.api.regions.parts.single', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_parts_list'], 'uses' => 'regions\\HCCityPartsController@getSingleRecord']);

        Route::post('{id}/duplicate', ['as' => 'admin.api.regions.parts.duplicate', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_parts_update'], 'uses' => 'regions\\HCCityPartsController@duplicate']);
        Route::post('restore', ['as' => 'admin.api.regions.parts.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_parts_update'], 'uses' => 'regions\\HCCityPartsController@restore']);
        Route::post('merge', ['as' => 'admin.api.regions.parts.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_parts_update'], 'uses' => 'regions\\HCCityPartsController@merge']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_parts_create'], 'uses' => 'regions\\HCCityPartsController@create']);

        Route::put('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_parts_update'], 'uses' => 'regions\\HCCityPartsController@update']);
        Route::put('{id}/strict', ['as' => 'admin.api.regions.parts.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_parts_update'], 'uses' => 'regions\\HCCityPartsController@updateStrict']);

        Route::delete('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_parts_delete'], 'uses' => 'regions\\HCCityPartsController@delete']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_parts_delete'], 'uses' => 'regions\\HCCityPartsController@delete']);
        Route::delete('{id}/force', ['as' => 'admin.api.regions.parts.force', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_parts_force_delete'], 'uses' => 'regions\\HCCityPartsController@forceDelete']);
        Route::delete('force', ['as' => 'admin.api.regions.parts.force.multi', 'middleware' => ['acl:interactivesolutions_honeycomb_regions_regions_parts_force_delete'], 'uses' => 'regions\\HCCityPartsController@forceDelete']);
    });
});
