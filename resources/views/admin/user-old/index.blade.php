@extends('admin.layout.template')

@push('css')
    
@endpush

@section('content-header')
	<section class="content-header">
      <h1>
        Usuários
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('bayareaadmin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Usuários</li>
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
                  
                  @can('edit_permissao_usuarios')
                  <a href="{{ url('/bayareaadmin/user/permission') }}">
                    <button type="button" class="btn btn-warning pull-right" style="margin-left: 20px;"><i class="fa fa-cogs"></i> Permissões
                    </button>
                  </a>
                  @endcan
                  
                  @can('create_usuarios')
                  <a href="{{ url('bayareaadmin/user/create') }}">
                    <button type="button" class="btn btn-info pull-right"><i class="fa fa-fw fa-plus"></i> Cadastrar
                    </button>
                  </a>
                  @endcan
                  
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
                  <th>E-mail</th>
                  <th>Status</th>
                  <th>Tipo</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                  <td>{{$user->id}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->status}}</td>
                  <td>{{$user->role_name}}</td>
                  <td>
                    
                    @can('edit_usuarios')
                    <a href="{{ url('bayareaadmin/user/edit') }}"><i class="fa fa-fw fa-edit" title="Editar"></i></a>
                    @endcan

                    @can('delete_usuarios')
                    <a href="javascript:void(0);" onclick="excluirRegistro({{ $user->id }});"><i class="fa fa-trash" title="Excluir"></i></a>
                    @endcan

                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Status</th>
                  <th>Tipo</th>
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
      $.get('{{ url("/bayareaadmin/user/delete/") }}/' + id, function (resposta) {
        if(resposta=='Registro excluido com sucesso!')
          location.reload();
        else
          alert(resposta);
      });
    }
  }

  $(function () {
    $('#example1').DataTable({
        'order': [[1,'asc']],
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

