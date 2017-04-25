<?php

Route::get('pages/{langCode?}/{slug?}', ['middleware' => ['web'], 'uses' => 'HCPagesFrontEndController@showData']);
