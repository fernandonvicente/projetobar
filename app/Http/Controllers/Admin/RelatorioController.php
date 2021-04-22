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
use App\Models\All\Consultor;
use App\Models\All\ConsultoresHistorico;
use App\Models\All\ConsultoresTermo;
use App\Models\All\Banco;
use App\Models\All\ClienteArquivos;
use App\Models\All\ClienteSociosParticipante;
use App\Models\All\ClienteContrato;
use App\Models\All\ClienteContratoPagamento;
use App\Models\All\RoleUser;
use App\User;


use App\Models\View\ViewConsultores;
use App\Models\View\ViewClientes;
use App\Models\View\ViewClientesContratosSim;
use App\Models\View\ViewClientesContratosNao;


use Datatables;


class RelatorioController extends Controller
{
    private $mailController;

    private $stateModel;   
    
    private $qtRecordPage = 25;

    public $tipoPessoa = [
      'F' => 'Física',
      'J' => 'Jurídica',
    ];

    public $tipoContrato = [
      'SERASA' => 'SERASA',
      'SISBACEN' => 'SISBACEN',
      'SERASA E SISBACEN' => 'SERASA E SISBACEN',
      'PARCERIA' => 'PARCERIA',
      'REVISIONAL' => 'REVISIONAL',  
      'GOOGLE & MÍDIAS SOCIAIS' => 'GOOGLE & MÍDIAS SOCIAIS',     
    ];

    public $situacao = [
      'antes' => 'Sim',
      'depois' => 'Não',
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
    

    public function relatConsultor($id)
    {
      /*if(Gate::denies('view_relatorios')) {
            abort(404);
      }*/

      set_time_limit(0);

      include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

      $objConsultor = Consultor::find($id);

      $objEstado = State::find($objConsultor->uf);

      $objCidade = City::find($objConsultor->cidade);  
      //-------------------------------------------------------

      $states = State::get();
      $states = $states->pluck('name', 'uf')->toArray();
      //-------------------------------------------------------
      $bancos = Banco::get();
      $bancos = $bancos->pluck('banco', 'id')->toArray();
      //-------------------------------------------------------
      
      $cities = [];

      $listsArrayFiles = [];

      $listaConsultoresTermo = ConsultoresTermo::where('consultor_id',$objConsultor->id)
                                               ->orderBy('data_aceite','desc')->get();

      if($listaConsultoresTermo->count() > 0){
        foreach ($listaConsultoresTermo as $key => $value) {

          $dtArray = explode(' ',  $value->data_aceite);
          $dtArray2 = explode(' ',  $value->data_envia_aceite);

          $arrayConsultoresTermo[$key]['ip'] = $value->ip;

          if($value->data_aceite)
            $arrayConsultoresTermo[$key]['data_aceite'] = converteData($dtArray[0]).' '.$dtArray[1];
          else
            $arrayConsultoresTermo[$key]['data_aceite'] = '';

          $arrayConsultoresTermo[$key]['data_envia_aceite'] = converteData($dtArray2[0]).' '.$dtArray2[1];
          $arrayConsultoresTermo[$key]['file_name'] = $value->file_name;
        }

        $listsArrayFiles = json_decode(json_encode($arrayConsultoresTermo), FALSE);//convertendo array em objeto

      }

      //----------------------------------------------------------------------

        if($objConsultor->tipo_pessoa=='F'){                        
          $documento = Mask($objConsultor->documento,'###.###.###-##');
          $tipo_documento = 'PF';
        }else{
          $documento = Mask($objConsultor->documento,'##.###.###/####-##');
          $tipo_documento = 'PJ';
        }

        $data_rel = date("d/m/Y H:i:s");  
       
        $data = [    
               'consultor_id' => $objConsultor->id,
               'documento' => $documento,
               'tipo_documento' => $tipo_documento,
               'nome' => $objConsultor->nome, 
               'contato' => $objConsultor->contato,
               'email' => $objConsultor->email,                            
               'states' => $states,
               'checkedState' => $objEstado->uf,
               'tipoPessoa' => $this->tipoPessoa,
               'checkedTipoPessoa' => $objConsultor->tipo_pessoa,
               'cities' => $cities,
               'checkedCity' => $objCidade->name,
               'telefone' => $objConsultor->telefone,
               'celular' => $objConsultor->celular,
               'celular1' => $objConsultor->celular1,
               'cep' => $objConsultor->cep,
               'endereco' => $objConsultor->endereco,
               'num' => $objConsultor->num,
               'complemento' => $objConsultor->complemento,
               'bairro' => $objConsultor->bairro,  
               'tipoConta' => $this->tipoConta,
               'checkedTipo_1_conta' => $objConsultor->banco_1_tipo,
               'checkedTipo_2_conta' => $objConsultor->banco_2_tipo,
               'bancos' => $bancos,
               'checkedTipo_1_codbanco' => $objConsultor->banco_1_id,
               'checkedTipo_2_codbanco' => $objConsultor->banco_2_id,
               'banco_1_agencia' => $objConsultor->banco_1_agencia,
               'banco_2_agencia' =>  $objConsultor->banco_2_agencia,
               'banco_1_conta' => $objConsultor->banco_1_conta,
               'banco_2_conta' => $objConsultor->banco_2_conta, 
               'banco_1_documento' => $objConsultor->banco_1_documento, 
               'banco_2_documento' => $objConsultor->banco_2_documento,
               'arquivo' => $objConsultor->arquivo, 
               'observacao' => $objConsultor->observacao, 
               'totalAnexo' => $objConsultor->arquivo != '' ? 1 : '',    
               'listsArrayFiles' => $listsArrayFiles, 
               'data_rel' => $data_rel,      
        ]; 

      $title = 'Relatório de Consultor';
      $pagAction = 'Lista';

      return view('admin.relatorios.relatConsultorDetalhado', $data, compact('title','pagAction')); 
    }


    public function relatCliente($id)
    {
      //if(Gate::denies('edit_clientes')) {
            //abort(404);
      //}

      set_time_limit(0);

      include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

     /*if(Auth::user()->consultor_id)
        $objCliente = Cliente::where('id',$id)->where('consultor_id',Auth::user()->consultor_id)->get()->first();
      else*/
        $objCliente = Cliente::find($id);


      if(!$objCliente){
        abort(404);
      }

      if(Auth::user()->consultor_id)
        $clienteDoConsultor = Cliente::where('id',$id)->where('consultor_id',Auth::user()->consultor_id)->count();
      else
         $clienteDoConsultor = 1;

      $objEstado = State::find($objCliente->uf);

      $objCidade = City::find($objCliente->cidade);  
      //-------------------------------------------------------
      $consultores = Consultor::get();
      $consultores = $consultores->pluck('nome', 'id')->toArray();
      //-------------------------------------------------------
      $objConsultor = Consultor::find($objCliente->consultor_id);
      //--------------------------------------------------------------

      $states = State::get();
      $states = $states->pluck('name', 'uf')->toArray();
      //-------------------------------------------------------
      $cities = [];
 
      //---------------------------------------------------------------------
      $listsArrayFiles = Array();
      $qtListsFile = 0;
      if($objCliente->id){
        $listArquivos = ClienteArquivos::where('cliente_id',$objCliente->id)->get();

        $qtListsFile = count($listArquivos);

        foreach ($listArquivos as $key => $file) {

                $data_cadastro = '';
                if($file->created_at){
                  $dt = explode(' ', $file->created_at);

                  $data_cadastro = converteData($dt[0]).' '.$dt[1];
                }

                 //$file = public_path('assets/files/'.$file->arquivo);

                //identifica qual pasta está o arquivo-------------------------
                $sel_cat = $file->arquivo;
                $categoria = 'orcamento_'; 
                if(strpos("[".$sel_cat."]", "$categoria"))
                  $pasta = 'pdf';
                else
                  $pasta = '';
                //----------------------------------------------------------------
                
                $listsArrayFiles[$key]['id'] = $file->id;    
                $listsArrayFiles[$key]['arquivo'] = $file->arquivo;
                $listsArrayFiles[$key]['cadastro'] = $data_cadastro;  
                $listsArrayFiles[$key]['pasta'] =  $pasta;  

                /*
                if (file_exists($file)) {
                  $listsArrayFiles[$key]['arquivoExiste'] = true;  
                } else {
                    $listsArrayFiles[$key]['arquivoExiste'] = false;  
                } 
                */


        }

      
        $listsArrayFiles = json_decode(json_encode($listsArrayFiles), FALSE);//convertendo array em objeto

      }

      //----------------------------------------------------------------------
      $listsArrayFinanceiros = Array();
      $qtSocios = 0;
      if($objCliente->id){
        $listFinanceiros = ClienteSociosParticipante::where('cliente_id',$objCliente->id)->get();

        $qtSocios = count($listArquivos);

        foreach ($listFinanceiros as $key => $financeiro) {

                if($financeiro->tipo_pessoa=='F'){                        
                  $documento = Mask($financeiro->documento,'###.###.###-##');
                  $tipo_documento = 'PF';
                }else{
                  $documento = Mask($financeiro->documento,'##.###.###/####-##');
                  $tipo_documento = 'PJ';
                }
                
                $listsArrayFinanceiros[$key]['key'] = $financeiro->key;  
                $listsArrayFinanceiros[$key]['id'] = $financeiro->id;    
                $listsArrayFinanceiros[$key]['cliente_id'] = $financeiro->cliente_id;
                $listsArrayFinanceiros[$key]['tipo_pessoa'] = $tipo_documento;    
                $listsArrayFinanceiros[$key]['documento'] = $documento;    
                $listsArrayFinanceiros[$key]['nome'] = $financeiro->nome;  
                $listsArrayFinanceiros[$key]['nome_socio_endereco'] = $financeiro->endereco;  
                $listsArrayFinanceiros[$key]['valor_inicial'] = number_format($financeiro->valor_inicial, 2, ',', '.');         
        }

        
   
        $listsArrayFinanceiros = json_decode(json_encode($listsArrayFinanceiros), FALSE);//convertendo array em objeto

      }

      //valores das parcelas do contrato-------------------------------------------------------------

      $checkedTipoContrato = '';
      $contratoId = '';
      $desc_forma_pagto = '';
      $objContrato = ClienteContrato::where('cliente_id',$objCliente->id)->get()->first();
      if($objContrato){
        $checkedTipoContrato = $objContrato->tipo_contrato;
        $contratoId = $objContrato->id;
        $desc_forma_pagto = $objContrato->desc_forma_pagto;
      }

      //parte financeira da empresa-------------------------------------------
      $listFinanceiraEmpresa = ClienteContratoPagamento::where('cliente_id',$objCliente->id)
                                                         ->where('financeiro','empresa')->get();

      $arrayFinanceiraEmpresa = Array();          
      if($listFinanceiraEmpresa){

        $pos = 1;
        foreach ($listFinanceiraEmpresa as $key => $finacEmpresa) {
          $arrayFinanceiraEmpresa[$key]['id'] = $finacEmpresa->id;
          $arrayFinanceiraEmpresa[$key]['num_parcela'] = $finacEmpresa->num_parcela;
          $arrayFinanceiraEmpresa[$key]['valor_vencimento'] = number_format($finacEmpresa->valor_vencimento, 2, ',', '.');
          $arrayFinanceiraEmpresa[$key]['data_vencimento'] = converteData($finacEmpresa->data_vencimento);
          $arrayFinanceiraEmpresa[$key]['status_pagamento'] = $finacEmpresa->status_pagamento;
          $arrayFinanceiraEmpresa[$key]['pos'] = $pos;
          $arrayFinanceiraEmpresa[$key]['removerAddParcelasEmpresa'] = $pos != 1 ? 'removerAddParcelasEmpresa' : '';
          $pos++;
        }         

      }


      $listaArrayFinanceiraEmpresa = json_decode(json_encode($arrayFinanceiraEmpresa), FALSE);//convertendo array

      //parte financeira do consultor-------------------------------------------
      $listFinanceiraConsultor = ClienteContratoPagamento::where('cliente_id',$objCliente->id)
                                                         ->where('financeiro','consultor')->get();

      $arrayFinanceiraConsultor = Array();          
      if($listFinanceiraConsultor){

        $pos = 1;
        foreach ($listFinanceiraConsultor as $key => $finacConsultor) {
          $arrayFinanceiraConsultor[$key]['id'] = $finacConsultor->id;
          $arrayFinanceiraConsultor[$key]['num_parcela'] = $finacConsultor->num_parcela;
          $arrayFinanceiraConsultor[$key]['valor_vencimento'] = number_format($finacConsultor->valor_vencimento, 2, ',', '.');
          $arrayFinanceiraConsultor[$key]['data_vencimento'] = converteData($finacConsultor->data_vencimento);
          $arrayFinanceiraConsultor[$key]['status_pagamento'] = $finacConsultor->status_pagamento;
          $arrayFinanceiraConsultor[$key]['pos'] = $pos;
          $arrayFinanceiraConsultor[$key]['removerAddParcelasConsultor'] = $pos != 1 ? 'removerAddParcelasConsultor' : '';
          $pos++;
        }         

      }


      $listaArrayFinanceiraConsultor = json_decode(json_encode($arrayFinanceiraConsultor), FALSE);//convertendo array  

      //----------------------------------------------------------------------
        if($objCliente->tipo_pessoa=='F'){                        
          $documento = Mask($objCliente->documento,'###.###.###-##');
          $tipo_documento = 'PF';
        }else{
          $documento = Mask($objCliente->documento,'##.###.###/####-##');
          $tipo_documento = 'PJ';
        }

        $data_rel = date("d/m/Y H:i:s");

    

        $data = [    
               'cliente_id' => $objCliente->id,
               'contratoId' => $contratoId,
               'documento' => $documento,
               'tipo_documento' => $tipo_documento,
               'nome' => $objCliente->nome, 
               'contato' => $objCliente->contato,
               'email' => $objCliente->email,                            
               'states' => $states,
               'checkedState' => $objEstado->uf,
               'consultores' => $consultores,
               'checkedConsultor' => $objCliente->consultor_id,
               'nomeConsultor' => $objConsultor->nome,
               'tipoPessoa' => $this->tipoPessoa,
               'checkedTipoPessoa' => $objCliente->tipo_pessoa,
               'tipoContrato' => $this->tipoContrato,
               'checkedTipoContrato' =>  $checkedTipoContrato,
               'situacao' => $this->situacao,
               'checkedSituacao' => $objCliente->situacao,
               'desc_forma_pagto' => $desc_forma_pagto,               
               'cities' => $cities,
               'checkedCity' => $objCidade->name,
               'telefone' => $objCliente->telefone,
               'celular' => $objCliente->celular,
               'cep' => $objCliente->cep,
               'endereco' => $objCliente->endereco,
               'num' => $objCliente->num,
               'complemento' => $objCliente->complemento,
               'bairro' => $objCliente->bairro,
               'listsArrayFiles' => $listsArrayFiles,
               'qtListsFile' => $qtListsFile,
               'socioOUparticipacoes' => $this->sim_e_nao,
               'checkedSocioOUparticipacoes' => $objCliente->socio_participacoes == 'N' ? 'NÃO' : 'SIM',
               'servicoContratado' => $this->sim_e_nao,
               'checkedservicoContratado' => $objCliente->servico_contratado == 'N' ? 'NÃO' : 'SIM',
               'valor_inicial_registro' => number_format($objCliente->valor_inicial_registro, 2, ',', '.'),
               'valor_total_registro' => number_format($objCliente->valor_total_registro, 2, ',', '.'),
               'qtSocios' => $qtSocios,
               'listsArrayFinanceiros' => $listsArrayFinanceiros, 
               'listaArrayFinanceiraConsultor' => $listaArrayFinanceiraConsultor, 
               'listaArrayFinanceiraEmpresa' => $listaArrayFinanceiraEmpresa, 
               'tipoPagamento' => $this->sim_e_nao,
               'custo_consultor' => number_format($objCliente->custo_consultor, 2, ',', '.'),
               'custo_empresa' => number_format($objCliente->custo_empresa, 2, ',', '.'),
               'custo_total' => number_format($objCliente->custo_total, 2, ',', '.'),
               'qtParcelasEmpresa' => count($arrayFinanceiraEmpresa) == 0 ? 1 : count($arrayFinanceiraEmpresa),
               'qtParcelasConsultor' => count($arrayFinanceiraConsultor) == 0 ? 1 : count($arrayFinanceiraConsultor), 
               'clienteDoConsultor' => $clienteDoConsultor,
               'data_rel' => $data_rel, 
        ]; 

      $title = 'Relatório do Cliente';
      $pagAction = 'Lista';

        return view('admin.relatorios.relatClienteDetalhado', $data, compact('title','pagAction'));  
    }

    public function relatConsultorAjax(Request $request)
    {
      if(Gate::denies('view_relatorios')) {
            abort(404);
      }

      set_time_limit(0);

      include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

      $title = 'Relatório de Consultores';
      $pagAction = 'Lista';

      return view('admin.relatorios.relatConsultorAjax', compact('title','pagAction')); 
    }



  public function carregaTabelaConsultor(Request $request)
  {
      if(Gate::denies('view_relatorios')) {
            abort(404);
      }

        set_time_limit(0);

        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');
        
        //if ($request->ajax()) {
        if(Auth::user()->consultor_id)
            $query = ViewConsultores::where('status','Ativo')
                                      ->where('id',Auth::user()->consultor_id)
                                      ->orderBy('nome', 'asc')->get();  
        else
            $query = ViewConsultores::where('status','Ativo')->orderBy('nome', 'asc')->get();  
      
            $data = Datatables::of($query)
                    ->addIndexColumn()
                    ->editColumn('data_cadastro', function ($data) {
                      $data_cadastro = '';
                      if($data->data_cadastro){
                        $dt = explode(' ', $data->data_cadastro);

                        $data_cadastro = converteData($dt[0]).' '.$dt[1];
                      }

                      return $data_cadastro;
                    })
                    ->addColumn('action', function($row){

                            /*
                           $link = url("/bayareaadmin/consultor/edit").'/'.$row->id;
   
                           $btn = '<a href="'.$link.'"><i class="fa fa-fw fa-edit" title="Editar '.$row->id.'"></i></a>';

                           $btn .= '<a href="javascript:void(0);" onclick="excluirRegistro('.$row->id.');"><i class="fa fa-fw fa-trash" style="color: #ff0000;" title="Excluir - '.$row->id.'"></i></a>';
                          if($row->email){
                            $btn .= '<a href="javascript:void(0);" onclick="enviarTermo('.$row->id.');"><i class="fa fa-fw fa-send" style="color: #4caf50;" title="Enviar Termo de - '.$row->nome.'"></i></a>';
                          }else{
                            $btn .= '<a href="javascript:void(0);"><i class="fa fa-fw fa-send" style="color: #ffeb3b;" title="CONSULTOR SEM EMAIL DE ENVIO"></i></a>';
                          }
                          */

                          $btn = '';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        //}
      
        return $data;
    }

   public function relatClienteAjax(Request $request)
   {

      if(Gate::denies('view_relatorios')) {
            abort(404);
      }

      set_time_limit(0);

      include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

      $title = 'Relatório de Clientes';
      $pagAction = 'Lista';

      $listConsultoresTermoAceito = ConsultoresTermo::where('status','A')->where('consultor_id',Auth::user()->consultor_id)->get();

      if(Auth::user()->consultor_id){
        if($listConsultoresTermoAceito->count() > 0)
          $msgAceitarTermo = false;
        else
          $msgAceitarTermo = true;
      }else{
        $msgAceitarTermo = false;
      }

      return view('admin.relatorios.relatClienteAjax', compact('title','pagAction','msgAceitarTermo')); 
    }

  public function carregaTabelaCliente(Request $request)
  {
      if(Gate::denies('view_relatorios')) {
            abort(404);
      }
        set_time_limit(0);

        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');
        
        //if ($request->ajax()) {

        if(Auth::user()->consultor_id){
  

          $listConsultoresTermoAceito = ConsultoresTermo::where('status','A')->where('consultor_id',Auth::user()->consultor_id)->get();

          if($listConsultoresTermoAceito->count() > 0){
            if(Auth::user()->consultor_id)
              $query = ViewClientes::where('status','A')
                                    ->where('id_consultor',Auth::user()->consultor_id)
                                    ->orderBy('nome', 'asc')->get();
         
          }else{
            $query = Array();
          }

        }else{

          if($request->input('bt_pesquisa')=='ok'){
              $start = $request->input('data_inicial');
              $end = $request->input('data_final');
       
              $query = ViewClientes::where('status','A')
                                   ->whereBetween('data_cadastro', [$start, $end])
                                   ->orderBy('nome', 'asc')->get();

          }else{
            $query = ViewClientes::where('status','A')->orderBy('nome', 'asc')->get();
          }

        } 
        
            $data = Datatables::of($query)
                    ->addIndexColumn()
                    ->editColumn('documento', function ($data) {
                      
                      if($data->tipo_pessoa=='F'){                        
                        $documento = Mask($data->documento,'###.###.###-##');
                      }else{
                        $documento = Mask($data->documento,'##.###.###/####-##');
                      }
                      return $documento;
                    })
                    ->editColumn('servico_contratado', function ($data) {
                      
                      $servico_contratado = $data->servico_contratado == 'S' ? 'Sim' : 'Não';

                      return $servico_contratado;
                    })
                    ->editColumn('data_cadastro', function ($data) {

                      $dtAux = explode(' ', $data->data_cadastro);
                      
                      $data_cadastro = converteData($dtAux[0]).' '.$dtAux[1];

                      return $data_cadastro;
                    })
                    ->addColumn('action', function($row){
                          /*
                           $link = url("/bayareaadmin/cliente/edit").'/'.$row->id;
   
                           $btn = '<a href="'.$link.'"><i class="fa fa-fw fa-edit" title="Editar '.$row->id.'"></i></a>';

                           $btn .= '<a href="javascript:void(0);" onclick="excluirRegistro('.$row->id.');"><i class="fa fa-fw fa-trash" style="color: #ff0000;" title="Excluir - '.$row->id.'"></i></a>';
                          */

                           $btn = '';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        //}
      
        return $data;
    }

    public function relatClienteContratosSimAjax(Request $request)
    {
      set_time_limit(0);

      include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

      $title = 'Relatório de Clientes Contrato Sim';
      $pagAction = 'Lista';

      $listConsultoresTermoAceito = ConsultoresTermo::where('status','A')->where('consultor_id',Auth::user()->consultor_id)->get();

      if(Auth::user()->consultor_id){
        if($listConsultoresTermoAceito->count() > 0)
          $msgAceitarTermo = false;
        else
          $msgAceitarTermo = true;
      }else{
        $msgAceitarTermo = false;
      }

      return view('admin.relatorios.relatClienteContratosSimAjax', compact('title','pagAction','msgAceitarTermo')); 
    }

  public function carregaTabelaClienteContratosSim(Request $request)
  {
        set_time_limit(0);

        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');
        
        //if ($request->ajax()) {

        if(Auth::user()->consultor_id){

          $listConsultoresTermoAceito = ConsultoresTermo::where('status','A')->where('consultor_id',Auth::user()->consultor_id)->get();

          if($listConsultoresTermoAceito->count() > 0){
            if(Auth::user()->consultor_id)
              $query = ViewClientesContratosSim::where('status','A')
                                   ->where('id_consultor',Auth::user()->consultor_id)
                                   ->orderBy('nome', 'asc')->get();
         
          }else{
            $query = Array();
          }

        }else{
          $query = ViewClientesContratosSim::where('status','A')->orderBy('nome', 'asc')->get();
        }     

            $data = Datatables::of($query)
                    ->addIndexColumn()
                    ->editColumn('documento', function ($data) {
                      
                      if($data->tipo_pessoa=='F'){                        
                        $documento = Mask($data->documento,'###.###.###-##');
                      }else{
                        $documento = Mask($data->documento,'##.###.###/####-##');
                      }
                      return $documento;
                    })
                    ->editColumn('servico_contratado', function ($data) {
                      
                      $servico_contratado = $data->servico_contratado == 'S' ? 'Sim' : 'Não';

                      return $servico_contratado;
                    })
                    ->editColumn('data_cadastro', function ($data) {

                      $dtAux = explode(' ', $data->data_cadastro);
                      
                      $data_cadastro = converteData($dtAux[0]).' '.$dtAux[1];

                      return $data_cadastro;
                    })

                    ->addColumn('action', function($row){
                          /*
                           $link = url("/bayareaadmin/cliente/edit").'/'.$row->id;
   
                           $btn = '<a href="'.$link.'"><i class="fa fa-fw fa-edit" title="Editar '.$row->id.'"></i></a>';

                           $btn .= '<a href="javascript:void(0);" onclick="excluirRegistro('.$row->id.');"><i class="fa fa-fw fa-trash" style="color: #ff0000;" title="Excluir - '.$row->id.'"></i></a>';
                          */

                           $btn = '';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        //}
      
        return $data;
    }

    public function relatClienteContratosNaoAjax(Request $request)
    {
      set_time_limit(0);

      include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

      $title = 'Relatório de Clientes Contrato Não';
      $pagAction = 'Lista';

      $listConsultoresTermoAceito = ConsultoresTermo::where('status','A')->where('consultor_id',Auth::user()->consultor_id)->get();

      if(Auth::user()->consultor_id){
        if($listConsultoresTermoAceito->count() > 0)
          $msgAceitarTermo = false;
        else
          $msgAceitarTermo = true;
      }else{
        $msgAceitarTermo = false;
      }

      return view('admin.relatorios.relatClienteContratosNaoAjax', compact('title','pagAction','msgAceitarTermo')); 
    }

  public function carregaTabelaClienteContratosNao(Request $request)
  {
        set_time_limit(0);

        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');
        
        //if ($request->ajax()) {

        if(Auth::user()->consultor_id){

          $listConsultoresTermoAceito = ConsultoresTermo::where('status','A')->where('consultor_id',Auth::user()->consultor_id)->get();

          if($listConsultoresTermoAceito->count() > 0){
            if(Auth::user()->consultor_id)
              $query = ViewClientesContratosNao::where('status','A')
                                   ->where('id_consultor',Auth::user()->consultor_id)
                                   ->orderBy('nome', 'asc')->get();
         
          }else{
            $query = Array();
          }

        }else{
          $query = ViewClientesContratosNao::where('status','A')->orderBy('nome', 'asc')->get();
        }     

            $data = Datatables::of($query)
                    ->addIndexColumn()
                    ->editColumn('documento', function ($data) {
                      
                      if($data->tipo_pessoa=='F'){                        
                        $documento = Mask($data->documento,'###.###.###-##');
                      }else{
                        $documento = Mask($data->documento,'##.###.###/####-##');
                      }
                      return $documento;
                    })
                    ->editColumn('servico_contratado', function ($data) {
                      
                      $servico_contratado = $data->servico_contratado == 'S' ? 'Sim' : 'Não';

                      return $servico_contratado;
                    })
                    ->editColumn('data_cadastro', function ($data) {

                      $dtAux = explode(' ', $data->data_cadastro);
                      
                      $data_cadastro = converteData($dtAux[0]).' '.$dtAux[1];

                      return $data_cadastro;
                    })

                    ->addColumn('action', function($row){
                          /*
                           $link = url("/bayareaadmin/cliente/edit").'/'.$row->id;
   
                           $btn = '<a href="'.$link.'"><i class="fa fa-fw fa-edit" title="Editar '.$row->id.'"></i></a>';

                           $btn .= '<a href="javascript:void(0);" onclick="excluirRegistro('.$row->id.');"><i class="fa fa-fw fa-trash" style="color: #ff0000;" title="Excluir - '.$row->id.'"></i></a>';
                          */

                           $btn = '';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        //}
      
        return $data;
    }


 


}
