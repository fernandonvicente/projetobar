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
use App\Models\All\NF;

use App\User;

use DataTables;

class NFController extends Controller
{
    private $mailController;

    private $stateModel;   
    
    private $qtRecordPage = 25;
    
    public function __construct(MailController $mailController){
      $this->mailController = $mailController;      
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
            
            $planoInsert = Plano::create([
                'nome'              => $request->input('nome'),
                'descricao'         => $request->input('descricao'),
                'valor'             => gravarValorMoeda($request->input('valor')),
                'adesao'             => gravarValorMoeda($request->input('adesao')),
                'banda'             => $request->input('banda'),
                'franquia'          => $request->input('franquia'),
                'status'            => $request->input('status'),
            ]);
            
            $insertedId = $planoInsert->id;
            
            if($insertedId){

                DB::commit();

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
      set_time_limit(0);

      include_once(public_path() . '/assets/funcoes/funcoesGeral.php');


      $objPlano = Plano::find($id);

      //----------------------------------------------------------------------
       
        $data = [    
               'plano_id' => $objPlano->id,
               'nome' => $objPlano->nome, 
               'descricao' => $objPlano->descricao,
               'valor' => $objPlano->valor,   
               'adesao' => $objPlano->adesao, 
               'listaBanda' => $this->tipoBanda,
               'checkedBanda' => $objPlano->banda,
               'franquia' => $objPlano->franquia, 
               'status' => $objPlano->status, 
        ]; 

        $title = 'Editar Plano';
        $pagAction = 'Editar';

        return view('admin.plano.create-edit', $data, compact('title','pagAction'));  
        */
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

            $objPlano = Plano::find($id);
                        
            $planoUpdate = $objPlano->update([
                'nome'              => $request->input('nome'),
                'descricao'         => $request->input('descricao'),
                'valor'             => gravarValorMoeda($request->input('valor')),
                'adesao'             => gravarValorMoeda($request->input('adesao')),
                'banda'             => $request->input('banda'),
                'franquia'          => $request->input('franquia'),
                'status'          => $request->input('status'),
            ]);            
                        
            if($planoUpdate){

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
      /*
      //if(Gate::denies('delete_consultores')) {
            //abort(404);
      //}

       $dataExclusao = date('Y-m-d H:i:s');
       try{
            DB::beginTransaction(); 
             $objPlano = Plano::find($id);
            
            if($objPlano){            
           
              $planoUpdate = $objPlano->update([
                  'status'              => 'Excluido',
              ]);

              if($planoUpdate){  
               
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
        */
    }


    
    
  

  public function carregaTabela(Request $request)
  {
      //if(Gate::denies('view_consultores')) {
            //abort(404);
      //}

        set_time_limit(0);

        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');
        
            $query = Plano::get();

            $data = DataTables::of($query)
                    ->addIndexColumn()
                    ->editColumn('valor', function ($data) {
                      
                      $valor = 'R$ '.number_format($data->valor, 2, ',', '.');

                      return $valor;
                    })
                    
                    ->addColumn('action', function($row){

                          $link = url("/bayareaadmin/plano/edit").'/'.$row->id;

                          $btn = '';
                          
                           $btn .= '<a href="'.$link.'"><i class="fa fa-fw fa-edit" title="Editar Dados Plano '.$row->nome.'"></i></a>';

                           $btn .= '<a href="javascript:void(0);" onclick="excluirRegistro('.$row->id.');"><i class="fa fa-fw fa-trash" style="color: #ff0000;" title="Excluir - '.$row->id.'"></i></a>';
                           
                          return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        //}
      
        return $data;
    }


}
