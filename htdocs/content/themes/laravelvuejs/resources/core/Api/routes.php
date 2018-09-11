<?php

Route::get('status', 'APIController@status');

Route::group(['prefix' => '{locale}'], function () {
    Route::get('post/{arg}', 'PostController@show');

    Route::get('posts/category/{arg}', 'PostController@category');
    Route::get('posts/featured', 'FeaturedController@index');
    Route::get('posts', 'PostController@index');

    Route::get('search', 'SearchController@index');
});
