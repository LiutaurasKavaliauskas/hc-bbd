<?php

Route::get('language/change/{location}/{lang}', ['middleware' => 'web', 'as' => 'language.change', 'uses' => 'HCLanguagesController@changeLanguage']);