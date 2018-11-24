<?php

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function () {
    Route::group(['prefix'=>'bbsLable','namespace'=>'Bbs'],function(){
        //标签
        Route::get('list', 'BbsLableController@getList');
        Route::post('add', 'BbsLableController@postAdd');
        Route::post('edit', 'BbsLableController@postEdit');
    });

});