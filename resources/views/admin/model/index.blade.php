@extends('admin.layout.template')

@push('css')
    
@endpush

@section('content-header')
	<section class="content-header">
      <h1>
        Textos Modelos
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin::home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Textos Modelos</li>
        <li class="active">{{$pagAction}}</li>
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
              <h3 class="box-title">  
                <div class="col-xs-12">           
                  
                  <!-- botões -->
                  
                </div>
                
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Status</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($arrayModels as $model)
                <tr>
                  <td>{{$model->id}}</td>
                  <td>{{$model->name}}</td>
                  <td>{{$model->status}}</td>
                  <td>
                    <a href="{{ route('admin::model.edit', $model->id) }}"><i class="fa fa-fw fa-edit" title="Editar"></i></a> 
                    <a href="javascript:void(0);" onclick="excluirRegistro({{ $model->id }});"><i class="fa fa-trash" title="Excluir"></i></a>
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Status</th>
                  <th>Ações</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      </section>
@endsection
@push('scripts')
<!-- DataTables -->
<script src="{{ url('/assets_admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('/assets_admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script>

  function excluirRegistro(idRegistro){
    if (confirm("Tem certeza que deseja excluir o registro?")) {
      var id = idRegistro;
      // Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
      $.get('{{ url("/talkadmin/user/delete/") }}/' + id, function (resposta) {
        if(resposta=='Registro excluido com sucesso!')
          location.reload();
        else
          alert(resposta);
      });
    }
  }

  $(function () {
    $('#example1').DataTable({
        'order': [[0,'desc']],
        'aLengthMenu': [[50], [50]],
        'iDisplayLength': 50,
        scrollY: 2000,
        deferRender: true,
        scrollCollapse: true,
        scroller: {
          loadingIndicator: true
        },
        "oLanguage": {
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
    })

    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endpush

