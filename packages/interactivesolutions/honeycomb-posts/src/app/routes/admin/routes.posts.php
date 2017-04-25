<?php

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function ()
{
    Route::get('posts', ['as' => 'admin.posts.index', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_list'], 'uses' => 'HCPostsController@adminView']);

    Route::group(['prefix' => 'api/posts'], function ()
    {
        Route::get('/', ['as' => 'admin.api.posts', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_list'], 'uses' => 'HCPostsController@listPage']);
        Route::get('list', ['as' => 'admin.api.posts.list', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_list'], 'uses' => 'HCPostsController@list']);
        Route::get('list/{timestamp}', ['as' => 'admin.api.posts.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_list'], 'uses' => 'HCPostsController@listUpdate']);
        Route::get('search', ['as' => 'admin.api.posts.search', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_list'], 'uses' => 'HCPostsController@listSearch']);
        Route::get('{id}', ['as' => 'admin.api.posts.single', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_list'], 'uses' => 'HCPostsController@getSingleRecord']);

        Route::post('{id}/duplicate', ['as' => 'admin.api.posts.duplicate', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_update'], 'uses' => 'HCPostsController@duplicate']);
        Route::post('restore', ['as' => 'admin.api.posts.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_update'], 'uses' => 'HCPostsController@restore']);
        Route::post('merge', ['as' => 'admin.api.posts.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_update'], 'uses' => 'HCPostsController@merge']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_create'], 'uses' => 'HCPostsController@create']);

        Route::put('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_update'], 'uses' => 'HCPostsController@update']);
        Route::put('{id}/strict', ['as' => 'admin.api.posts.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_update'], 'uses' => 'HCPostsController@updateStrict']);

        Route::delete('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_delete'], 'uses' => 'HCPostsController@delete']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_delete'], 'uses' => 'HCPostsController@delete']);
        Route::delete('{id}/force', ['as' => 'admin.api.posts.force', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_force_delete'], 'uses' => 'HCPostsController@forceDelete']);
        Route::delete('force', ['as' => 'admin.api.posts.force.multi', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_force_delete'], 'uses' => 'HCPostsController@forceDelete']);
    });
});
