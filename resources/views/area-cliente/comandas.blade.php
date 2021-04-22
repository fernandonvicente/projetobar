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
  <div class="col-sm-12">
      <div class="white-box">
          <h3 class="box-title m-b-0"></h3>
          <p>
            <div class="row">
                <div class="col-lg-2 col-sm-4 col-xs-12">
              
                </div>
            </div>
          </p>
          <p class="text-muted m-b-30"></p>

          <div class="table-responsive">
              <table id="tb_datatable" class="display nowrap" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Valor</th>
                          <th>Status</th>
                          <th>Data Cadastro</th>
                          <th>Data Fechamento</th>
                          <th>Ações</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                          <th>ID</th>
                          <th>Valor</th>
                          <th>Status</th>
                          <th>Data Cadastro</th>
                          <th>Data Fechamento</th>
                          <th>Ações</th>
                      </tr>
                  </tfoot>
                  <tbody>
                      
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>

<!-- sample modal content -->
 @include('area-cliente.modal-comanda-itens')
<!-- /.modal -->

@endsection


@push('scripts')
    
    <script src="{{ url('/assets/js_cliente/script-cliente.js') }}"></script>
    <script src="{{ url('/assets_plugin_admin/plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>


<script type="text/javascript">

$(function () {

  //https://demos.laraget.com/images/loading2.gif
    
    //ao carregar página
   var table = $('#tb_datatable').DataTable({
    "order": [[0,'dsc']], //informa qual coluna inicia com ordenacao, neste caso estou removendo a primeiro coluna (0)
    oLanguage: {
          "sProcessing": "Carregando...",
          "sLengthMenu": "Mostrar _MENU_ registros por página",
          "sZeroRecords": "Nenhum registro encontrado",
          "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
          "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
          "sInfoFiltered": "(filtrado de _MAX_ registros)",
          "sSearch": "Pesquisar: ",
          "oPaginate": {
              "sFirst": "Início",
              "sPrevious": "Anterior",
              "sNext": "Próximo",
              "sLast": "Último"
          }
      },
      dom: 'Bfrtip',
        buttons: [
            
        ],
       processing: true,
       serverSide: true,
       ajax: {
           url: '{!! url("/area-cliente/comandas/carregaTabela") !!}',
           data: function ( d ) {
               //d.valorFiltroInput = $('#valorFiltroInput').val();
               // d.custom = $('#myInput').val();
               // etc
           }
       },
       columns: [
           {data: 'id', name: 'id'},  
           {data: 'valor', name: 'valor'}, 
           {data: 'status', name: 'status'}, 
           {data: 'created_at', name: 'created_at'},  
           {data: 'updated_at', name: 'updated_at'},
           {data: 'action', name: 'action', orderable: false, searchable: false},
       ]
   });

   
});

</script>  
@endpush