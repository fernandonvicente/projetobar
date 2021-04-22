<?php

Auth::routes();

//Route::get('/area-cliente/logout', 'Auth\LoginController@logout');
Route::get('/home', 'Site\HomeController@index');


Route::get('/', 'Site\HomeController@index');
Route::get('', 'Site\HomeController@index');






Route::get('/consultCep/{cep}', ['as' => 'consultCep', 'uses' =>  'All\ConsultCepController@consultCep']);

Route::get('/getCities/{idState}', ['as' => 'getCities', 'uses' =>  'Site\CityController@getCities']);


//área restrita de cliente-----------------

Route::get('/cliente', 'Cliente\HomeController@index');
Route::get('/cliente/cadastro', 'Cliente\HomeController@cadastro');

Route::post('/cliente/login', 'Cliente\ClienteLoginController@login'); 



Route::get('/area-cliente/comandas', 'Cliente\ClienteLoginController@comandas'); 

Route::get('/area-cliente/comandas/carregaTabela', 'Cliente\ClienteLoginController@carregaTabela'); 

/*
Route::group(['middleware' => 'auth:cliente'], function () {
    Auth::routes();
    Route::get('/area-cliente/cardapio', 'Cliente\CardapioController@index'); 
    Route::get('/area-cliente/logout', 'Cliente\ClienteLoginController@destroy'); 
});
*/

//https://devignites.com/laravel-7-multi-authentication-tutorial/

//Route::prefix('/area-cliente')->name('area-cliente.')->namespace('Cliente')->group(function(){
  //All the admin routes will be defined here...
    Route::get('/area-cliente/cardapio', 'Cliente\CardapioController@index'); 
    Route::get('/area-cliente/logout', 'Cliente\ClienteLoginController@destroy'); 
//});


//área restrita de admin-----------------
Route::get('bayareaadmin/logout', 'Auth\LoginController@logout'); //logout do admin

Route::group(['prefix' => 'bayareaadmin', 'namespace' => 'Admin', 'as' => 'admin::', 'middleware' => 'auth'], function() {
     

    Route::get('/', [
        'uses' => 'AdminController@index', 'as' => 'home'
    ]);

    Route::get('/index2', [
        'uses' => 'AdminController@index2', 'as' => 'home2'
    ]);

    // User
    Route::group(['prefix' => 'user', 'as' => 'user.'], function() {        

        Route::get('/index', 'UserController@index');
        Route::get('/create', 'UserController@create');
        Route::post('/store', 'UserController@store');
        Route::get('/edit/{id}', 'UserController@edit');
        Route::post('/edit/{id}', 'UserController@update');
        Route::post('/update/{user}', 'UserController@update');
        Route::get('/delete/{id}', 'UserController@destroy');
        Route::get('/updateAvatar/{id}', 'UserController@updateAvatar');
        Route::get('/permission', 'UserController@permission');
        Route::get('/permission/role/{role}', 'UserController@permission');
        Route::post('/createProfilePermission', 'UserController@createProfilePermission');

    });


    // cardapio
    Route::group(['prefix' => 'cardapio', 'as' => 'cardapio.'], function() {

        Route::get('/index', 'CardapioController@indexajax');
        Route::get('/carregaTabela', 'CardapioController@carregaTabela');
        Route::get('/create', 'CardapioController@create');
        Route::get('/store', 'CardapioController@store');
        Route::post('/store', 'CardapioController@store');
        Route::get('/show/{id}', 'CardapioController@show');
        Route::get('/edit/{id}', 'CardapioController@edit');
        Route::post('/edit/{id}', 'CardapioController@update');
        Route::put('/update/{id}', 'CardapioController@update');
        Route::get('/delete/{id}', 'CardapioController@destroy');
        Route::get('/deleteItem/{id}', 'CardapioController@destroyItem');
        Route::get('/download/{file}', 'CardapioController@download');

    });


    // comanda
    Route::group(['prefix' => 'comanda', 'as' => 'comanda.'], function() {

        Route::get('/index', 'ComandaController@indexajax');
        Route::get('/carregaTabela', 'ComandaController@carregaTabela');
        Route::get('/create', 'ComandaController@create');
        Route::get('/store', 'ComandaController@store');
        Route::post('/store', 'ComandaController@store');

        Route::get('/edit/{id}', 'ComandaController@edit');
        Route::post('/edit/{id}', 'ComandaController@update');
        Route::put('/update/{id}', 'ComandaController@update');
        Route::get('/delete/{id}', 'ComandaController@destroy');
        Route::get('/deleteItem/{id}', 'ComandaController@destroyItem');
        Route::get('/download/{file}', 'ComandaController@download');

    });



    // despesas
    Route::group(['prefix' => 'despesa', 'as' => 'despesa.'], function() {

        Route::get('/index', 'DespesaController@indexajax');
        Route::get('/carregaTabela', 'DespesaController@carregaTabela');
        Route::get('/create', 'DespesaController@create');
        Route::get('/store', 'DespesaController@store');
        Route::post('/store', 'DespesaController@store');
        Route::get('/edit/{id}', 'DespesaController@edit');
        Route::post('/edit/{id}', 'DespesaController@update');
        Route::put('/update/{id}', 'DespesaController@update');
        Route::get('/delete/{id}', 'DespesaController@destroy');
        Route::get('/deleteItem/{id}', 'DespesaController@destroyItem');
        Route::get('/download/{file}', 'DespesaController@download');

    });



// clientes
    Route::group(['prefix' => 'cliente', 'as' => 'cliente.'], function() {
       
        Route::get('/index', 'ClienteController@indexajax');
        Route::get('/create', 'ClienteController@create');
        Route::get('/carregaTabela', 'ClienteController@carregaTabela');
        Route::post('/store', 'ClienteController@store');
        Route::get('/edit/{id}', 'ClienteController@edit');
        Route::post('/edit/{id}', 'ClienteController@update');
        Route::get('/delete/{id}', 'ClienteController@destroy');
 
    }); 



    
});
