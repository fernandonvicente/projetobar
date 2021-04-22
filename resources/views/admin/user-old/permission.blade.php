@extends('admin.layout.template')

@section('title') {{ $title }} - Gerenciamento Antena @endsection

@push('css')
    
@endpush

@section('content-header')
  <section class="content-header">
      <h1>
        {{ $title }}
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

  {{ Form::open(['route' => ['admin::user.createProfilePermission'], 'files' => true, 'role' => 'form', 'id' => 'form_submit', 'autocomplete' => 'off']) }}

  <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>

              <div class="col-xs-4">           
                  
                  <button type="submit" class="btn btn-success pull-left"><i class="fa fa-fw fa-save"></i> Salvar
                  </button>
                  
                </div>
                <div class="col-xs-4">           
                  
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" id="btMarcarDesmarcar">
                      Marcar/Desmarcar
                    </label>
                  </div>

                </div>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 300px;">
                  
                  {{ Form::select('role', $listRoles, $selectdRole, ['placeholder' => 'Selecione um perfil',
                                     'class' => 'form-control', 'id' => 'role', 'required' => 'required']) }}

                  <div class="input-group-btn">
                    
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                <tr>
                  <th>Sessão</th>
                  <th>Visualizar</th>
                  <th>Cadastrar</th>
                  <th>Editar</th>
                  <th>Excluir</th>
                </tr>

                {!!html_entity_decode($tr)!!}
                
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
  </div>
  {!! Form::close() !!}
      </section>
@endsection
@push('scripts')
<script src="{{ url('/assets_admin/js/script-user.js') }}"></script>

<script>
$('#btMarcarDesmarcar').click(function(){
    
    if ( $(this).is(':checked') ){
      //marcar
      $('.checkbox').prop("checked", true);
     // $('.vSwitch').addClass('on');
    }else{
      //desmarca
      $('.checkbox').prop("checked", false);
     // $('.vSwitch').removeClass('on');
    }
  });
</script>


@endpush

