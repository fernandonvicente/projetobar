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
              <li><a href="{{ url('/bayareaadmin/despesa/index') }}">{{ $pagAction  }}</a></li>
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
            <div class="panel-heading"> Despesa</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    <form action="javascript:void(0);" name="formDespesaItem" id="formDespesaItem" method="post" enctype="multipart/form-data" > 
                        {{ csrf_field() }}
                        <div class="form-body">
                            <h3 class="box-title">Cadastro</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Despesa</label>
                                        
                                        {{ Form::select('despesa_tipo_id', $comboDespesas, $checkDespesa, ['placeholder' => 'Selecione uma opção',
                                                             'class' => 'form-control clearItem', 'id' => 'despesa_tipo_id', 'required' => 'required']) }}
                                    
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Cardápio</label>
                                        
                                        {{ Form::select('cardapio_id', $listaCardapio, $checkCardapio, ['placeholder' => 'Selecione uma opção',
                                                             'class' => 'form-control clearItem', 'id' => 'cardapio_id', 'required' => 'required']) }}
                                    
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Qtidade</label>
                                        <input type="text" id="quantidade" name="quantidade" class="form-control number clearItem" placeholder="" value="">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Valor</label>
                                        <input type="text" id="valor" name="valor" class="form-control money clearItem" placeholder="" value="">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label"></label>
                                        <p style="margin-top: 6px;">
                                            <input type="hidden" id="idRecord2" name="idRecord2" value="{{ $despesa_id }}">
                                            <input type="hidden" id="status_bt_item" name="status_bt_item" value="">
                                            <button type="submit" class="btn btn-warning btn-success-item"> <i class="fa fa-plus"></i> Adicionar</button>
                                        </p>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                    </form>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="table-responsive">
                                <table class="table color-bordered-table info-bordered-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Despesa</th>
                                            <th>Cardápio</th>
                                            <th>Qtidade</th>
                                            <th>Valor</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listaDespesas">

                                        @if($qtDespesas > 0)
                                            @foreach($listaDespesas as $item)
                                                <tr id="tr_item_{{$item->despesa_item_id}}">
                                                    <td>{{$item->despesa_item_id}}</td>
                                                    <td>{{$item->despesa_tipo}}</td>
                                                    <td>{{$item->cardapio}}</td>
                                                    <td>{{$item->quantidade}}</td>                     
                                                    <td>R$ {{$item->valor}}</td>
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="excluirRegistroItem({{$item->despesa_item_id}});"><i class="fa fa-fw fa-trash" style="color: #ff0000;" title="Excluir - {{$item->despesa_item_id}}"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" style="text-align: center">Nenhuma despesa localizada.</td>
                                            </tr>
                                        @endif
                                        

                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th id="total_despesas">R$ {{ $total_despesas }}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>



                                </div>  
                            </div>
                    <form action="javascript:void(0);" name="formDespesa" id="formDespesa" method="post" enctype="multipart/form-data" > 
                         {{ csrf_field() }}
                            <!--/row-->
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Descrição</label>
                                        <textarea class="form-control" rows="5" name="descricao" id="descricao">{{ $descricao }}</textarea>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Anexar NF</label>
                                        <input type="file" id="arquivo" name="arquivo" class="form-control" placeholder="" value="">
                                        @if($anexo)
                                        <p style="color: #ff0000;">
                                            <a href="{{ url('/bayareaadmin/despesa/download') }}/{{ $anexo }}">
                                            <i class="fa fa-paperclip"></i> Ver anexo
                                            </a> 
                                        </p>
                                        @endif
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
                            
                        </div>

                        <div class="form-actions text-right"> 
                            <input type="hidden" id="idRecord" name="idRecord" value="{{ $despesa_id }}">
                            <input type="hidden" id="status_bt" name="status_bt" value="">
                            <!--<button type="button" class="btn btn-default">Cancelar</button>-->
                            <button type="submit" class="btn btn-success btn-final"> <i class="fa fa-save"></i> Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ url('/assets_admin/js/script-despesa.js') }}"></script>

   


@endpush