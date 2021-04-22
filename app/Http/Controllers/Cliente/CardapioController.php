<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\All\Cliente;
use Mail;
use Auth;
use DB;

class CardapioController extends Controller
{
	
  public function index(Request $request)
  {

  	set_time_limit(0);
  	include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

  	//echo Auth::guard('area-cliente')->user()->email;
  	

    //echo "login cliente";
    $title = 'Cardápio';
    $pagAction = 'Lista';

    $lista_cardapio_com_estoque = DB::select("call procedure_cardapio_com_estoque()");


    $arrayLista = Array();
    foreach ($lista_cardapio_com_estoque as $key => $value) {
    	$arrayLista[$key]['produto'] = $value->produto;
    	$arrayLista[$key]['categoria'] = $value->nome_categoria;
    	$preco_venda = $value->preco_promocao == '' ? $value->preco_venda : $value->preco_promocao;
    	$arrayLista[$key]['preco'] = number_format($preco_venda, 2, ',', '.');	
    }

    $lista_cardapio_com_estoque = json_decode(json_encode($arrayLista), FALSE);//convertendo array em objeto
     

	$data = [    
	    'lista_cardapio_com_estoque' => $lista_cardapio_com_estoque,
	]; 
 

    return view('area-cliente.cardapio', $data, compact('title','pagAction')); 

  } 


  
  

}