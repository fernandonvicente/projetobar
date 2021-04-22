<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

class HomeController extends Controller
{
	public function index(){
		//echo "login cliente";
		$title = 'Equipamentos';
      $pagAction = 'Lista';

      return view('cliente-comanda.index', compact('title','pagAction')); 
    } 

    public function cadastro(){
		//echo "login cliente";
		$title = 'Equipamentos';
      $pagAction = 'Lista';

      return view('cliente-comanda.cliente-cadastro', compact('title','pagAction')); 
    } 


    

}
