<?php

Route::get('/', function () {
    return 'Home';
});

Route::get('/usuarios', 'UserController@index');
Route::get('/usuarios/{id}', 'UserController@show')
    ->where('id', '\d+');
Route::get('/usuarios/nuevo', 'UserController@create');
Route::get('/usuarios/{id}/edit', 'UserController@edit')
    ->where(['id' => '\d+']);

Route::get('/usuario/{name}/{nickname}', 'WelcomeUserController@withNickname');
Route::get('/usuario/{name}', 'WelcomeUserController@withoutNickname');

