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
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"> Cliente</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    @if($formAction=='create')
                     <form action="{{ url('bayareaadmin/user/store') }}" method="post" id="form_submit" name="form_submit" autocomplete="off" enctype="multipart/form-data">
                    @else
                      <form action="{{ url('bayareaadmin/user/update') }}/{{ $id }}" method="post" id="form_submit" name="form_submit" autocomplete="off" enctype="multipart/form-data">
                    @endif

                    {{ csrf_field() }}

                        <div class="form-body">
                            <h3 class="box-title">Cadastro</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ocultarUploadImagem">
                                        <label class="control-label">Nome</label>
                                        {{ Form::text('name', $name, ['id' => 'name','class' => 'form-control','placeholder' => 'Preencha o nome', 'required' => 'required' ]) }}
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Senha</label>
                                        <input class="form-control" name="password" id="password" placeholder="******" type="password" {{$required_password}}>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">E-mail</label>
                                        {{ Form::email('email', $email, ['id' => 'email','class' => 'form-control','placeholder' => 'Preencha o e-mail', 'required' => 'required' ]) }}
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        @if(Auth::user()->id == 68)
                                        <label>Tipo de Usuário</label>
                                        {{ Form::select('role', $listRoles, $selectdRole, ['placeholder' => 'Selecione uma opção',
                                                             'class' => 'form-control', 'id' => 'role', 'required' => 'required']) }}
                                        @else
                                        <input type="hidden" name="role" name="role" value="{{ $selectdRole }}">
                                        @endif
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            
                        </div>
                        <div class="form-actions text-right"> 
                            <input id="totalImagens" name="totalImagens" type="hidden" value="{{ $totalImage }}" />
                            <input id="stautsImagem" name="stautsImagem" type="hidden" value="">
                            <input id="nomeImagem" name="nomeImagem" type="hidden" value="{{ $avatar }}">
                            <input id="idRecord" name="idRecord" type="hidden" value="{{ $id }}">
                            
                            <input id="page" name="page" type="hidden" value="{{ $numberPage }}">  
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Salvar</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    
@endpush