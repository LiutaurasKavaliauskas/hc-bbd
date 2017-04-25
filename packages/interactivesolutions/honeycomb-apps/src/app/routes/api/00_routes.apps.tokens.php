<?php

Route::group(['prefix' => 'api', 'middleware' => ['web', 'auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/apps/tokens'], function ()
    {
        Route::get('/', ['as' => 'api.v1.apps.tokens', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_tokens_list'], 'uses' => 'apps\\HCAppsTokensController@listPage']);
        Route::get('list', ['as' => 'api.v1.apps.tokens.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_tokens_list'], 'uses' => 'apps\\HCAppsTokensController@list']);
        Route::get('list/{timestamp}', ['as' => 'api.v1.apps.tokens.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_apps_apps_tokens_list'], 'uses' => 'apps\\HCAppsTokensController@listUpdate']);
        Route::get('search', ['as' => 'api.v1.apps.tokens.search', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_tokens_list'], 'uses' => 'apps\\HCAppsTokensController@listSearch']);
        Route::get('{id}', ['as' => 'api.v1.apps.tokens.single', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_tokens_list'], 'uses' => 'apps\\HCAppsTokensController@getSingleRecord']);

        Route::post('{id}/duplicate', ['as' => 'api.v1.apps.tokens.duplicate', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_tokens_update'], 'uses' => 'apps\\HCAppsTokensController@duplicate']);
        Route::post('restore', ['as' => 'api.v1.apps.tokens.restore', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_tokens_update'], 'uses' => 'apps\\HCAppsTokensController@restore']);
        Route::post('merge', ['as' => 'api.v1.apps.tokens.merge', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_tokens_update'], 'uses' => 'apps\\HCAppsTokensController@merge']);
        Route::post('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_tokens_create'], 'uses' => 'apps\\HCAppsTokensController@create']);

        Route::put('{id}', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_tokens_update'], 'uses' => 'apps\\HCAppsTokensController@update']);
        Route::put('{id}/strict', ['as' => 'api.v1.apps.tokens.update.strict', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_tokens_update'], 'uses' => 'apps\\HCAppsTokensController@updateStrict']);

        Route::delete('{id}', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_tokens_delete'], 'uses' => 'apps\\HCAppsTokensController@delete']);
        Route::delete('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_tokens_delete'], 'uses' => 'apps\\HCAppsTokensController@delete']);
        Route::delete('{id}/force', ['as' => 'api.v1.apps.tokens.force', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_tokens_force_delete'], 'uses' => 'apps\\HCAppsTokensController@forceDelete']);
        Route::delete('force', ['as' => 'api.v1.apps.tokens.force.multi', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_apps_apps_tokens_force_delete'], 'uses' => 'apps\\HCAppsTokensController@forceDelete']);
    });
});
