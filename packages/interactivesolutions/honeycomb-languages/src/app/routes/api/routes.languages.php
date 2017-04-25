<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::get('languages', ['as' => 'api.languages', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@adminView']);

    Route::group(['prefix' => 'v1/languages'], function ()
    {
        Route::get('/', ['as' => 'api.v1.api.languages', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@listPage']);
        Route::get('list/{timestamp}', ['as' => 'api.v1.api.languages.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@listUpdate']);
        Route::get('list', ['as' => 'api.v1.api.languages.list', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@list']);
        Route::get('search', ['as' => 'api.v1.api.languages.search', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_languages_languages_list'], 'uses' => 'HCLanguagesController@listSearch']);
        Route::put('{id}/strict', ['as' => 'api.v1.api.languages.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_languages_languages_update'], 'uses' => 'HCLanguagesController@updateStrict']);
    });
});
