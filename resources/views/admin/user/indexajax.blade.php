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
              <li><a href="{{ url('/bayareaadmin/cliente/index') }}">{{ $title }}</a></li>
              <li class="active">{{ $pagAction  }}</li>
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
                  @can('create_usuarios')
                  <a href="{{ url('/bayareaadmin/cliente/create') }}">
                    <button class="btn btn-block btn-info"> <i class="fa fa-save"></i> Cadastrar</button>
                  </a>
                  @endcan
                </div>
                <div class="col-lg-2 col-sm-4 col-xs-12">
                  @can('create_usuarios')
                  <a href="{{ url('/bayareaadmin/user/permission') }}">
                    <button class="btn btn-block btn-warning"> <i class="fa fa-cogs"></i> Permissões</button>
                  </a>
                  @endcan
                </div>
            </div>
          </p>
          <p class="text-muted m-b-30"></p>

          <div class="table-responsive">
                                <table class="table full-color-table full-inverse-table hover-table">
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
                                            <a href="{{ url('bayareaadmin/user/edit') }}/{{ $user->id }}"><i class="fa fa-fw fa-edit" title="Editar"></i></a>
                                            @endcan

                                            @can('delete_usuarios')
                                            <a href="javascript:void(0);" onclick="excluirRegistro({{ $user->id }});"><i class="fa fa-trash" title="Excluir" style="color: #ff0000;"></i></a>
                                            @endcan

                                          </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
      </div>
  </div>
</div>
@endsection
    
@push('scripts')
    
    
    <script src="{{ url('/assets_plugin_admin/plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>


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

 
</script>



@endpush