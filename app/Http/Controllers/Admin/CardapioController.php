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
use App\Models\All\Cardapio;


use App\Models\View\ViewEquipamentos;

use App\User;

use Datatables;

class CardapioController extends Controller
{
    private $mailController;

    private $stateModel;   
    
    private $qtRecordPage = 25;

    public $status = [
      'Ativo' => 'Ativo',
      'Inativo' => 'Inativo',
      'Excluido' => 'Excluido',
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

      $title = 'Equipamentos';
      $pagAction = 'Lista';

      return view('admin.equipamento.indexajax', compact('title','pagAction')); 
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

        $equipamentoTipo = EquipamentoTipo::get();
        $equipamentoTipo = $equipamentoTipo->pluck('nome', 'id')->toArray();

        $data = [    
               'equipamento_id' => '',
               'fabricante' => '',
               'modelo' => '',
               'numero_serie' => '', 
               'mac_andress' => '',
               'checkedEquipamentoTipo' => '',
               'equipamentoTipo' => $equipamentoTipo,
               'checkedStatus' => 'Ativo',
               'status' => $this->status,
        ]; 

        $title = 'Equipamento';
        $pagAction = 'Cadastrar';

        return view('admin.equipamento.create-edit', $data, compact('title','pagAction')); 

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

            $equipamentoInsert = Equipamento::create([
                'equipamento_tipo_id'  => $request->input('equipamento_tipo_id'),
                'fabricante'         => $request->input('fabricante'),
                'modelo'             => $request->input('modelo'),
                'numero_serie'          => $request->input('numero_serie'),
                'mac_andress'          => $request->input('mac_andress'),
                'status'            => $request->input('status'),
            ]);
            
            $insertedId = $equipamentoInsert->id;
            
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
        set_time_limit(0);


        $objCardapio = Cardapio::find($id);
  
        if($objCardapio){

          if($objCardapio->preco_promocao)
            $preco_consumo = number_format($objCardapio->preco_promocao, 2, ',', '.');
          else
           $preco_consumo = number_format($objCardapio->preco_venda, 2, ',', '.');


          return response()->json([
              'success'=> true,
              'result' => $objCardapio,
              'preco_consumo' => $preco_consumo,
          ]);  

        }else{
          return response()->json([
              'success'=> false,
              'result' => null,
          ]);
        }

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

      if(Auth::user()->plano_id){
        if(Auth::user()->plano_id != $id)
          abort(404);
      }
      */


      set_time_limit(0);

      include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

      $equipamentoTipo = EquipamentoTipo::get();
      $equipamentoTipo = $equipamentoTipo->pluck('nome', 'id')->toArray();

      $objEquipamento = Equipamento::find($id);

      //----------------------------------------------------------------------
       
        $data = [    
               'equipamento_id' => $objEquipamento->id,
               'fabricante' => $objEquipamento->fabricante,
               'modelo' => $objEquipamento->modelo,                            
               'numero_serie' => $objEquipamento->numero_serie,
               'mac_andress' => $objEquipamento->mac_andress,
               'checkedEquipamentoTipo' => $objEquipamento->equipamento_tipo_id,
               'equipamentoTipo' => $equipamentoTipo,
               'checkedStatus' => $objEquipamento->status,
               'status' => $this->status,
        ]; 

        $title = 'Editar Equipamento';
        $pagAction = 'Editar';

        return view('admin.equipamento.create-edit', $data, compact('title','pagAction'));  
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

            $objEquipamento = Equipamento::find($id);
                        
            $equipamentoUpdate = $objEquipamento->update([
                'equipamento_tipo_id'  => $request->input('equipamento_tipo_id'),
                'fabricante'         => $request->input('fabricante'),
                'modelo'             => $request->input('modelo'),
                'numero_serie'          => $request->input('numero_serie'),
                'mac_andress'          => $request->input('mac_andress'),
                'status'            => $request->input('status'),
            ]);            
                        
            if($equipamentoUpdate){

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
             $objEquipamento = Equipamento::find($id);
            
            if($objEquipamento){            
           
              $equipamentoUpdate = $objEquipamento->update([
                  'status'              => 'Excluido',
              ]);

              if($equipamentoUpdate){  
               
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


    public function atualizaEstoque($cadapioId,$acao,$quantidade)
    {
      $objCardapio = Cardapio::find($cadapioId);

      if($objCardapio){

        if($acao == 'adicionar')
          $novoSaldo = ($objCardapio->unidade + $quantidade);
        else
          $novoSaldo = ($objCardapio->unidade - $quantidade);

        $cardapioUpdate = $objCardapio->update([
          'user_id' => Auth::user()->id,
          'unidade' => $novoSaldo,
        ]);

        if($cardapioUpdate){            
          DB::commit();
          $response['success'] = true;
          $response['message'] = 'sucesso na atualização do estoque'; 
          $response['action'] = $acao; 
        }else{
          DB::rollBack();
          $response['success'] = false;
          $response['message'] = 'erro na atualização do estoque'; 
          $response['action'] = $acao; 
        }

      }else{
        $response['success'] = false;
        $response['message'] = 'cardapio não existe para atualizar do estoque'; 
        $response['action'] = $acao; 
      }

      return $response;
    }


    
    
  

  public function carregaTabela(Request $request)
  {
      //if(Gate::denies('view_consultores')) {
            //abort(404);
      //}

        set_time_limit(0);

        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');
        

            $query = ViewEquipamentos::get();

            $data = Datatables::of($query)
                    ->addIndexColumn()
                    
                    ->addColumn('action', function($row){

                          $link = url("/bayareaadmin/equipamento/edit").'/'.$row->id;

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
