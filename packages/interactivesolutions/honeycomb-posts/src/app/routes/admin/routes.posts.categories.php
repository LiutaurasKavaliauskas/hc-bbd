<?php

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function ()
{
    Route::get('posts/categories', ['as' => 'admin.posts.categories.index', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_categories_list'], 'uses' => 'posts\\HCPostsCategoriesController@adminView']);

    Route::group(['prefix' => 'api/posts/categories'], function ()
    {
        Route::get('/', ['as' => 'admin.api.posts.categories', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_categories_list'], 'uses' => 'posts\\HCPostsCategoriesController@listPage']);
        Route::get('list', ['as' => 'admin.api.posts.categories.list', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_categories_list'], 'uses' => 'posts\\HCPostsCategoriesController@list']);
        Route::get('list/{timestamp}', ['as' => 'admin.api.posts.categories.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_categories_list'], 'uses' => 'posts\\HCPostsCategoriesController@listUpdate']);
        Route::get('search', ['as' => 'admin.api.posts.categories.search', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_categories_list'], 'uses' => 'posts\\HCPostsCategoriesController@listSearch']);
        Route::get('{id}', ['as' => 'admin.api.posts.categories.single', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_categories_list'], 'uses' => 'posts\\HCPostsCategoriesController@getSingleRecord']);

        Route::post('{id}/duplicate', ['as' => 'admin.api.posts.categories.duplicate', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_categories_update'], 'uses' => 'posts\\HCPostsCategoriesController@duplicate']);
        Route::post('restore', ['as' => 'admin.api.posts.categories.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_categories_update'], 'uses' => 'posts\\HCPostsCategoriesController@restore']);
        Route::post('merge', ['as' => 'admin.api.posts.categories.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_categories_update'], 'uses' => 'posts\\HCPostsCategoriesController@merge']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_categories_create'], 'uses' => 'posts\\HCPostsCategoriesController@create']);

        Route::put('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_categories_update'], 'uses' => 'posts\\HCPostsCategoriesController@update']);
        Route::put('{id}/strict', ['as' => 'admin.api.posts.categories.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_categories_update'], 'uses' => 'posts\\HCPostsCategoriesController@updateStrict']);

        Route::delete('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_categories_delete'], 'uses' => 'posts\\HCPostsCategoriesController@delete']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_categories_delete'], 'uses' => 'posts\\HCPostsCategoriesController@delete']);
        Route::delete('{id}/force', ['as' => 'admin.api.posts.categories.force', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_categories_force_delete'], 'uses' => 'posts\\HCPostsCategoriesController@forceDelete']);
        Route::delete('force', ['as' => 'admin.api.posts.categories.force.multi', 'middleware' => ['acl:interactivesolutions_honeycomb_posts_posts_categories_force_delete'], 'uses' => 'posts\\HCPostsCategoriesController@forceDelete']);
    });
});
