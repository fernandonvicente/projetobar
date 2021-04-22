<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Validator;
use Collection;
use Session;
use Cookie;
use DB;
use PDF;
use Hash;
use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\All\MailController;
use App\Http\Controllers\Controller;
use App\Models\All\State;
use App\Models\All\City;
use App\Models\All\Cliente;
/*
use App\Models\All\Plano;
use App\Models\All\ClientePlano;
use App\Models\All\ClientePlanoHistorico;
use App\Models\All\Representante;
use App\Models\All\ClienteHistorico;
use App\Models\All\ClienteStatus;
use App\Models\All\RoleUser;
use App\Models\All\ClienteEquipamento;
use App\Models\All\EquipamentoTipo;
use App\Models\All\ClienteInstalacaoFoto;
use App\Models\All\ClienteInstalacao;
use App\Models\All\ClientePagamento;
*/

use App\Models\View\ViewClientes;

use App\User;
use Carbon\Carbon;
use App\Funcoes\Funcoes;

use DataTables;

class ClienteController extends Controller
{
    private $mailController;

    private $stateModel;   
    
    private $qtRecordPage = 25;


    public function __construct(MailController $mailController){
      $this->mailController = $mailController;      
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function indexajax(Request $request)
    {
      //if(Gate::denies('view_consultores')) {
            //abort(404);
      //}

      set_time_limit(0);

      include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

      $title = 'Clientes';
      $pagAction = 'Lista';

      return view('admin.cliente.indexajax', compact('title','pagAction')); 
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      //if(Gate::denies('create_consultores')) {
            //abort(404);
      //}

      set_time_limit(0);

        $data = [    
               'cliente_id' => '',
               'documento' => '',
               'nome' => '', 
               'email' => '',
               'celular' => '',
        ]; 

        $title = 'Clientes';
        $pagAction = 'Cadastrar';

        return view('admin.cliente.create-edit', $data, compact('title','pagAction')); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        //if(Gate::denies('create_consultores')) {
              //abort(404);
        //}
        set_time_limit(0);

        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

        try{
            DB::beginTransaction(); 
            include_once(public_path() . '/assets/funcoes/funcoesGeral.php');                  

            $documento = (preg_replace('/\D+/', '', $request->input('documento')));

            $clienteInsert = Cliente::create([
                'documento'         => $documento,
                'nome'              => $request->input('nome'),
                'email'             => $request->input('email'),
                'celular'           => $request->input('celular'),
            ]);
                        
            if($clienteInsert){

                DB::commit();

                return response()->json([
                    'success'   => true,
                    'result' => $clienteInsert->id,
                ], 201);    

            }else{
              DB::rollBack();
                return response()->json([
                    'success'   => false,
                    'result' => $e->getMessage(),
                ]);
            }
        
        } 
        catch(\Exception $e){
            DB::rollBack();
              return response()->json([
                  'success'   => false,
                  'result' => $e->getMessage(),
              ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $tabFiltro = null)
    {

      /*
      if(Gate::denies('edit_consultores')) {
            abort(404);
      }

      if(Auth::user()->cliente_id){
        if(Auth::user()->cliente_id != $id)
          abort(404);
      }
      */


      set_time_limit(0);

      include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

      $cliente_id = '';
      $documento = '';
      $nome = '';
      $email = '';
      $celular = '';

      $objCliente = Cliente::find($id);
      if($objCliente){

        /*
        $documento = strlen($dadosInvest->documento) == 11 ? MaskUtils::mask($dadosInvest->documento, Mask::CPF) : MaskUtils::mask($dadosInvest->documento, Mask::CNPJ);
        */

        $cliente_id = $objCliente->id;
        $documento = Funcoes::mask($objCliente->documento, '###.###.###-##');
        $nome = $objCliente->nome;
        $email = $objCliente->email;
        $celular = $objCliente->celular;
      }

      $data = [    
             'cliente_id' => $cliente_id,
             'documento' => $documento,
             'nome' => $nome, 
             'email' => $email, 
             'celular' => $celular, 
      ];

      //echo "<pre>";
      //print_r($data);
      //exit();



      $title = 'Editar Cliente';
      $pagAction = 'Clientes';

      return view('admin.cliente.create-edit', $data, compact('title','pagAction'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      //if(Gate::denies('edit_consultores')) {
            //abort(404);
      //}

      set_time_limit(0);

        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

        try{
            DB::beginTransaction(); 

            $objCliente = Cliente::find($id);
            
            $documento = (preg_replace('/\D+/', '', $request->input('documento')));
            
            $clienteUpdate = $objCliente->update([
                'documento'         => $documento,
                'nome'              => $request->input('nome'),
                'email'             => $request->input('email'),
                'celular'           => $request->input('celular'),
            ]);            
                        
            if($clienteUpdate){
                DB::commit();

                return response()->json([
                        'success'   => true,
                        'result' => $id,
                    ], 201);     
            }else{
              DB::rollBack();
                return response()->json([
                        'success'   => false,
                        'result' => $e->getMessage(),
                    ]);
            }
        } 
        catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                        'success'   => false,
                        'result' => $e->getMessage(),
                    ]);
        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //if(Gate::denies('delete_consultores')) {
            //abort(404);
      //}

       $dataExclusao = date('Y-m-d H:i:s');
       try{
            DB::beginTransaction(); 
             $cliente = Cliente::find($id);
            
            if($cliente){            
           
              $clienteUpdate = $cliente->update([
                  'status'              => 'I',
              ]);

              if($clienteUpdate){  
               
                  DB::commit();

                  return response()->json([
                      'success'   => true,
                      'result' => $id,
                  ], 200);

              }
            }else{
              DB::rollBack();
                  return response()->json([
                      'success'   => false,
                      'result' => 'erro ao excluir registro',
                  ], 200);
            }
            
        } 
        catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                        'success'   => false,
                        'result' => $e->getMessage(),
                    ]);
        }
    }

  public function carregaTabela(Request $request)
  {
      //if(Gate::denies('view_consultores')) {
            //abort(404);
      //}

        set_time_limit(0);

        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');
        
        //if ($request->ajax()) {
        /*
            if(!Auth::user()->cliente_id)
              $query = ViewConsultores::where('status','Ativo')->orderBy('nome', 'asc')->get();  
            else
              $query = ViewConsultores::where('status','Ativo')
                                        ->where('id',Auth::user()->cliente_id)->orderBy('nome', 'asc')->get(); 
      */

              $query = ViewClientes::get();

            $data = DataTables::of($query)
                    ->addIndexColumn()
                    ->editColumn('documento', function ($data) {
                      $documento = '';
                      if($data->documento){
                         $documento = Funcoes::mask($data->documento, '###.###.###-##');
                      }

                      return $documento;
                    })
                    
                    ->addColumn('action', function($row){

                          $link = url("/bayareaadmin/cliente/edit").'/'.$row->id;
                          //$link2 = url("/grbrasiladmin/user/edit").'/'.$row->user_id;
                          //$link_imprimir = url("/grbrasiladmin/relatorio/consultor").'/'.$row->id;

                          $btn = '';


                           $btn .= '<a href="'.$link.'"><i class="fa fa-fw fa-edit" title="Editar Dados Cliente '.$row->nome.'"></i></a>';


                           $btn .= '<a href="javascript:void(0);" onclick="excluirRegistro('.$row->id.');"><i class="fa fa-fw fa-trash" style="color: #ff0000;" title="Excluir - '.$row->id.'"></i></a>';
                          


/*
                          if(!Gate::denies('edit_usuarios')) {
                            if($row->user_id){
                           $btn .= '<a href="'.$link2.'"><i class="fa fa-fw fa-user" title="Trocar Senha de Login do Consultor '.$row->nome.'"></i></a>';
                            } 
                          }
   
                          

                          if(!Gate::denies('edit_consultores')) {
                           $btn .= '<a href="'.$link_imprimir.'" target="_blank" ><i class="fa fa-fw fa-file-text-o" title="Imprimir Dados Consultor '.$row->nome.'"></i></a>';
                          }

                          if(!Gate::denies('delete_consultores')) {
                           $btn .= '<a href="javascript:void(0);" onclick="excluirRegistro('.$row->id.');"><i class="fa fa-fw fa-trash" style="color: #ff0000;" title="Excluir - '.$row->id.'"></i></a>';
                          }

                          if($row->email){
                            if(!Auth::user()->cliente_id){
                            $btn .= '<a href="javascript:void(0);" onclick="enviarTermo('.$row->id.');"><i class="fa fa-fw fa-send" style="color: #4caf50;" title="Enviar Termo de - '.$row->nome.'"></i></a>';
                            }
                          }else{
                            $btn .= '<a href="javascript:void(0);"><i class="fa fa-fw fa-send" style="color: #ffeb3b;" title="CONSULTOR SEM EMAIL DE ENVIO"></i></a>';
                          }
*/


                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        //}
      
        return $data;
    }

 
    public function checkDocumento($documento,$id)
    {

      if($id == 0){
        $qt = Cliente::where('documento',$documento)->where('status','Ativo')->count();

        return response()->json([
            'success'   => $qt == 0 ? true : false,
            'result' => $qt,
        ], 200);

      }else{
        $qt = Cliente::where('documento',$documento)->where('id','!=',$id)->count();

        return response()->json([
            'success'   => $qt == 0 ? true : false,
            'result' => $qt,
        ], 200);
      }

    }

}