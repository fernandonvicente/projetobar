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
use App\Models\All\Cliente;
use App\Models\All\Cardapio;
use App\Models\All\Comanda;
use App\Models\All\ComandaItens;
use App\Models\All\RecebimentoTipo;
use Illuminate\Support\Facades\Storage;


use App\User;
use Carbon\Carbon;
use App\Funcoes\Funcoes;

use DataTables;

class ComandaController extends Controller
{
    private $mailController;
    private $CardapioController;

    private $stateModel;   
    
    private $qtRecordPage = 25;

    public $comandaStatusCombo = [
      'A' => 'Aberto',
      'F' => 'Fechado',
    ];


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

      $title = 'Comandas';
      $pagAction = 'Lista';

      return view('admin.comanda.indexajax', compact('title','pagAction')); 
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

      $recebimentoTipos = RecebimentoTipo::orderBy('nome', 'ASC')->get();
      $recebimentoTiposCombo = $recebimentoTipos->pluck('nome', 'id')->toArray();


      $clientes = Cliente::orderBy('nome', 'ASC')->where('status','A')->get();
      //$clientesCombo = $clientes->pluck('nome', 'id')->toArray();

      
      $clientesCombo = Array();

      if(count($clientes) > 0){
        foreach ($clientes as $key => $value) {
          //checando se cliente tem comanda aberta------------------------------

          $qtComandaAtiva = Comanda::where('cliente_id',$value->id)->where('comanda_status','A')->count();

          //--------------------------------------------------------------------
          if($qtComandaAtiva == 0)
            $clientesCombo[$value->id] = $value->nome;
        }
      }

      //------------------------------------------------------------------------
      $cardapios = DB::select("call procedure_cardapio()");

      $cardapiosCombo = Array();

      if(count($cardapios) > 0){
        foreach ($cardapios as $key => $value) {
           $objCardapioEstoque = Cardapio::find($value->cardapio_id);

          //--------------------------------------------------------------------
          if($objCardapioEstoque->unidade >  0)
            $cardapiosCombo[$value->cardapio_id] = $value->produto;
        }
      }
      //-------------------------------------------------------------------------
      $arrayDespesas = Array();
      $listaComandas = json_decode(json_encode($arrayDespesas), FALSE);//convertendo array em objeto
      //------------------------------------------------------------------------

      $data = [    
          'comanda_id' => '',
          'total_despesas' => '0,00',
          'listaComandas' => $listaComandas,
          'qtDespesas' => 0,
          'checkedCliente' => '',
          'clientesCombo' => $clientesCombo,
          'checkedCardapio' => '',
          'cardapiosCombo' => $cardapiosCombo,
          'checkedRecebimentoTiposCombo' => 'A',
          'recebimentoTiposCombo' => $recebimentoTiposCombo,
          'checkedComandaStatusCombo' => '',
          'comandaStatusCombo' => $this->comandaStatusCombo,
          'disabled' => '',
          'troco' => number_format(0, 2, ',', '.'),
          'valor_recebido' => number_format(0, 2, ',', '.'),
          'troco_disabled' => '',
      ]; 

      $title = 'Comanda';
      $pagAction = 'Comandas';

      return view('admin.comanda.create-edit', $data, compact('title','pagAction')); 

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

        //checando se tem estoque disponivel------------------------------------------

            $objCardapioEstoque = Cardapio::find($request->input('cardapio_id'));
            if($objCardapioEstoque){

              if($objCardapioEstoque->unidade < $request->input('quantidade')){

                return response()->json([
                  'success'   => false,
                  'estoque'   => false,
                  'mensagem' => 'Estoque insuficiente! Saldo atual '.$objCardapioEstoque->unidade,
                  'qtdadeDisponivel' => $objCardapioEstoque->unidade,
                ]);

              }

            }
        //----------------------------------------------------------------------------              


        if(!$request->input('idRecord2')){

            $comandaInsert = Comanda::create([
                'user_id'             => Auth::user()->id,
                'cliente_id'          => $request->input('cliente_id'),
                'sub_total'           => null,
                'valor_total'         => null,
                'troco'               => null,
                'recebimento_tipo_id' => null,
            ]);
                        
            if($comandaInsert){

                DB::commit();

                $this->storeComandaItem($request,$comandaInsert->id);//gravando o item da despesa
                
                $respSomaDI = DB::select("call procedure_soma_comanda_itens(".$comandaInsert->id.")");

                $htmlListaDespesa = $this->montaListaComandas($comandaInsert->id);   

                //----inserindo valor da despesa-------------------------------------
                $objComanda = Comanda::find($comandaInsert->id);

                $comandaUpdate = $objComanda->update([
                  'user_id'           => Auth::user()->id,
                  'sub_total'         => $respSomaDI[0]->total,
                  'valor_total'       => $respSomaDI[0]->total,

                ]); 
           
                if($comandaUpdate)
                    DB::commit();
                //-------------------------------------------------------------------            

                return response()->json([
                    'success'   => true,
                    'result' => $comandaInsert->id,
                    'totalDespesas' => number_format($respSomaDI[0]->total, 2, ',', '.'),
                    'htmlListaDespesa' => $htmlListaDespesa,
                    'estoque'   => true,
                ], 201);    

            }else{
              DB::rollBack();
                return response()->json([
                    'success'   => false,
                    'result' => $e->getMessage(),
                    'totalDespesas' => null,
                    'htmlListaDespesa' => '',
                    'estoque'   => true,
                ]);
            }

          }else{
            //gravando somente o item, pois comanda já foi criada
            DB::commit();

            $this->storeComandaItem($request,$request->input('idRecord2'));//gravando o item da comanda

            $respSomaDI = DB::select("call procedure_soma_comanda_itens(".$request->input('idRecord2').")");

            //----inserindo valor da comanda-------------------------------------
            $objComanda = Comanda::find($request->input('idRecord2'));

            $comandaUpdate = $objComanda->update([
            'user_id'           => Auth::user()->id,
            'valor_total'       => $respSomaDI[0]->total,
            'sub_total'         => $respSomaDI[0]->total,
            ]); 
       
            if($comandaUpdate)
                DB::commit();
            //------------------------------------------------------------------- 

            $htmlListaDespesa = $this->montaListaComandas($request->input('idRecord2'));

            return response()->json([
                'success'   => true,
                'result' => $request->input('idRecord2'),
                'totalDespesas' => number_format($respSomaDI[0]->total, 2, ',', '.'),
                'htmlListaDespesa' => $htmlListaDespesa,
                'estoque'   => true,
            ], 201);   

          }
        
        } 
        catch(\Exception $e){
            DB::rollBack();
              return response()->json([
                  'success'   => false,
                  'result' => $e->getMessage(),
                  'estoque'   => true,
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

          if(!$objCardapio->preco_promocao)
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

      if(Auth::user()->cliente_id){
        if(Auth::user()->cliente_id != $id)
          abort(404);
      }
      */


      set_time_limit(0);

      include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

      $comanda_id = '';
      $descricao = '';
      $total_despesas = '0,00';
      $arrayDespesas = Array();

      $objComanda = Comanda::find($id);
      if($objComanda){

        $recebimentoTipos = RecebimentoTipo::orderBy('nome', 'ASC')->get();
        $recebimentoTiposCombo = $recebimentoTipos->pluck('nome', 'id')->toArray();

        $clientes = Cliente::orderBy('nome', 'ASC')->where('status','A')->get();
        //$clientesCombo = $clientes->pluck('nome', 'id')->toArray();
        
        $clientesCombo = Array();

        if(count($clientes) > 0){
          foreach ($clientes as $key => $value) {
            //checando se cliente tem comanda aberta------------------------------

            $qtComandaAtiva = Comanda::where('cliente_id',$value->id)->where('comanda_status','A')->count();

            //--------------------------------------------------------------------
            //if($qtComandaAtiva == 0)
              $clientesCombo[$value->id] = $value->nome;
          }
        }

        //------------------------------------------------------------------------
        $cardapios = DB::select("call procedure_cardapio()");

        $cardapiosCombo = Array();

        if(count($cardapios) > 0){
          foreach ($cardapios as $key => $value) {
             $objCardapioEstoque = Cardapio::find($value->cardapio_id);

            //--------------------------------------------------------------------
            if($objCardapioEstoque->unidade >  0)
              $cardapiosCombo[$value->cardapio_id] = $value->produto;
          }
        }
        //-------------------------------------------------------------------------
        $arrayDespesas = Array();
        $listaComandas = json_decode(json_encode($arrayDespesas), FALSE);//convertendo array em objeto
        //------------------------------------------------------------------------

        //itens das despesas
        $listaComandas = DB::select("call procedure_comanda_itens(".$objComanda->id.")");
  
        if(count($listaComandas) > 0){

          foreach ($listaComandas as $key => $value) {
            $arrayDespesas[$key]['comanda_item_id'] = $value->comanda_item_id;
            $arrayDespesas[$key]['produto'] = $value->produto;
            $arrayDespesas[$key]['quantidade'] = $value->quantidade;
            $arrayDespesas[$key]['valor'] = number_format($value->valor, 2, ',', '.');
          }

        }

        $listaComandas = json_decode(json_encode($arrayDespesas), FALSE);//convertendo array em objeto

        //total das despesas
        $respSomaDI = DB::select("call procedure_soma_comanda_itens(".$objComanda->id.")");
               

        $comanda_id = $objComanda->id;
        $total_despesas = $respSomaDI[0]->total;
      }

      $data = [    
             'comanda_id' => $comanda_id,
             'total_despesas' => number_format($total_despesas, 2, ',', '.'),
             'valor_recebido' => number_format($objComanda->valor_recebido, 2, ',', '.'),
             'troco_disabled' => 'disabled',
             'troco' => number_format($objComanda->troco, 2, ',', '.'),
             'listaComandas' => $listaComandas,
             'checkedCliente' => $objComanda->cliente_id,
             'clientesCombo' => $clientesCombo,
             'checkedCardapio' => '',
             'cardapiosCombo' => $cardapiosCombo,
             'qtDespesas' => count($arrayDespesas),
             'disabled' => 'disabled',
             'checkedRecebimentoTiposCombo' => $objComanda->recebimento_tipo_id,
             'recebimentoTiposCombo' => $recebimentoTiposCombo,
             'checkedComandaStatusCombo' => $objComanda->comanda_status,
             'comandaStatusCombo' => $this->comandaStatusCombo,
      ];

      //echo "<pre>";
      //print_r($data);
      //exit();

      $title = 'Editar Comanda';
      $pagAction = 'Comanda';

      return view('admin.comanda.create-edit', $data, compact('title','pagAction'));  
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

            $objComanda = Comanda::find($id);

            $respSomaDI = DB::select("call procedure_soma_comanda_itens(".$objComanda->id.")");
           
            $comandaUpdate = $objComanda->update([
                'user_id'           => Auth::user()->id,
                'sub_total'         => $respSomaDI[0]->total,
                'valor_total'       => $respSomaDI[0]->total,
                'valor_recebido'    => gravarValorMoeda($request->input('valor_recebido')),
                'troco'             => gravarValorMoeda($request->input('troco')),
                'recebimento_tipo_id'  => $request->input('recebimento_tipo_id'),
                'comanda_status'  => 'F', 
            ]); 
       
            if($comandaUpdate){
                DB::commit();

                return response()->json([
                        'success'   => true,
                        'result' => $objComanda->id,
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

            //desativando despesa---------------------------
            $objComanda = Comanda::find($id);

            if($objComanda){            
           
              $comandaUpdate = $objComanda->update([
                'user_id'           => Auth::user()->id,
                'status'            => 'I',
              ]);

              if($comandaUpdate){               
                  DB::commit();

                  //desativando itens da despesa-----------------------
                  $listaComandaItens = ComandaItens::where('comanda_id',$id)->get();

                  if(count($listaComandaItens) > 0){

                    foreach ($listaComandaItens as $key => $value) {

                      $objComandaItem = ComandaItens::find($value->id);
                      if($objComandaItem){    

                        $despesaItemUpdate = $objComandaItem->update([
                          'user_id'           => Auth::user()->id,
                          'status'            => 'I',
                        ]);

                        if($despesaItemUpdate){             
                          DB::commit();   

                          //atualizando a quantidade no estoque---------------------------
                          $respAtualizaCard = $this->cardapioController->atualizaEstoque($objComandaItem->cardapio_id,'adicionar',$objComandaItem->quantidade);

                        }else{
                           DB::rollBack();
                        }
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
             $objComandaItem = ComandaItens::find($id);
            
            if($objComandaItem){            
           
              $despesaItemUpdate = $objComandaItem->update([
                'user_id'           => Auth::user()->id,
                'status'            => 'I',
              ]);

              if($despesaItemUpdate){  
               
                  DB::commit();

                  $respSomaDI = DB::select("call procedure_soma_comanda_itens(".$objComandaItem->comanda_id.")");

                  //atualizando a quantidade no estoque---------------------------
                  $respAtualizaCard = $this->cardapioController->atualizaEstoque($objComandaItem->cardapio_id,'adicionar',$objComandaItem->quantidade);

                  //----inserindo valor da comanda-------------------------------------
                  $objComanda = Comanda::find($objComandaItem->comanda_id);

                  $comandaUpdate = $objComanda->update([
                  'user_id'           => Auth::user()->id,
                  'valor'             => $respSomaDI[0]->total,
                  ]); 
             
                  if($comandaUpdate)
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


  public function montaListaComandas($despesaId)
  {

    $listaComandas = DB::select("call procedure_comanda_itens(".$despesaId.")");

    $lista = '';

    if(count($listaComandas) > 0){

      foreach ($listaComandas as $key => $value) {
        
        $lista .= '
          <tr id="tr_item_'.$value->comanda_item_id.'">
              <td>'.$value->comanda_item_id.'</td>
              <td>'.$value->produto.'</td>
              <td>'.$value->quantidade.'</td>                     
              <td>R$ '.number_format($value->valor, 2, ',', '.').'</td>
              <td>
                  <a href="javascript:void(0);" onclick="excluirRegistroItem('.$value->comanda_item_id.');"><i class="fa fa-fw fa-trash" style="color: #ff0000;" title="Excluir - '.$value->comanda_item_id.'"></i></a>
              </td>
          </tr>
        ';

      }

    }else{
      $lista .= '
        <tr>
            <td colspan="5" style="text-align: center">Nenhuma despesa localizada.</td>
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

            $query = Comanda::orderBy('created_at', 'DESC');

            $data = DataTables::of($query)
                    ->addIndexColumn()
                    ->editColumn('created_at', function ($data) {

                      $data_cadastro = '';
                      
                      if($data->created_at)
                        $data_cadastro = Carbon::parse($data->created_at)->format('d/m/Y H:i:s');

                      return $data_cadastro;
                    })
                    ->editColumn('updated_at', function ($data) {

                      $data_fechamento = '';
                      
                      if($data->updated_at)
                        $data_fechamento = Carbon::parse($data->updated_at)->format('d/m/Y H:i:s');

                      return $data_fechamento;
                    })

                    ->editColumn('cliente', function ($data) {

                     $objCliente = Cliente::find($data->cliente_id);

                     $nome_cliente = '';
                     if($objCliente)
                       $nome_cliente = $objCliente->nome;

                      return $nome_cliente;
                    })

                    ->editColumn('status', function ($data) {

                      return $data->comanda_status == 'A' ? 'Aberto' : 'Fechado';
                    })

                    ->editColumn('valor', function ($data) {

                     $valor = 'R$ '.number_format($data->valor_total, 2, ',', '.');

                      return $valor;
                    })

                    
                    ->addColumn('action', function($row){

                          $link = url("/bayareaadmin/comanda/edit").'/'.$row->id;
                         
                          $btn = '';


                           $btn .= '<a href="'.$link.'"><i class="fa fa-fw fa-edit" title="Editar Comanda do Cliente '.$row->nome.'"></i></a>';


                           $btn .= '<a href="javascript:void(0);" onclick="excluirRegistro('.$row->id.');"><i class="fa fa-fw fa-trash" style="color: #ff0000;" title="Excluir - '.$row->id.'"></i></a>';

                           


                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        //}
      
        return $data;
    }


    /*****store da despesa item****/

    public function storeComandaItem($request,$comandaInsertId)
    { 
        set_time_limit(0);

        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

        try{
            DB::beginTransaction(); 
            include_once(public_path() . '/assets/funcoes/funcoesGeral.php');                  

            $comandaItemInsert = ComandaItens::create([
                'user_id'           => Auth::user()->id,
                'comanda_id'        => $comandaInsertId,
                'cardapio_id'       => $request->input('cardapio_id'),
                'valor'             => (gravarValorMoeda($request->input('valor')) * $request->input('quantidade')),
                'quantidade'        => $request->input('quantidade'),
            ]);

            $somaTotalComandas = 0;

            if($comandaItemInsert){
                DB::commit();

                //subtraindo estoque-----------------------------------------------------
                $respAtualizaCard = $this->cardapioController->atualizaEstoque($request->input('cardapio_id'),'subtrair',$request->input('quantidade'));
                
                //alterando o valor total da comanda ao ir adicionando-------------------
                $respSomaDI = DB::select("call procedure_soma_comanda_itens(".$comandaInsertId.")");
                $somaTotalComandas = ($respSomaDI[0]->total + $request->input('valor'));

                $objComanda = Comanda::find($comandaInsertId);

                $comandaUpdate = $objComanda->update([
                  'user_id'           => Auth::user()->id,
                  'sub_total'         => $somaTotalComandas,
                  'valor_total'       => $somaTotalComandas,
                ]); 
           
                if($comandaUpdate)
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