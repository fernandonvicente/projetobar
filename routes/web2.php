<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/



Auth::routes();

Route::get('logout', [
    'uses' => 'Auth\LoginController@logout',
    'as' => 'logout',
]);


//-------------rotas de teste-----------------------------------------------------------------------------

//-------------rotas do front-----------------------------------------------------------------------------
Route::get('/consultCep/{cep}', ['as' => 'consultCep', 'uses' =>  'All\ConsultCepController@consultCep']);

Route::get('/getCities/{idState}', ['as' => 'getCities', 'uses' =>  'Site\CityController@getCities']);








/*---------------------- rotas do admin -----------------------------------------*/

/* 'namespace' => 'Admin'*/
/* ,'middleware' => 'auth' --- para autenticar*/
//Route::group(['prefix' => 'ppaadmin', 'namespace' => 'Admin', 'as' => 'admin::', 'middleware' => 'auth'], function() {

Route::group(['prefix' => 'bayareaadmin', 'namespace' => 'Admin', 'as' => 'admin::', 'middleware' => 'auth'], function() {
     

    Route::get('/', [
        'uses' => 'AdminController@index', 'as' => 'home'
    ]);
    // User
    Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
        Route::get('/index', [
            'uses' => 'UserController@index', 'as' => 'index',
        ]);
        Route::get('/create', [
            'uses' => 'UserController@create', 'as' => 'create',
        ]);
        Route::post('/store', [
            'uses' => 'UserController@store', 'as' => 'store',
        ]);
        Route::get('/edit/{id}', [
            'uses' => 'UserController@edit', 'as' => 'edit',
        ]);        
        Route::post('/edit/{id}', [
            'uses' => 'UserController@update', 'as' => 'update',
        ]);
        Route::put('/update/{user}', [
            'uses' => 'UserController@update', 'as' => 'update',
        ]);
        Route::get('/delete/{id}', [
            'uses' => 'UserController@destroy', 'as' => 'destroy',
        ]);
        Route::get('/updateAvatar/{id}', [
            'uses' => 'UserController@updateAvatar', 'as' => 'updateAvatar',
        ]);
        Route::get('/permission', [
            'uses' => 'UserController@permission', 'as' => 'permission',
        ]);
        Route::get('/permission/role/{role}', [
            'uses' => 'UserController@permission', 'as' => 'permission',
        ]);
        Route::post('/createProfilePermission', [
            'uses' => 'UserController@createProfilePermission', 'as' => 'createProfilePermission',
        ]);

    });


    // Planilha
    Route::group(['prefix' => 'planilha', 'as' => 'planilha.'], function() {
        Route::get('/index', [
            'uses' => 'PlanilhaController@index', 'as' => 'index',
        ]);
        Route::get('/create', [
            'uses' => 'PlanilhaController@create', 'as' => 'create',
        ]);
        
        Route::post('/store', [
            'uses' => 'PlanilhaController@store', 'as' => 'store',
        ]);
        /*
        Route::get('/edit/{id}', [
            'uses' => 'UserController@edit', 'as' => 'edit',
        ]);
        Route::post('/edit/{id}', [
            'uses' => 'UserController@update', 'as' => 'update',
        ]);
        Route::put('/update/{user}', [
            'uses' => 'UserController@update', 'as' => 'update',
        ]);
        Route::get('/delete/{id}', [
            'uses' => 'UserController@destroy', 'as' => 'destroy',
        ]);
        Route::get('/updateAvatar/{id}', [
            'uses' => 'UserController@updateAvatar', 'as' => 'updateAvatar',
        ]);
        Route::get('/permission', [
            'uses' => 'UserController@permission', 'as' => 'permission',
        ]);
        Route::get('/permission/role/{role}', [
            'uses' => 'UserController@permission', 'as' => 'permission',
        ]);
        Route::post('/createProfilePermission', [
            'uses' => 'UserController@createProfilePermission', 'as' => 'createProfilePermission',
        ]);*/

    });

    // Plano
    Route::group(['prefix' => 'plano', 'as' => 'plano.'], function() {
        Route::get('/index', [
            'uses' => 'PlanoController@indexajax', 'as' => 'index',
        ]);
         Route::get('/carregaTabela', [
            'uses' => 'PlanoController@carregaTabela', 'as' => 'carregaTabela',
        ]);  
        Route::get('/create', [
            'uses' => 'PlanoController@create', 'as' => 'create',
        ]);
        Route::post('/store', [
            'uses' => 'PlanoController@store', 'as' => 'store',
        ]);
        Route::get('/edit/{id}', [
            'uses' => 'PlanoController@edit', 'as' => 'edit',
        ]);
        Route::post('/edit/{id}', [
            'uses' => 'PlanoController@update', 'as' => 'update',
        ]);
        Route::put('/update/{user}', [
            'uses' => 'PlanoController@update', 'as' => 'update',
        ]);
        Route::get('/delete/{id}', [
            'uses' => 'PlanoController@destroy', 'as' => 'destroy',
        ]);
      

    });

    // Equipamento
    Route::group(['prefix' => 'equipamento', 'as' => 'equipamento.'], function() {
        Route::get('/index', [
            'uses' => 'EquipamentoController@indexajax', 'as' => 'index',
        ]);
         Route::get('/carregaTabela', [
            'uses' => 'EquipamentoController@carregaTabela', 'as' => 'carregaTabela',
        ]);  
        Route::get('/create', [
            'uses' => 'EquipamentoController@create', 'as' => 'create',
        ]);
        Route::post('/store', [
            'uses' => 'EquipamentoController@store', 'as' => 'store',
        ]);
        Route::get('/edit/{id}', [
            'uses' => 'EquipamentoController@edit', 'as' => 'edit',
        ]);
        Route::post('/edit/{id}', [
            'uses' => 'EquipamentoController@update', 'as' => 'update',
        ]);
        Route::put('/update/{user}', [
            'uses' => 'EquipamentoController@update', 'as' => 'update',
        ]);
        Route::get('/delete/{id}', [
            'uses' => 'EquipamentoController@destroy', 'as' => 'destroy',
        ]);
      

    });


// clientes
    Route::group(['prefix' => 'cliente', 'as' => 'cliente.'], function() {
       
        Route::get('/index', [
            'uses' => 'ClienteController@indexajax', 'as' => 'index',
        ]);  
        Route::get('/carregaTabela', [
            'uses' => 'ClienteController@carregaTabela', 'as' => 'carregaTabela',
        ]);  
        Route::get('/carregaTabelaPlano/{clienteId}', [
            'uses' => 'ClienteController@carregaTabelaPlano', 'as' => 'carregaTabelaPlano',
        ]); 
        Route::get('/carregaTabelaPagamento/{clienteId}', [
            'uses' => 'ClienteController@carregaTabelaPagamento', 'as' => 'carregaTabelaPagamento',
        ]);  
        Route::get('/carregaTabelaEquipamento/{clienteId}', [
            'uses' => 'ClienteController@carregaTabelaEquipamento', 'as' => 'carregaTabelaEquipamento',
        ]);  
        Route::get('/create', [
            'uses' => 'ClienteController@create', 'as' => 'create',
        ]);        
        Route::post('/store', [
            'uses' => 'ClienteController@store', 'as' => 'store',
        ]);
        Route::post('/storeClientePlano', [
            'uses' => 'ClienteController@storeClientePlano', 'as' => 'storeClientePlano',
        ]);
        Route::post('/storeClienteEquipamento', [
            'uses' => 'ClienteController@storeClienteEquipamento', 'as' => 'storeClienteEquipamento',
        ]);
        Route::post('/storeClientePagamento', [
            'uses' => 'ClienteController@storeClientePagamento', 'as' => 'storeClientePagamento',
        ]);
        Route::post('/storeFile', [
            'uses' => 'ClienteController@storeFile', 'as' => 'storeFile',
        ]);
        Route::post('/storeFinanceiro', [
            'uses' => 'ClienteController@storeFinanceiro', 'as' => 'storeFinanceiro',
        ]);
        Route::get('/edit/{id}', [
            'uses' => 'ClienteController@edit', 'as' => 'edit',
        ]);
        Route::get('/edit/{id}/{tab}', [
            'uses' => 'ClienteController@edit', 'as' => 'editTab',
        ]);
        Route::post('/edit/{id}', [
            'uses' => 'ClienteController@update', 'as' => 'update',
        ]);
        Route::put('/update/{user}', [
            'uses' => 'ClienteController@update', 'as' => 'update',
        ]);
        Route::get('/delete/{id}', [
            'uses' => 'ClienteController@destroy', 'as' => 'destroy',
        ]);
        Route::post('/deleteClientePlano', [
            'uses' => 'ClienteController@deleteClientePlano', 'as' => 'deleteClientePlano',
        ]); 
        Route::post('/deleteClientePagamento', [
            'uses' => 'ClienteController@deleteClientePagamento', 'as' => 'deleteClientePagamento',
        ]);  
        Route::get('/showClientePagamento/{id}', [
            'uses' => 'ClienteController@showClientePagamento', 'as' => 'showClientePagamento',
        ]);  
        Route::post('/deleteClienteEquipamento', [
            'uses' => 'ClienteController@deleteClienteEquipamento', 'as' => 'deleteClientEquipamento',
        ]); 
        Route::get('/motivoExclusaoEquipamento/{id}', [
            'uses' => 'ClienteController@motivoExclusaoEquipamento', 'as' => 'motivoExclusaoEquipamento',
        ]);
        Route::get('/motivoExclusaoPlano/{id}', [
            'uses' => 'ClienteController@motivoExclusaoPlano', 'as' => 'motivoExclusaoPlano',
        ]);
        Route::get('/deleteArquivo/{id}', [
            'uses' => 'ClienteController@deleteArquivo', 'as' => 'deleteArquivo',
        ]); 
        Route::post('/salvarImagem', [
            'uses' => 'ClienteController@salvarImagem', 'as' => 'salvarImagem',
        ]); 
        Route::get('/deletarImagem/{id}', [
            'uses' => 'ClienteController@deletarImagem', 'as' => 'deletarImagem',
        ]); 
        Route::post('/salvarInstacao', [
            'uses' => 'ClienteController@salvarInstacao', 'as' => 'salvarInstacao',
        ]);
 
    }); 


// representantes
    Route::group(['prefix' => 'representante', 'as' => 'representante.'], function() {
      
        Route::get('/index', [
            'uses' => 'RepresentanteController@indexajax', 'as' => 'index',
        ]);  
        Route::get('/carregaTabela', [
            'uses' => 'RepresentanteController@carregaTabela', 'as' => 'carregaTabela',
        ]);      
        Route::get('/create', [
            'uses' => 'RepresentanteController@create', 'as' => 'create',
        ]);
       
        Route::post('/store', [
            'uses' => 'RepresentanteController@store', 'as' => 'store',
        ]);
        Route::get('/edit/{id}', [
            'uses' => 'RepresentanteController@edit', 'as' => 'edit',
        ]);
        Route::post('/edit/{id}', [
            'uses' => 'RepresentanteController@update', 'as' => 'update',
        ]);
        Route::put('/update/{user}', [
            'uses' => 'RepresentanteController@update', 'as' => 'update',
        ]);
        Route::get('/delete/{id}', [
            'uses' => 'RepresentanteController@destroy', 'as' => 'destroy',
        ]);  
        Route::get('/deleteArquivo/{id}', [
            'uses' => 'RepresentanteController@deleteArquivo', 'as' => 'deleteArquivo',
        ]);  
        Route::post('/edit/financeiro/{id}', [
            'uses' => 'RepresentanteController@updateFinanceiro', 'as' => 'updateFinanceiro',
        ]);
        Route::get('/checkDocumento/{documento}/{consultor_id}', [
            'uses' => 'RepresentanteController@checkDocumento', 'as' => 'checkDocumento',
        ]);
         Route::post('/edit/instalacao/{id}', [
            'uses' => 'RepresentanteController@updateInstalacao', 'as' => 'updateInstalacao',
        ]);
       

    });


/*
    // relatorios
    Route::group(['prefix' => 'relatorio', 'as' => 'relatorio.'], function() {

        Route::get('/consultor/{id}', [
            'uses' => 'RelatorioController@relatConsultor', 'as' => 'consultor',
        ]); 

        Route::get('/cliente/{id}', [
            'uses' => 'RelatorioController@relatCliente', 'as' => 'cliente',
        ]); 
       
        Route::get('/consultores', [
            'uses' => 'RelatorioController@relatConsultorAjax', 'as' => 'consultores',
        ]);  
        Route::get('/carregaTabelaConsultor', [
            'uses' => 'RelatorioController@carregaTabelaConsultor', 'as' => 'carregaTabelaConsultor',
        ]);   

        Route::get('/clientes', [
            'uses' => 'RelatorioController@relatClienteAjax', 'as' => 'clientes',
        ]);  
        Route::get('/carregaTabelaCliente', [
            'uses' => 'RelatorioController@carregaTabelaCliente', 'as' => 'carregaTabelaCliente',
        ]);  

        Route::get('/clientes-contratos-sim', [
            'uses' => 'RelatorioController@relatClienteContratosSimAjax', 'as' => 'clientesContratosSim',
        ]);  
        Route::get('/carregaTabelaClienteContratosSim', [
            'uses' => 'RelatorioController@carregaTabelaClienteContratosSim', 'as' => 'carregaTabelaClienteContratosSim',
        ]);  

        Route::get('/clientes-contratos-nao', [
            'uses' => 'RelatorioController@relatClienteContratosNaoAjax', 'as' => 'clientesContratosNao',
        ]);  
        Route::get('/carregaTabelaClienteContratosNao', [
            'uses' => 'RelatorioController@carregaTabelaClienteContratosNao', 'as' => 'carregaTabelaClienteContratosNao',
        ]); 

        

    });*/


    
});
Auth::routes();

//Route::get('/home', 'HomeController@index');



Auth::routes();

//Route::get('/home', 'HomeController@index');
Route::get('/home', [
    'uses' => 'Admin\AdminController@index', 'as' => 'home'
]);
