@extends('admin.layout.template_cliente')

@push('css')

<style>
    div.scroll {
        margin:5px;
        padding:5px;
        height: 510px;
        overflow: auto;
        text-align:justify;
    }
</style>

@endpush

@section('content-header')
  <div class="row bg-title">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">{{ $title }}</h4>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          
          <ol class="breadcrumb">
              <li><a href="javascript:void(0);">{{ $pagAction  }}</a></li>
              <li class="active">{{ $title }}</li>
          </ol>
      </div>
      <!-- /.col-lg-12 -->
  </div>
@endsection

@section('content')

<div class="row">
    <div class="col-md-9 col-lg-9 col-sm-7">
        <div class="panel panel-info">
            <div class="panel-heading"> Verifique nosso cardápio</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    <div class="table-responsive scroll">
                        <table class="table product-overview">
                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th>Produto</th>
                                    <th>Preço</th>
                                    <th style="text-align:center">Sessão</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($lista_cardapio_com_estoque as $item)
                                <tr>
                                    <td width="150">
                                        <img src="{{ url('/assets_plugin_admin/plugins/images/sem-imagem.jpg') }}" alt="iMac" width="80">
                                    </td>
                                    <td width="550">
                                        <h5 class="font-500">{{ $item->produto }}</h5>
                                        <!-- <p>descrição</p> -->
                                    </td>
                                    <td width="100">R$ {{ $item->preco }}</td>                                  
                                    <td class="font-500" align="center">
                                      <span class="label label-warning font-weight-100" style="color: #000;">{{ $item->categoria }}</span>
                                    </td>
                                    
                                </tr>
                                @endforeach
                                
                              
                            
                            </tbody>
                        </table>
                        <hr>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-lg-3 col-sm-5">
        <div class="white-box">
            <h3 class="box-title">Comanda aberta</h3>
            <hr> <small>Preço Total</small>
            <h2>R$ 80,88</h2>
            <hr>
            <button class="btn btn-success model_img img-responsive" data-toggle="modal" data-target=".bs-example-modal-lg">Conferir</button>

            <!-- <button class="btn btn-default btn-outline">Cancel</button> -->
        </div>
    </div>

</div>

<!-- sample modal content -->
 @include('area-cliente.modal-comanda-itens')
<!-- /.modal -->

@endsection


@push('scripts')
@endpush