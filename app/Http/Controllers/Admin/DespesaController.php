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
use App\Http\Controllers\Admin\CardapioController;
use App\Http\Controllers\Controller;
use App\Models\All\State;
use App\Models\All\City;
use App\Models\All\Cardapio;
use App\Models\All\DespesaTipo;
use App\Models\All\Despesa;
use App\Models\All\DespesaItem;
use Illuminate\Support\Facades\Storage;


use App\User;
use Carbon\Carbon;
use App\Funcoes\Funcoes;

use DataTables;

class DespesaController extends Controller
{
    private $mailController;
    private $CardapioController;

    private $stateModel;   
    
    private $qtRecordPage = 25;


    public function __construct(MailController $mailController, CardapioController $cardapioController){
      $this->mailController = $mailController;  
      $this->cardapioController = $cardapioController;      
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

      $title = 'Despesas';
      $pagAction = 'Lista';

      return view('admin.despesa.indexajax', compact('title','pagAction')); 
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

        //-----------------------------------------------------------------------------
        $comboDespesaTipo = DespesaTipo::orderBy('nome', 'asc')->get();

        $arrayDespesaTipo = Array();
        $arrayDespesaTipo['outros'] = 'Outros';
        foreach ($comboDespesaTipo as $key => $value) {
            $arrayDespesaTipo[$value->id] = $value->nome;
        }

        $comboDespesaTipo = json_decode(json_encode($arrayDespesaTipo), FALSE);//convertendo array em objeto
        //-----------------------------------------------------------------------------
        $listaCardapio = Cardapio::orderBy('produto', 'asc')->get();

        $arrayCardapio = Array();
        foreach ($listaCardapio as $key => $value) {
            $arrayCardapio[$value->id] = $value->produto;
        }

        $listaCardapio = json_decode(json_encode($arrayCardapio), FALSE);//convertendo array em objeto
        //-----------------------------------------------------------------------------

      $data = [    
          'despesa_id' => '',
          'descricao' => '',
          'anexo' => '',
          'total_despesas' => '0,00',
          'total_despesas' => '0,00',
          'comboDespesas' => $comboDespesaTipo,
          'checkDespesa' => '',
          'listaCardapio' => $listaCardapio,
          'checkCardapio' => '',
          'qtDespesas' => 0,
      ]; 

      $title = 'Despesas';
      $pagAction = 'Cadastrar';

      return view('admin.despesa.create-edit', $data, compact('title','pagAction')); 

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


        if(!$request->input('idRecord2')){

            $despesaInsert = Despesa::create([
                'user_id'           => Auth::user()->id,
                'descricao'         => null,
                'valor'             => null,
                'arquivo'           => null,
            ]);
                        
            if($despesaInsert){

                DB::commit();

                $this->storeDespesaItem($request,$despesaInsert->id);//gravando o item da despesa
                
                $respSomaDI = DB::select("call procedure_soma_despesa_itens(".$despesaInsert->id.")");

                $htmlListaDespesa = $this->montaListaDespesas($despesaInsert->id);   

                //----inserindo valor da despesa-------------------------------------
                $objDespesa = Despesa::find($despesaInsert->id);

                $despesaUpdate = $objDespesa->update([
                'user_id'           => Auth::user()->id,
                'valor'             => $respSomaDI[0]->total,
                ]); 
           
                if($despesaUpdate)
                    DB::commit();
                //-------------------------------------------------------------------            

                return response()->json([
                    'success'   => true,
                    'result' => $despesaInsert->id,
                    'totalDespesas' => number_format($respSomaDI[0]->total, 2, ',', '.'),
                    'htmlListaDespesa' => $htmlListaDespesa,
                ], 201);    

            }else{
              DB::rollBack();
                return response()->json([
                    'success'   => false,
                    'result' => $e->getMessage(),
                    'totalDespesas' => null,
                    'htmlListaDespesa' => '',
                ]);
            }

          }else{
            //gravando somente o item, pois despesa já foi criada
            DB::commit();

            $this->storeDespesaItem($request,$request->input('idRecord2'));//gravando o item da despesa

            $respSomaDI = DB::select("call procedure_soma_despesa_itens(".$request->input('idRecord2').")");

            //----inserindo valor da despesa-------------------------------------
            $objDespesa = Despesa::find($request->input('idRecord2'));

            $despesaUpdate = $objDespesa->update([
            'user_id'           => Auth::user()->id,
            'valor'             => $respSomaDI[0]->total,
            ]); 
       
            if($despesaUpdate)
                DB::commit();
            //------------------------------------------------------------------- 

            $htmlListaDespesa = $this->montaListaDespesas($request->input('idRecord2'));

            return response()->json([
                'success'   => true,
                'result' => $request->input('idRecord2'),
                'totalDespesas' => number_format($respSomaDI[0]->total, 2, ',', '.'),
                'htmlListaDespesa' => $htmlListaDespesa,
            ], 201);   

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

      if(Auth::user()->cliente_id){
        if(Auth::user()->cliente_id != $id)
          abort(404);
      }
      */


      set_time_limit(0);

      include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

      $despesa_id = '';
      $descricao = '';
      $total_despesas = '0,00';
      $arrayDespesas = Array();




      $objDespesa = Despesa::find($id);
      if($objDespesa){

        //itens das despesas
        $listaDespesas = DB::select("call procedure_despesa_itens(".$objDespesa->id.")");
  
        if(count($listaDespesas) > 0){

          foreach ($listaDespesas as $key => $value) {
            $arrayDespesas[$key]['despesa_item_id'] = $value->despesa_item_id;
            $arrayDespesas[$key]['cardapio'] = $value->cardapio;
            $arrayDespesas[$key]['quantidade'] = $value->quantidade;
            $arrayDespesas[$key]['valor'] = number_format($value->valor, 2, ',', '.');
            $arrayDespesas[$key]['despesa_tipo'] = $value->despesa_tipo;
          }

        }

        $listaDespesas = json_decode(json_encode($arrayDespesas), FALSE);//convertendo array em objeto

        //total das despesas
        $respSomaDI = DB::select("call procedure_soma_despesa_itens(".$objDespesa->id.")");
               

        $despesa_id = $objDespesa->id;
        $descricao = $objDespesa->descricao;
        $total_despesas = $respSomaDI[0]->total;



        //-----------------------------------------------------------------------------
        $comboDespesaTipo = DespesaTipo::orderBy('nome', 'asc')->get();

        $arrayDespesaTipo = Array();
        $arrayDespesaTipo['outros'] = 'Outros';
        foreach ($comboDespesaTipo as $key => $value) {
            $arrayDespesaTipo[$value->id] = $value->nome;
        }

        $comboDespesaTipo = json_decode(json_encode($arrayDespesaTipo), FALSE);//convertendo array em objeto
        //-----------------------------------------------------------------------------
        $listaCardapio = Cardapio::orderBy('produto', 'asc')->get();

        $arrayCardapio = Array();
        foreach ($listaCardapio as $key => $value) {
            $arrayCardapio[$value->id] = $value->produto;
        }

        $listaCardapio = json_decode(json_encode($arrayCardapio), FALSE);//convertendo array em objeto
        //-----------------------------------------------------------------------------

      }

      $data = [    
             'despesa_id' => $despesa_id,
             'descricao' => $descricao,
             'anexo' => $objDespesa->arquivo != '' ? $objDespesa->arquivo : '',
             'total_despesas' => number_format($total_despesas, 2, ',', '.'),
             'listaDespesas' => $listaDespesas,
             'comboDespesas' => $comboDespesaTipo,
             'checkDespesa' => '',
             'listaCardapio' => $listaCardapio,
             'checkCardapio' => '',
             'qtDespesas' => count($arrayDespesas),
      ];

      //echo "<pre>";
      //print_r($data);
      //exit();

      $title = 'Editar Despesa';
      $pagAction = 'Despesas';

      return view('admin.despesa.create-edit', $data, compact('title','pagAction'));  
    }


    public function download($file)
    {
      return Storage::download('public/assets/upload/nf/'.$file);
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

            //parte do upload-------------------------------------
             $resp = $this->upload($request);
            //----------------------------------------------------

            $objDespesa = Despesa::find($id);

            $respSomaDI = DB::select("call procedure_soma_despesa_itens(".$objDespesa->id.")");


           
            $despesaUpdate = $objDespesa->update([
                'user_id'           => Auth::user()->id,
                'descricao'         => $request->input('descricao'),
                'valor'             => $respSomaDI[0]->total,
            ]); 
       
            if($despesaUpdate){
                DB::commit();

                //alterando arquivo
                if($resp['success'] == true && $resp['name_file'] != ''){

                  $despesaUpdateFile = $objDespesa->update([
                      'arquivo'           => $resp['name_file'],
                  ]);
                  if($despesaUpdateFile)
                    DB::commit();

                }

                return response()->json([
                        'success'   => true,
                        'result' => $objDespesa->id,
                    ], 201);     
            }else{
              DB::rollBack();
           
                return response()->json([
                        'success'   => false,
                        'result' => 'Erro ao salvar despesa.',
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

            //desativando despesa---------------------------
            $objDespesa = Despesa::find($id);

            if($objDespesa){            
           
              $despesaUpdate = $objDespesa->update([
                'user_id'           => Auth::user()->id,
                'status'            => 'I',
              ]);

              if($despesaUpdate){               
                  DB::commit();

                  //desativando itens da despesa-----------------------
                  $listaDespesaItens = DespesaItem::where('despesa_id',$id)->get();

                  if(count($listaDespesaItens) > 0){

                    foreach ($listaDespesaItens as $key => $value) {

                      $objDespesaItem = DespesaItem::find($value->id);
                      if($objDespesaItem){    

                        $despesaItemUpdate = $objDespesaItem->update([
                          'user_id'           => Auth::user()->id,
                          'status'            => 'I',
                        ]);

                        if($despesaItemUpdate)               
                            DB::commit();   
                        else
                           DB::rollBack();
                      }
                     
                    }

                  }

              }

             return response()->json([
                      'success'       => true,
                      'result'        => 'sucesso ao excluir registro',
                      'totalDespesas' => '',
                  ], 200);

            }else{
              DB::rollBack();
                  return response()->json([
                      'success'       => false,
                      'result'        => 'erro ao excluir registro',
                      'totalDespesas' => '',
                  ], 200);
            }
            
        } 
        catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                        'success'   => false,
                        'result' => $e->getMessage(),
                        'totalDespesas' => '',
                    ]);
        }
    }


  public function destroyItem($id)
    {
      //if(Gate::denies('delete_consultores')) {
            //abort(404);
      //}

       $dataExclusao = date('Y-m-d H:i:s');
       try{
            DB::beginTransaction(); 
             $objDespesaItem = DespesaItem::find($id);
            
            if($objDespesaItem){            
           
              $despesaItemUpdate = $objDespesaItem->update([
                'user_id'           => Auth::user()->id,
                'status'            => 'I',
              ]);

              if($despesaItemUpdate){  
               
                  DB::commit();

                  $respSomaDI = DB::select("call procedure_soma_despesa_itens(".$objDespesaItem->despesa_id.")");

                  //----inserindo valor da despesa-------------------------------------
                  $objDespesa = Despesa::find($objDespesaItem->despesa_id);

                  $despesaUpdate = $objDespesa->update([
                  'user_id'           => Auth::user()->id,
                  'valor'             => $respSomaDI[0]->total,
                  ]); 
             
                  if($despesaUpdate)
                      DB::commit();
                  //------------------------------------------------------------------- 

                  return response()->json([
                      'success'   => true,
                      'result' => $id,
                      'totalDespesas' => number_format($respSomaDI[0]->total, 2, ',', '.'),
                  ], 200);

              }
            }else{
              DB::rollBack();
                  return response()->json([
                      'success'       => false,
                      'result'        => 'erro ao excluir registro',
                      'totalDespesas' => '',
                  ], 200);
            }
            
        } 
        catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                        'success'   => false,
                        'result' => $e->getMessage(),
                        'totalDespesas' => '',
                    ]);
        }
    }


  public function montaListaDespesas($despesaId)
  {

    $listaDespesas = DB::select("call procedure_despesa_itens(".$despesaId.")");

    $lista = '';

    if(count($listaDespesas) > 0){

      foreach ($listaDespesas as $key => $value) {
        
        $lista .= '
          <tr id="tr_item_'.$value->despesa_item_id.'">
              <td>'.$value->despesa_item_id.'</td>
              <td>'.$value->despesa_tipo.'</td>
              <td>'.$value->cardapio.'</td>
              <td>'.$value->quantidade.'</td>                     
              <td>R$ '.number_format($value->valor, 2, ',', '.').'</td>
              <td>
                  <a href="javascript:void(0);" onclick="excluirRegistroItem('.$value->despesa_item_id.');"><i class="fa fa-fw fa-trash" style="color: #ff0000;" title="Excluir - '.$value->despesa_item_id.'"></i></a>
              </td>
          </tr>
        ';

      }

    }else{
      $lista .= '
        <tr>
            <td colspan="6" style="text-align: center">Nenhuma despesa localizada.</td>
        </tr>
      ';
    }

    return $lista;

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

            $query = Despesa::where('status','A')->orderBy('created_at', 'DESC');

            $data = DataTables::of($query)
                    ->addIndexColumn()
                    ->editColumn('created_at', function ($data) {

                      $data_cadastro = '';
                      
                      if($data->created_at)
                        $data_cadastro = Carbon::parse($data->created_at)->format('d/m/Y H:i:s');

                      return $data_cadastro;
                    })

                    ->editColumn('valor', function ($data) {

                     $valor = 'R$ '.number_format($data->valor, 2, ',', '.');

                      return $valor;
                    })

                    
                    ->addColumn('action', function($row){

                          $link = url("/bayareaadmin/despesa/edit").'/'.$row->id;
                         
                          //$link_imprimir = url("/grbrasiladmin/relatorio/consultor").'/'.$row->id;

                          $btn = '';


                           $btn .= '<a href="'.$link.'"><i class="fa fa-fw fa-edit" title="Editar Dados Cliente '.$row->nome.'"></i></a>';


                           $btn .= '<a href="javascript:void(0);" onclick="excluirRegistro('.$row->id.');"><i class="fa fa-fw fa-trash" style="color: #ff0000;" title="Excluir - '.$row->id.'"></i></a>';

                            if($row->arquivo){
                              $linkDownload = url("/bayareaadmin/despesa/download").'/'.$row->arquivo;
                              $btn .= '<a href="'.$linkDownload.'" title="Clique para download do comprovante">
                                            <i class="fa fa-paperclip"></i>
                                            </a>';
                            }
                          


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


    /*****store da despesa item****/

    public function storeDespesaItem($request,$despesaInsertId)
    { 
        set_time_limit(0);

        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

        try{
            DB::beginTransaction(); 
            include_once(public_path() . '/assets/funcoes/funcoesGeral.php');                  

            $despesaItemInsert = DespesaItem::create([
                'user_id'           => Auth::user()->id,
                'despesa_id'        => $despesaInsertId, 
                'despesa_tipo_id'   => $request->input('despesa_tipo_id') == 'outros' ? null : $request->input('despesa_tipo_id'),
                'cardapio_id'       => $request->input('cardapio_id'),
                'valor'             => gravarValorMoeda($request->input('valor')),
                'quantidade'        => $request->input('quantidade'),
            ]);

            $somaTotalDespesas = 0;

            if($despesaItemInsert){
                DB::commit();

                //adicionando estoque-----------------------------------------------------
                $respAtualizaCard = $this->cardapioController->atualizaEstoque($request->input('cardapio_id'),'adicionar',$request->input('quantidade'));
                
                //alterando o valor total da despesa ao ir adicionando-------------------
                $respSomaDI = DB::select("call procedure_soma_despesa_itens(".$despesaInsertId.")");
                $somaTotalDespesas = ($respSomaDI[0]->total + $request->input('valor'));

                $objDespesa = Despesa::find($despesaInsertId);

                $despesaUpdate = $objDespesa->update([
                  'user_id'           => Auth::user()->id,
                  'valor'             => $somaTotalDespesas,
                ]); 
           
                if($despesaUpdate)
                    DB::commit();

                //------------------------------------------------------------------------

                return true; 

            }else{
              DB::rollBack();

              return false; 
            }        
        } 
        catch(\Exception $e){
            DB::rollBack();
            $e->getMessage();
    
            return false;
        }

    }

  //upload da nota fical ou comprovante de pagamento
  public function upload($request)
  {
    // Define o valor default para a variável que contém o nome da imagem 
    $nameFile = null;
 
    // Verifica se informou o arquivo e se é válido
    //****arquivo é name do file do input
    if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
         
        // Define um aleatório para o arquivo baseado no timestamps atual
        $name = uniqid(date('HisYmd'));
 
        // Recupera a extensão do arquivo
        //**** $request->arquivo => arquivo é name do file do input
        $extension = $request->arquivo->extension();
 
        // Define finalmente o nome
        $nameFile = "{$name}.{$extension}";
 
        // Faz o upload:
        //**** $request->arquivo => arquivo é name do file do input
        //$upload = $request->arquivo->storeAs('../../assets/upload/nf/', $nameFile);
        //storage\app\public\assets\upload\nf => caminho onde imagem será salva
        $upload = $request->file('arquivo')->storeAs('public/assets/upload/nf/', $nameFile);
        // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
 
        // Verifica se NÃO deu certo o upload (Redireciona de volta)
        if ( !$upload ){
          $response['success']= false;
          $response['name_file'] = '';
          $response['message'] = 'Falha ao fazer upload';            
        }else{
          $response['success']= true;
          $response['name_file'] = $nameFile;
          $response['message'] = 'Sucesso ao fazer upload';           
        }

        
 
    }else{
      $response['success']= false;
      $response['name_file'] = '';
      $response['message'] = 'Não consta arquivo para fazer upload';    
    }

    return $response;
}




}