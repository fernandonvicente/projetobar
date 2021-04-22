@extends('admin.layout.template2')

@push('css')
    
@endpush


@section('content-header')
  <div class="row bg-title">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">{{ $title }}</h4>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          
          <ol class="breadcrumb">
              <li><a href="{{ url('/bayareaadmin') }}">Dashboard</a></li>
              <li><a href="{{ url('/bayareaadmin/comanda/index') }}">{{ $pagAction  }}</a></li>
              <li class="active">{{ $title }}</li>
          </ol>
      </div>
      <!-- /.col-lg-12 -->
  </div>
@endsection


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"> {{ $title }}</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    <p>
                        <div class="row">
                            <div class="col-lg-2 col-sm-4 col-xs-12">
                              <a href="{{ url('/bayareaadmin/cliente/create') }}">
                                <button class="btn btn-block btn-info"> <i class="fa fa-save"></i> Cadastrar Cliente</button>
                              </a>
                            </div>
                        </div>
                      </p>

                    <form action="javascript:void(0);" name="formComandaItem" id="formComandaItem" method="post" enctype="multipart/form-data" > 
                        {{ csrf_field() }}
                        <div class="form-body">
                            <h3 class="box-title">Cadastro</h3>

                            <hr>
                            @if($checkedRecebimentoTiposCombo == 'A')
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Cliente</label>
                                        
                                        {{ Form::select('cliente_id', $clientesCombo, $checkedCliente, ['placeholder' => 'Selecione...', 'class' => 'form-control ', 'id' => 'cliente_id', 'required' => 'required', 'tabindex' => '1', 'data-plugin-selectTwo' => 'data-plugin-selectTwo',
                                        $disabled => $disabled]) }}

                                        @if($checkedCliente)
                                            <input type="hidden" name="cliente_id" id="cliente_id" value="{{ $checkedCliente }}">
                                        @endif

                                    
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Cardápio</label>
                                        
                                        {{ Form::select('cardapio_id', $cardapiosCombo, $checkedCardapio, ['placeholder' => 'Selecione...', 'class' => 'form-control clearItem showCardapio', 'id' => 'cardapio_id', 'required' => 'required', 'tabindex' => '2', 'data-plugin-selectTwo' => 'data-plugin-selectTwo']) }}
                                    
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Quantidade</label>
                                        <input type="text" id="quantidade" name="quantidade" class="form-control number clearItem" placeholder="" value="" tabindex="3" >
                                    </div>
                                </div>

                                <!--/span-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Valor</label>
                                        <input type="text" id="valor" name="valor" class="form-control clearItem" placeholder="" value="0,00" tabindex="4" readonly>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label"></label>
                                        <p style="margin-top: 6px;">
                                            <input type="hidden" id="idRecord2" name="idRecord2" value="{{ $comanda_id }}">
                                            <input type="hidden" id="status_bt_item" name="status_bt_item" value="">
                                            <button type="submit" class="btn btn-warning btn-success-item" tabindex="5"> <i class="fa fa-plus"></i> Adicionar</button>
                                        </p>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            @endif
                            <!--/row-->
                    </form>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="table-responsive">
                                <table class="table color-bordered-table info-bordered-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Produto</th>
                                            <th>Qtidade</th>
                                            <th>Valor</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listaDespesas">

                                        @if($qtDespesas > 0)
                                            @foreach($listaComandas as $item)
                                                <tr id="tr_item_{{$item->comanda_item_id}}">
                                                    <td>{{$item->comanda_item_id}}</td>
                                                    <td>{{$item->produto}}</td>
                                                    <td>{{$item->quantidade}}</td>                     
                                                    <td>R$ {{$item->valor}}</td>
                                                    <td>
                                                        @if($checkedRecebimentoTiposCombo == 'A')
                                                        <a href="javascript:void(0);" onclick="excluirRegistroItem({{$item->comanda_item_id}});"><i class="fa fa-fw fa-trash" style="color: #ff0000;" title="Excluir - {{$item->comanda_item_id}}"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" style="text-align: center">Nenhuma item localizado.</td>
                                            </tr>
                                        @endif
                                        

                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th class="total_despesas">R$ {{ $total_despesas }}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>



                                </div>  
                            </div>
                    <form action="javascript:void(0);" name="formComanda" id="formComanda" method="post" enctype="multipart/form-data" > 
                         {{ csrf_field() }}
                            <!--/row-->
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        
                                        {{ Form::select('comanda_status', $comandaStatusCombo, $checkedComandaStatusCombo, ['placeholder' => 'Selecione...', 'class' => 'form-control clearItem showCardapio', 'id' => 'comanda_status', 'required' => 'required', 'tabindex' => '6', 'data-plugin-selectTwo' => 'data-plugin-selectTwo']) }}
                                    
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Recebimento</label>
                                        
                                        {{ Form::select('recebimento_tipo_id', $recebimentoTiposCombo, $checkedRecebimentoTiposCombo, ['placeholder' => 'Selecione...', 'class' => 'form-control clearItem showCardapio', 'id' => 'recebimento_tipo_id', 'required' => 'required', 'tabindex' => '7', 'data-plugin-selectTwo' => 'data-plugin-selectTwo']) }}
                                    
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label"></label>
                                        <p style="margin-top: 6px;">
                                            <!-- mostrar o anexo -->
                                        </p>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-3">
                                    <div class="form-group btn-final">
                                        <label class="control-label">Total</label>
                                        <input type="text" id="valor_total_final" name="valor_total_final" class="form-control " placeholder="" value="{{ $total_despesas }}" tabindex="8" readonly>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group btn-final">
                                        <label class="control-label">Valor Recebido</label>
                                        <input type="text" id="valor_recebido" name="valor_recebido" class="form-control money" placeholder="" tabindex="9" value="{{ $valor_recebido }}" required  disabled="{{ $troco_disabled }}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group btn-final">
                                        <label class="control-label">Troco</label>
                                        <input type="text" id="troco" name="troco" class="form-control " placeholder="" value="{{ $troco }}" tabindex="10" readonly>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            
                        </div>

                        <div class="form-actions text-right"> 
                            <input type="hidden" id="idRecord" name="idRecord" value="{{ $comanda_id }}">
                            <input type="hidden" id="status_bt" name="status_bt" value="">
                            <!--<button type="button" class="btn btn-default">Cancelar</button>-->
                            <button type="submit" class="btn btn-success btn-final-troco" tabindex="11"> <i class="fa fa-save"></i> Fechar Comanda</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ url('/assets_admin/js/script-comanda.js') }}"></script>

   


@endpush