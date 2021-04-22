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
use App\Models\All\Representante;
use App\Models\All\RepresentanteHistorico;
use App\Models\All\Banco;
use App\Models\All\RoleUser;

use App\Models\View\ViewRepresentantes;

use App\User;

use Datatables;

class RepresentanteController extends Controller
{
    private $mailController;

    private $stateModel;   
    
    private $qtRecordPage = 25;

    public $tipoPessoa = [
      'F' => 'Física',
      'J' => 'Jurídica',
    ];

    public $sim_e_nao = [
      'S' => 'SIM',
      'N' => 'NÃO',
    ];

    public $tipoConta = [
      'CC' => 'Conta Corrente',
      'CP' => 'Poupança',
    ];

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

      $title = 'Representantes';
      $pagAction = 'Lista';

      return view('admin.representante.indexajax', compact('title','pagAction')); 
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

      $states = State::get();
      $states = $states->pluck('name', 'uf')->toArray();
      //-------------------------------------------------------
      $bancos = Banco::get();
      $bancos = $bancos->pluck('banco', 'id')->toArray();
      //-------------------------------------------------------
      $cities = [];

      $listsArrayFiles = [];

      //---------------------------------------------------------------------
      $listsArrayFiles = Array();

        $data = [    
               'representante_id' => '',
               'documento' => '',
               'nome' => '', 
               'contato' => '',
               'email' => '',                            
               'states' => $states,
               'checkedState' => '',
               'tipoPessoa' => $this->tipoPessoa,
               'checkedTipoPessoa' => '',
               'tipoConta' => $this->tipoConta,
               'checkedTipo_1_conta' => '',
               'checkedTipo_2_conta' => '',
               'bancos' => $bancos,
               'checkedTipo_1_codbanco' => '',
               'checkedTipo_2_codbanco' => '',               
               'banco_1_agencia' => '',
               'banco_2_agencia' => '',
               'banco_1_conta' => '',
               'banco_2_conta' => '',
               'banco_1_documento' => '',
               'banco_2_documento' => '',
               'dia_pagamento' => '',
               'cities' => $cities,
               'checkedCity' => '',
               'telefone' => '',
               'celular' => '',
               'celular1' => '',
               'cep' => '',
               'endereco' => '',
               'bairro' => '',
               'num' => '',
               'complemento' => '',    
               'arquivo' => '',
               'observacao' => '',         
               'totalAnexo' => '',  
               'listsArrayFiles' => $listsArrayFiles,   
        ]; 

        $title = 'Representante';
        $pagAction = 'Cadastrar';

        return view('admin.representante.create-edit', $data, compact('title','pagAction')); 

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
            
            $fileName = '';
            $documento = (preg_replace('/\D+/', '', $request->input('cpfcnpj')));

            //DB::enableQueryLog();

            $objEstado = State::where('uf',$request->input('state'))->get()->first();

            $objCidade = City::where('state_id',$objEstado->id)
                              ->where('name',$request->input('city'))
                              ->get()->first();           

            $representanteInsert = Representante::create([
                'tipo_pessoa'       => strlen($documento) > 11 ? 'J' : 'F',
                'documento'         => $documento,
                'nome'              => $request->input('nome'),
                'contato'           => $request->input('contato'),
                'email'             => $request->input('email'),
                'telefone'          => $request->input('telefone'),
                'celular'           => $request->input('celular'),
                'celular1'           => $request->input('celular1'),
                'cep'               => $request->input('cep'),
                'endereco'          => $request->input('endereco'),
                'num'               => $request->input('num'),
                'complemento'       => $request->input('complemento'),
                'bairro'            => $request->input('bairro'),
                'uf'                => $objEstado->id,
                'cidade'            => $objCidade->id,
                'status'            => 'Ativo',
            ]);
            
            $insertedId = $representanteInsert->id;
            
            if($insertedId){

                DB::commit();

                //Cadastra historicos
                $this->representanteHistorico($insertedId);

                //criando usuario para representante
                $this->criarUsuario($insertedId,$request->input('password'));

                return response()->json([
                    'success'   => true,
                    'result' => $insertedId,
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
    public function edit($id)
    {

      /*
      if(Gate::denies('edit_consultores')) {
            abort(404);
      }

      if(Auth::user()->representante_id){
        if(Auth::user()->representante_id != $id)
          abort(404);
      }
      */


      set_time_limit(0);

      include_once(public_path() . '/assets/funcoes/funcoesGeral.php');


      $objRepresentante = Representante::find($id);

      $objEstado = State::find($objRepresentante->uf);

      $objCidade = City::find($objRepresentante->cidade);  
      //-------------------------------------------------------

      $states = State::get();
      $states = $states->pluck('name', 'uf')->toArray();
      //-------------------------------------------------------
      $bancos = Banco::get();
      $bancos = $bancos->pluck('banco', 'id')->toArray();
      //-------------------------------------------------------
      
      $cities = [];

      $listsArrayFiles = [];
     

      

      //----------------------------------------------------------------------
       
        $data = [    
               'representante_id' => $objRepresentante->id,
               'documento' => $objRepresentante->documento,
               'nome' => $objRepresentante->nome, 
               'contato' => $objRepresentante->contato,
               'email' => $objRepresentante->email,                            
               'states' => $states,
               'checkedState' => $objEstado->uf,
               'tipoPessoa' => $this->tipoPessoa,
               'checkedTipoPessoa' => $objRepresentante->tipo_pessoa,
               'cities' => $cities,
               'checkedCity' => $objCidade->name,
               'telefone' => $objRepresentante->telefone,
               'celular' => $objRepresentante->celular,
               'celular1' => $objRepresentante->celular1,
               'cep' => $objRepresentante->cep,
               'endereco' => $objRepresentante->endereco,
               'num' => $objRepresentante->num,
               'complemento' => $objRepresentante->complemento,
               'bairro' => $objRepresentante->bairro,  
               'tipoConta' => $this->tipoConta,
               'checkedTipo_1_conta' => $objRepresentante->banco_1_tipo,
               'checkedTipo_2_conta' => $objRepresentante->banco_2_tipo,
               'bancos' => $bancos,
               'checkedTipo_1_codbanco' => $objRepresentante->banco_1_id,
               'checkedTipo_2_codbanco' => $objRepresentante->banco_2_id,
               'banco_1_agencia' => $objRepresentante->banco_1_agencia,
               'banco_2_agencia' =>  $objRepresentante->banco_2_agencia,
               'banco_1_conta' => $objRepresentante->banco_1_conta,
               'banco_2_conta' => $objRepresentante->banco_2_conta, 
               'banco_1_documento' => $objRepresentante->banco_1_documento, 
               'banco_2_documento' => $objRepresentante->banco_2_documento,
               'dia_pagamento' => $objRepresentante->dia_pagamento,
               'observacao' => $objRepresentante->observacao,     
        ]; 

        $title = 'Editar Representante';
        $pagAction = 'Editar';

        return view('admin.representante.create-edit', $data, compact('title','pagAction'));  
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

            $representante = Representante::find($id);
            
            $documento = (preg_replace('/\D+/', '', $request->input('cpfcnpj')));

            $objEstado = State::where('uf',$request->input('state'))->get()->first();

            $objCidade = City::where('state_id',$objEstado->id)
                              ->where('name',$request->input('city'))
                              ->get()->first(); 
            
            $representanteUpdate = $representante->update([
                'tipo_pessoa'       => strlen($documento) > 11 ? 'J' : 'F',
                'documento'         => $documento,
                'nome'              => $request->input('nome'),
                'contato'           => $request->input('contato'),
                'email'             => $request->input('email'),
                'telefone'          => $request->input('telefone'),
                'celular'           => $request->input('celular'),
                'celular1'           => $request->input('celular1'),
                'cep'               => $request->input('cep'),
                'endereco'          => $request->input('endereco'),
                'num'               => $request->input('num'),
                'complemento'       => $request->input('complemento'),
                'bairro'            => $request->input('bairro'),
                'uf'                => $objEstado->id,
                'cidade'            => $objCidade->id,
                'status'            => 'Ativo',
            ]);            
                        
            if($representanteUpdate){

                $this->representanteHistorico($representante->id);

                DB::commit();

                //alterando dados usuario representante----------------------------------
                $user = User::where('representante_id',$representante->id)->get()->first();
                $updateUser = $user->update([
                       'name'  => $request->input('nome'),
                       'email' => $request->input('email'),
                ]); 

                if($updateUser){  
                  DB::commit();

                  //alterando senha do usuário
                  if($request->input('password')){

                    $updateUserPass = $user->update([
                      'password' => bcrypt($request->input('password')),
                    ]); 

                    if($updateUserPass)
                      DB::commit();
                    else
                      DB::rollBack();                   

                  }

                }else{
                  DB::rollBack();
                }

                //----------------------------------------------------------------------

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

    
    public function updateFinanceiro(Request $request, $id)
    {

        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

        try{
            DB::beginTransaction(); 

            $representante = Representante::find($id);           
            
            $representanteUpdate = $representante->update([
                'banco_1_id'        => $request->input('banco_1_id') == '' ? null : $request->input('banco_1_id'),
                'banco_1_tipo'      => $request->input('banco_1_tipo') == '' ? 'CC' : $request->input('banco_1_tipo'),
                'banco_1_agencia'   => $request->input('banco_1_agencia') == '' ? null : $request->input('banco_1_agencia'),
                'banco_1_conta'     => $request->input('banco_1_conta') == '' ? null : $request->input('banco_1_conta'),
                'banco_1_documento'     => $request->input('banco_1_documento') == '' ? null : $request->input('banco_1_documento'),


                'banco_2_id'        => $request->input('banco_2_id') == '' ? null : $request->input('banco_2_id'),
                'banco_2_tipo'      => $request->input('banco_2_tipo') == '' ? 'CC' : $request->input('banco_2_tipo'),
                'banco_2_agencia'   => $request->input('banco_2_agencia') == '' ? null : $request->input('banco_2_agencia'),
                'banco_2_conta'     => $request->input('banco_2_conta') == '' ? null : $request->input('banco_2_conta'),
                'banco_2_documento'     => $request->input('banco_2_documento') == '' ? null : $request->input('banco_2_documento'),
                'dia_pagamento'     => $request->input('dia_pagamento') == '' ? null : $request->input('dia_pagamento'),
            ]);
            
            if($representanteUpdate){

                $this->representanteHistorico($id);

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

    public function representanteHistorico($id)
    {
        $objRepresentante = Representante::find($id);

        $representanteInsert = RepresentanteHistorico::create([
            'representante_id'  => $objRepresentante->id,
            'tipo_pessoa'       => $objRepresentante->tipo_pessoa,
            'documento'         => $objRepresentante->documento,
            'nome'              => $objRepresentante->nome,
            'contato'           => $objRepresentante->contato,
            'email'             => $objRepresentante->email,
            'telefone'          => $objRepresentante->telefone,
            'celular'           => $objRepresentante->celular,
            'celular1'           => $objRepresentante->celular1,
            'banco_1_id'        => $objRepresentante->banco_1_id,
            'banco_1_tipo'      => $objRepresentante->banco_1_tipo,
            'banco_1_agencia'   => $objRepresentante->banco_1_agencia,
            'banco_1_conta'     => $objRepresentante->banco_1_conta,
            'banco_1_documento' => $objRepresentante->banco_1_documento,
            'banco_2_id'        => $objRepresentante->banco_2_id,
            'banco_2_tipo'      => $objRepresentante->banco_2_tipo,
            'banco_2_agencia'   => $objRepresentante->banco_2_agencia,
            'banco_2_conta'     => $objRepresentante->banco_2_conta,
            'banco_2_documento' => $objRepresentante->banco_2_documento,
            'dia_pagamento'     => $objRepresentante->dia_pagamento,
            'cep'               => $objRepresentante->cep,
            'endereco'          => $objRepresentante->endereco,
            'num'               => $objRepresentante->num,
            'complemento'       => $objRepresentante->complemento,
            'bairro'            => $objRepresentante->bairro,
            'cidade'            => $objRepresentante->cidade,
            'uf'                => $objRepresentante->uf,
            'observacao'        => $objRepresentante->observacao,
            'status'            => $objRepresentante->status,
        ]);
        
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
             $representante = Representante::find($id);
            
            if($representante){            
           
              $representanteUpdate = $representante->update([
                  'status'              => 'Excluido',
              ]);

              if($representanteUpdate){  
                $this->representanteHistorico($representante->id);

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


    
    
    public function deleteArquivo($id)
    {
       $dataExclusao = date('Y-m-d H:i:s');
       try{
            DB::beginTransaction(); 
             $representante = Consultor::find($id);
            
            if($representante){            
              //excluindo cliente trocando status!!!
              $representanteUpdate = $representante->update([
                  'arquivo'              => '',
              ]);

              if($representanteUpdate){                
                  DB::commit();

                   $this->representanteHistorico($representante->id);

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
            if(!Auth::user()->representante_id)
              $query = ViewConsultores::where('status','Ativo')->orderBy('nome', 'asc')->get();  
            else
              $query = ViewConsultores::where('status','Ativo')
                                        ->where('id',Auth::user()->representante_id)->orderBy('nome', 'asc')->get(); 
      */

              $query = ViewRepresentantes::get();

            $data = Datatables::of($query)
                    ->addIndexColumn()
                    
                    ->addColumn('action', function($row){

                          $link = url("/bayareaadmin/representante/edit").'/'.$row->id;
                          //$link2 = url("/grbrasiladmin/user/edit").'/'.$row->user_id;
                          //$link_imprimir = url("/grbrasiladmin/relatorio/consultor").'/'.$row->id;

                          $btn = '';


                           $btn .= '<a href="'.$link.'"><i class="fa fa-fw fa-edit" title="Editar Dados Consultor '.$row->nome.'"></i></a>';
                          


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
                            if(!Auth::user()->representante_id){
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
        $qt = Representante::where('documento',$documento)->where('status','Ativo')->count();

        return response()->json([
            'success'   => $qt == 0 ? true : false,
            'result' => $qt,
        ], 200);

      }else{
        $qt = Representante::where('documento',$documento)->where('id','!=',$id)->count();

        return response()->json([
            'success'   => $qt == 0 ? true : false,
            'result' => $qt,
        ], 200);
      }

    }


    public function criarUsuario($id,$password)
    {
      set_time_limit(0);

      include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

      $objRepresentante = Representante::find($id);

      $insert = User::create([
                 'name' => $objRepresentante->nome,
                 'email' => $objRepresentante->email,
                 'representante_id' => $id,
                 'status' => 'A',
                 'avatar' => null,
                 'password' => bcrypt($password),
      ]);

      if($insert){  
          DB::commit();   

          $insertRoleUser = RoleUser::create([
                     'role_id' => 8,
                     'user_id' => $insert->id,
          ]);

          if($insert && $insertRoleUser)
            DB::commit();
          else
            DB::rollBack();
          

        return true;
      }else{
        return false;
      }
  }

 


}
