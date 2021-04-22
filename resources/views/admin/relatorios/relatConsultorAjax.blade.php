@extends('admin.layout.template')

@section('title') {{ $title }} - Gerenciamento Antena @endsection

@push('css')
    
@endpush

@section('content-header')
  <section class="content-header">
      <h1>
        {{ $title }} <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title=""></span>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin::home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{{ $title }}</li>
      </ol>
    </section>
@endsection

@section('content')
<section class="content">

  @if(session()->has('message'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Alerta!</h4>
    {{ session()->get('message') }}
  </div>
  @endif

  <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

              <!--
              <h3 class="box-title">
                  <a href="{{ route('admin::consultor.create') }}"> 
                    <button type="button" class="btn btn-info pull-right"><i class="fa fa-fw fa-plus"></i> Cadastrar
                    </button>
                  </a>
              </h3>
              
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 300px;">
                  <input type="text" name="name_search" id="name_search" class="form-control pull-right" placeholder="Busca por: ID / Nome Fantasia / CNPJ / Cidade / UF" title="Busca por: ID / Nome Fantasia / CNPJ / Cidade / UF" onkeyup="capturarEnter(event);">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default clientsSearch">
                      <i class="fa fa-search btSearch"></i>
                      <i class="fa fa-refresh fa-spin btLoadingSearch" style="display: none;"></i>
                    </button>
                  </div>
                </div>
              </div>
            -->
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">

              <table class="table table-bordered data-table" id="tb_datatable">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Nome</th>
                          <th>Email</th>
                          <th>Telefone</th>
                          <th>Celular</th>
                          <th>Cidade</th>    
                          <th>UF</th>       
                          <th>Cadastro</th>                             
                          <th>Ações</th>
                      </tr>
                  </thead>

                  <thead class="filters">
                        <tr>
                            <td class="no-filter">ID</td>
                            <td>Nome</td>
                            <td class="no-filter">Email</td>
                            <td class="no-filter">Telefone</td>
                            <td class="no-filter">Celular</td>
                            <td>Cidade</td>    
                            <td>UF</th>       
                            <td>Cadastro</td>                             
                            <td class="no-filter">Ações</td>
                        </tr>
                    </thead> 


                  <tbody>
                  </tbody>
              </table>

            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix clearPagination" style="text-align: right;">
              
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      </section>
@endsection


@push('scripts')
<!--
<script src="{{ url('/assets_admin/js/script-consultor.js') }}"></script>
-->

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>



<script type="text/javascript">

$(function () {

  //https://demos.laraget.com/images/loading2.gif

    var aItem = new Array();
    var aLabel = new Array();

    var pageLength = 6;
    for (var i = 1; i < 12; i++) {
        var j = i * pageLength;
        aItem.push(j);
        aLabel.push(j);
    }
    aItem.push(-1);
    aLabel.push("Todos");
    
    //ao carregar página
   var table = $('#tb_datatable').DataTable({
    "order": [[1,'asc']], //informa qual coluna inicia com ordenacao, neste caso estou removendo a primeiro coluna (0)
    'aLengthMenu': [aItem, aLabel],
    'iDisplayLength': 30,
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
       processing: true,
       serverSide: true,
       ajax: {
           url: '{!! url("/bayareaadmin/relatorio/carregaTabelaConsultor") !!}',
           data: function ( d ) {
               //d.valorFiltroInput = $('#valorFiltroInput').val();
               // d.custom = $('#myInput').val();
               // etc
           }
       },
       columns: [
           {data: 'id', name: 'id'},
           {data: 'nome', name: 'nome'},
           {data: 'email', name: 'email'},
           {data: 'telefone', name: 'telefone'},
           {data: 'celular', name: 'celular'},           
           {data: 'cidade', name: 'cidade'},
           {data: 'uf', name: 'uf'},
           {data: 'data_cadastro', name: 'data_cadastro'},
           {data: 'action', name: 'action', orderable: false, searchable: false},
       ]
   });

   //inicio da pesquisa por coluna---------------------------------------------------------------------
   // Setup - add a text input to each footer cell
    $('.filters td').each( function () {
        var title = $(this).text();        

        if(!$(this).hasClass('no-filter')){
            var nome_campo = 'Pesquisar';//title
            $(this).html( '<input type="text" class="form-control '+nome_campo+'" placeholder="Pesquisar" />' );
        }else{
            $(this).html(""); 
        }

    } );

    // DataTable
    var table = $('#tb_datatable').DataTable();

    table.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', $('.filters td')[colIdx] ).on( 'keyup change', function () {
            table
            .column( colIdx )
            .search( this.value )
            .draw();
        } );
    } );
    //fim da pesquisa por coluna---------------------------------------------------------------------

    //inicio dos botões--------------------------------------------------------------------------------
    new $.fn.dataTable.Buttons( table, {
        buttons: [
            'print',
            'excel',
        ],
    } );

    table.buttons( 0, null ).container().prependTo(
        table.table().container()
    );
    //fim dos botões--------------------------------------------------------------------------------



});

</script>


@endpush

