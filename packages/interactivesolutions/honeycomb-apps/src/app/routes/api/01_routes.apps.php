<?php

Route::group(['prefix' => 'api', 'middleware' => ['web', 'auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/apps'], function ()
    {
        Route::get('/', ['as' => 'api.v1.apps', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_list'], 'uses' => 'HCAppsController@listPage']);
        Route::get('list', ['as' => 'api.v1.apps.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_list'], 'uses' => 'HCAppsController@list']);
        Route::get('list/{timestamp}', ['as' => 'api.v1.apps.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_list'], 'uses' => 'HCAppsController@listUpdate']);
        Route::get('search', ['as' => 'api.v1.apps.search', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_list'], 'uses' => 'HCAppsController@listSearch']);
        Route::get('{id}', ['as' => 'api.v1.apps.single', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_list'], 'uses' => 'HCAppsController@getSingleRecord']);

        Route::post('{id}/duplicate', ['as' => 'api.v1.apps.duplicate', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_update'], 'uses' => 'HCAppsController@duplicate']);
        Route::post('restore', ['as' => 'api.v1.apps.restore', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_update'], 'uses' => 'HCAppsController@restore']);
        Route::post('merge', ['as' => 'api.v1.apps.merge', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_update'], 'uses' => 'HCAppsController@merge']);
        Route::post('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_create'], 'uses' => 'HCAppsController@create']);

        Route::put('{id}', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_update'], 'uses' => 'HCAppsController@update']);
        Route::put('{id}/strict', ['as' => 'api.v1.apps.update.strict', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_update'], 'uses' => 'HCAppsController@updateStrict']);

        Route::delete('{id}', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_delete'], 'uses' => 'HCAppsController@delete']);
        Route::delete('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_delete'], 'uses' => 'HCAppsController@delete']);
        Route::delete('{id}/force', ['as' => 'api.v1.apps.force', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_force_delete'], 'uses' => 'HCAppsController@forceDelete']);
        Route::delete('force', ['as' => 'api.v1.apps.force.multi', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_force_delete'], 'uses' => 'HCAppsController@forceDelete']);
    });
});
