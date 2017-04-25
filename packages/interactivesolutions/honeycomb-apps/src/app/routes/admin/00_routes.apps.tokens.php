<?php

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function ()
{
    Route::get('apps/tokens', ['as' => 'admin.apps.tokens.index', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_tokens_list'], 'uses' => 'apps\\HCAppsTokensController@adminView']);

    Route::group(['prefix' => 'api/apps/tokens'], function ()
    {
        Route::get('/', ['as' => 'admin.api.apps.tokens', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_tokens_list'], 'uses' => 'apps\\HCAppsTokensController@listPage']);
        Route::get('list', ['as' => 'admin.api.apps.tokens.list', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_tokens_list'], 'uses' => 'apps\\HCAppsTokensController@list']);
        Route::get('list/{timestamp}', ['as' => 'admin.api.apps.tokens.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_tokens_list'], 'uses' => 'apps\\HCAppsTokensController@listUpdate']);
        Route::get('search', ['as' => 'admin.api.apps.tokens.search', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_tokens_list'], 'uses' => 'apps\\HCAppsTokensController@listSearch']);
        Route::get('{id}', ['as' => 'admin.api.apps.tokens.single', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_tokens_list'], 'uses' => 'apps\\HCAppsTokensController@getSingleRecord']);

        Route::post('{id}/duplicate', ['as' => 'admin.api.apps.tokens.duplicate', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_tokens_update'], 'uses' => 'apps\\HCAppsTokensController@duplicate']);
        Route::post('restore', ['as' => 'admin.api.apps.tokens.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_tokens_update'], 'uses' => 'apps\\HCAppsTokensController@restore']);
        Route::post('merge', ['as' => 'admin.api.apps.tokens.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_tokens_update'], 'uses' => 'apps\\HCAppsTokensController@merge']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_tokens_create'], 'uses' => 'apps\\HCAppsTokensController@create']);

        Route::put('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_tokens_update'], 'uses' => 'apps\\HCAppsTokensController@update']);
        Route::put('{id}/strict', ['as' => 'admin.api.apps.tokens.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_tokens_update'], 'uses' => 'apps\\HCAppsTokensController@updateStrict']);

        Route::delete('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_tokens_delete'], 'uses' => 'apps\\HCAppsTokensController@delete']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_tokens_delete'], 'uses' => 'apps\\HCAppsTokensController@delete']);
        Route::delete('{id}/force', ['as' => 'admin.api.apps.tokens.force', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_tokens_force_delete'], 'uses' => 'apps\\HCAppsTokensController@forceDelete']);
        Route::delete('force', ['as' => 'admin.api.apps.tokens.force.multi', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_tokens_force_delete'], 'uses' => 'apps\\HCAppsTokensController@forceDelete']);
    });
});
