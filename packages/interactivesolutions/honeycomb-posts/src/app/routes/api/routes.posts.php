<?php

Route::group(['prefix' => 'api', 'middleware' => ['web', 'auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/posts'], function ()
    {
        Route::get('/', ['as' => 'api.v1.posts', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_list'], 'uses' => 'HCPostsController@listPage']);
        Route::get('list', ['as' => 'api.v1.posts.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_list'], 'uses' => 'HCPostsController@list']);
        Route::get('list/{timestamp}', ['as' => 'api.v1.posts.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_list'], 'uses' => 'HCPostsController@listUpdate']);
        Route::get('search', ['as' => 'api.v1.posts.search', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_list'], 'uses' => 'HCPostsController@listSearch']);
        Route::get('{id}', ['as' => 'api.v1.posts.single', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_list'], 'uses' => 'HCPostsController@getSingleRecord']);

        Route::post('{id}/duplicate', ['as' => 'api.v1.posts.duplicate', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_update'], 'uses' => 'HCPostsController@duplicate']);
        Route::post('restore', ['as' => 'api.v1.posts.restore', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_update'], 'uses' => 'HCPostsController@restore']);
        Route::post('merge', ['as' => 'api.v1.posts.merge', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_update'], 'uses' => 'HCPostsController@merge']);
        Route::post('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_create'], 'uses' => 'HCPostsController@create']);

        Route::put('{id}', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_update'], 'uses' => 'HCPostsController@update']);
        Route::put('{id}/strict', ['as' => 'api.v1.posts.update.strict', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_update'], 'uses' => 'HCPostsController@updateStrict']);

        Route::delete('{id}', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_delete'], 'uses' => 'HCPostsController@delete']);
        Route::delete('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_delete'], 'uses' => 'HCPostsController@delete']);
        Route::delete('{id}/force', ['as' => 'api.v1.posts.force', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_force_delete'], 'uses' => 'HCPostsController@forceDelete']);
        Route::delete('force', ['as' => 'api.v1.posts.force.multi', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_force_delete'], 'uses' => 'HCPostsController@forceDelete']);
    });
});
