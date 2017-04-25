<?php

//honeycomb-posts/src/app/routes/admin/routes.posts.categories.php


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


//honeycomb-posts/src/app/routes/admin/routes.posts.php


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


//honeycomb-posts/src/app/routes/api/routes.posts.categories.php


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


//honeycomb-posts/src/app/routes/api/routes.posts.php


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


//honeycomb-posts/src/app/routes/front-end/routes.posts.php


Route::get('blog/{langCode?}/{slug?}', ['middleware' => ['web'], 'uses' => 'HCPostsFrontEndController@showBlog']);
Route::get('posts/{langCode?}/{slug?}', ['as' => 'posts', 'middleware' => ['web'], 'uses' => 'HCPostsFrontEndController@showPost']);

