<?php

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function ()
{
    Route::get('languages', ['as' => 'admin.languages', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@adminView']);

    Route::group(['prefix' => 'api/languages'], function ()
    {
        Route::get('/', ['as' => 'admin.api.languages', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@listPage']);
        Route::get('list/{timestamp}', ['as' => 'admin.api.languages.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@listUpdate']);
        Route::get('list', ['as' => 'admin.api.languages.list', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@list']);
        Route::get('search', ['as' => 'admin.api.languages.search', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@listSearch']);
        Route::put('{id}/strict', ['as' => 'admin.api.languages.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_languages_languages_update'], 'uses' => 'HCLanguagesController@updateStrict']);
    });
});
