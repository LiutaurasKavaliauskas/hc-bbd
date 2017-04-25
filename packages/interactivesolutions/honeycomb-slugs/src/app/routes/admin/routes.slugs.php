<?php

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
    Route::get('slugs', ['as' => 'admin.slugs', 'middleware' => ['acl:interactivesolutions_honeycomb_slugs_slugs_list'], 'uses' => 'HCSlugsController@adminView']);

    Route::group(['prefix' => 'api/slugs'], function () {
        Route::get('/', ['as' => 'admin.api.slugs', 'middleware' => ['acl:interactivesolutions_honeycomb_slugs_slugs_list'], 'uses' => 'HCSlugsController@listPage']);
        Route::get('list/{timestamp}', ['as' => 'admin.api.slugs.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_slugs_slugs_list'], 'uses' => 'HCSlugsController@listUpdate']);
        Route::get('list', ['as' => 'admin.api.slugs.list', 'middleware' => ['acl:interactivesolutions_honeycomb_slugs_slugs_list'], 'uses' => 'HCSlugsController@list']);
        Route::get('search', ['as' => 'admin.api.slugs.search', 'middleware' => ['acl:interactivesolutions_honeycomb_slugs_slugs_list'], 'uses' => 'HCSlugsController@search']);
    });
});
