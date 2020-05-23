<?php

    Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function(){Route::group(['middleware'=>'Login'],function(){ });

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            Route::get('/', function(){
                return view('layouts.dashboard.app');
            });

            //user route

            Route::resource('users','UserController')->except(['show']);


             //category route

             Route::resource('categories','CategoryController')->except(['show']);


             //product route

             Route::resource('products','ProductController')->except(['show']);



        });


    });




