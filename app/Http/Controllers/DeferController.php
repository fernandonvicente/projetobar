<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use DataTables;
use Yajra\Datatables\Datatables;
use DB;

class DeferController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatabledefer()
    {

        
        //pegando os clientes do SAMOS via JSON
        $urlJson = 'http://talkradio.no-ip.info:8050/service/RestMethods.GenericServer/?parametros=cadastros|clientes|read||0|0||0|10&strjson=';

        $json_file = file_get_contents($urlJson);   
        $json_str = json_decode($json_file, true);
        $clients = $json_str['result'][0]['rows'];

        //echo ">>>".count($clients);
        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

        $pos = 1;
        foreach ($clients as $key => $clientAux) {

            if($clientAux['CLIENTES_TIPOCLIENTE']){
                if($clientAux['CLIENTES_TIPOCLIENTE']=='A')
                    $tipoCliente = 'Liberado';
                else if($clientAux['CLIENTES_TIPOCLIENTE']=='B')
                    $tipoCliente = 'Prospecção';
                else if($clientAux['CLIENTES_TIPOCLIENTE']=='C')
                    $tipoCliente = 'Bloqueado';
                else if($clientAux['CLIENTES_TIPOCLIENTE']=='D')
                    $tipoCliente = 'Inativo';
                else if($clientAux['CLIENTES_TIPOCLIENTE']=='E')
                    $tipoCliente = 'Gratuito';
                else if($clientAux['CLIENTES_TIPOCLIENTE']=='F')
                    $tipoCliente = 'Desligadas';
                else if($clientAux['CLIENTES_TIPOCLIENTE']=='G')
                    $tipoCliente = 'Parceria';
                else if($clientAux['CLIENTES_TIPOCLIENTE']=='H')
                    $tipoCliente = 'Midia';
                else if($clientAux['CLIENTES_TIPOCLIENTE']=='I')
                    $tipoCliente = 'Marca Musical';
                else if($clientAux['CLIENTES_TIPOCLIENTE']=='J')
                    $tipoCliente = 'Negociadas';
                else if($clientAux['CLIENTES_TIPOCLIENTE']=='L')
                    $tipoCliente = 'Temporário';
            }else{
                $tipoCliente = '';
            }

            if($clientAux['CLIENTES_ATIVO']=='T')
                $ativoCliente = 'Ativo';
            else
                $ativoCliente = 'Inativo';

           

            $clients[$key]['clientes_id'] = $clientAux['CLIENTES_ID'];
            $clients[$key]['clientes_nomedaradio'] = $clientAux['CLIENTES_NOMEDARADIO'];  
            $clients[$key]['clientes_cnpfcnpj'] = Mask('##.###.###/####-##',$clientAux['CLIENTES_CPFCNPJ']); 
            $clients[$key]['clientes_email'] = $clientAux['CLIENTES_EMAIL']; 
            $clients[$key]['clientes_tipocliente'] = $tipoCliente; 
            $clients[$key]['clientes_observacoes'] = $clientAux['CLIENTES_OBSERVACOES'];
            $clients[$key]['clientes_ativo'] = $ativoCliente;

            $pos++; 
        }

        //echo "<pre>";
        //print_r($clients);
            
        $clients = json_decode(json_encode($clients), FALSE);//convertendo array em objeto


    	return view('defer', compact('clients'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getdefer()
    {

        $users = new \Illuminate\Database\Eloquent\Collection;

//pegando os clientes do SAMOS via JSON
        $urlJson = 'http://talkradio.no-ip.info:8050/service/RestMethods.GenericServer/?parametros=cadastros|clientes|read||0|0||0|15&strjson=';

        //WEBHOOK

        $json_file = file_get_contents($urlJson);   
        $json_str = json_decode($json_file, true);
        $clients = $json_str['result'][0]['rows'];

        //echo ">>>".count($clients);
        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

       
        foreach ($clients as $key => $clientAux) {

            $users->push([
                'id'         => $clientAux['CLIENTES_ID'],
                'name'       => $clientAux['CLIENTES_NOMEDARADIO'],
                'cpf'      => 1,
                'genre' => 1,
                'action' => 2,
            ]); 



        }


        return Datatables::of($users)->make(true);
        //return response()->json($users);

        
    }



    public function select2()
    {
        $path = public_path();
        return view('select2', compact('path'));
    }


public function getselectbusca(Request $request)
    {
        $term = strtoupper($request->input('q'));
        
        $urlJson = 'http://talkradio.no-ip.info:8050/service/RestMethods.GenericServer/?parametros=cadastros|clientes|read|'.$term.'|2|0|0|0|10&strjson=';

        //WEBHOOK

        $json_file = file_get_contents($urlJson);   
        $json_str = json_decode($json_file, true);
        $clients = $json_str['result'][0]['rows'];

        //echo ">>>".count($clients);
        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

        $users = new \Illuminate\Database\Eloquent\Collection;

        foreach ($clients as $key => $clientAux) {

            $users->push([
                'CLIENTES_ID'         => $clientAux['CLIENTES_ID'],
                'CLIENTES_NOMEDARADIO'       => $clientAux['CLIENTES_NOMEDARADIO'],
            ]);



        }
      

        return response()->json($users);


    }

}


