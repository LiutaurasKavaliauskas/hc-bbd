<?php

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function ()
{
    Route::get('apps', ['as' => 'admin.apps.index', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_list'], 'uses' => 'HCAppsController@adminView']);

    Route::group(['prefix' => 'api/apps'], function ()
    {
        Route::get('/', ['as' => 'admin.api.apps', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_list'], 'uses' => 'HCAppsController@listPage']);
        Route::get('list', ['as' => 'admin.api.apps.list', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_list'], 'uses' => 'HCAppsController@list']);
        Route::get('list/{timestamp}', ['as' => 'admin.api.apps.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_list'], 'uses' => 'HCAppsController@listUpdate']);
        Route::get('search', ['as' => 'admin.api.apps.search', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_list'], 'uses' => 'HCAppsController@listSearch']);
        Route::get('{id}', ['as' => 'admin.api.apps.single', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_list'], 'uses' => 'HCAppsController@getSingleRecord']);

        Route::post('{id}/duplicate', ['as' => 'admin.api.apps.duplicate', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_update'], 'uses' => 'HCAppsController@duplicate']);
        Route::post('restore', ['as' => 'admin.api.apps.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_update'], 'uses' => 'HCAppsController@restore']);
        Route::post('merge', ['as' => 'admin.api.apps.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_update'], 'uses' => 'HCAppsController@merge']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_create'], 'uses' => 'HCAppsController@create']);

        Route::put('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_update'], 'uses' => 'HCAppsController@update']);
        Route::put('{id}/strict', ['as' => 'admin.api.apps.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_update'], 'uses' => 'HCAppsController@updateStrict']);

        Route::delete('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_delete'], 'uses' => 'HCAppsController@delete']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_delete'], 'uses' => 'HCAppsController@delete']);
        Route::delete('{id}/force', ['as' => 'admin.api.apps.force', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_force_delete'], 'uses' => 'HCAppsController@forceDelete']);
        Route::delete('force', ['as' => 'admin.api.apps.force.multi', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_force_delete'], 'uses' => 'HCAppsController@forceDelete']);
    });
});
