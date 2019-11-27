<?php

Route::get('/test', function(){
    dd('hello');
});

Route::group(['namespace' => 'Neologicx\Newspkg\Http\Controllers'], function(){
    Route::resources([
        'newsCategory' => 'NewsCategoryController',
        'news' => 'NewsController'
    ]);
    Route::get('/newsCategory/destroy/{newsCategory}','NewsCategoryController@destroy');
    Route::get('/news/destroy/{news}','NewsController@destroy');
    Route::get('/allnews/{id}', 'NewsCategoryController@showallnews');
    Route::get('/newsstatus', 'NewsController@changenewsstatus');
});