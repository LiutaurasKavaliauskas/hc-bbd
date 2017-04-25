<?php

Route::group(['prefix' => 'api', 'middleware' => ['web', 'auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/posts/categories'], function ()
    {
        Route::get('/', ['as' => 'api.v1.posts.categories', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_categories_list'], 'uses' => 'posts\\HCPostsCategoriesController@listPage']);
        Route::get('list', ['as' => 'api.v1.posts.categories.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_categories_list'], 'uses' => 'posts\\HCPostsCategoriesController@list']);
        Route::get('list/{timestamp}', ['as' => 'api.v1.posts.categories.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_categories_list'], 'uses' => 'posts\\HCPostsCategoriesController@listUpdate']);
        Route::get('search', ['as' => 'api.v1.posts.categories.search', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_categories_list'], 'uses' => 'posts\\HCPostsCategoriesController@listSearch']);
        Route::get('{id}', ['as' => 'api.v1.posts.categories.single', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_categories_list'], 'uses' => 'posts\\HCPostsCategoriesController@getSingleRecord']);

        Route::post('{id}/duplicate', ['as' => 'api.v1.posts.categories.duplicate', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_categories_update'], 'uses' => 'posts\\HCPostsCategoriesController@duplicate']);
        Route::post('restore', ['as' => 'api.v1.posts.categories.restore', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_categories_update'], 'uses' => 'posts\\HCPostsCategoriesController@restore']);
        Route::post('merge', ['as' => 'api.v1.posts.categories.merge', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_categories_update'], 'uses' => 'posts\\HCPostsCategoriesController@merge']);
        Route::post('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_categories_create'], 'uses' => 'posts\\HCPostsCategoriesController@create']);

        Route::put('{id}', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_categories_update'], 'uses' => 'posts\\HCPostsCategoriesController@update']);
        Route::put('{id}/strict', ['as' => 'api.v1.posts.categories.update.strict', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_categories_update'], 'uses' => 'posts\\HCPostsCategoriesController@updateStrict']);

        Route::delete('{id}', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_categories_delete'], 'uses' => 'posts\\HCPostsCategoriesController@delete']);
        Route::delete('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_categories_delete'], 'uses' => 'posts\\HCPostsCategoriesController@delete']);
        Route::delete('{id}/force', ['as' => 'api.v1.posts.categories.force', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_categories_force_delete'], 'uses' => 'posts\\HCPostsCategoriesController@forceDelete']);
        Route::delete('force', ['as' => 'api.v1.posts.categories.force.multi', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_posts_posts_categories_force_delete'], 'uses' => 'posts\\HCPostsCategoriesController@forceDelete']);
    });
});
