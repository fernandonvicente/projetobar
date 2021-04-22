@extends('admin.layout.template')

@push('css')
    
@endpush

@section('content-header')
  <section class="content-header">
      <h1>
        Texto Modelo
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin::home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin::model.index') }}">Texto Modelo</a></li>
        <li class="active">{{$pagAction}}</li>
      </ol>
    </section> 
@endsection



@section('content')
  
<section class="content">

  @if(session()->has('message'))
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Alerta!</h4>
    {{ session()->get('message') }}
  </div>
  @endif




      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">{{$pagAction}}</h3>
        </div>
        <!-- /.box-header -->
       <div class="nav-tabs-custom">
 
                <form action="javascript:void(0);" name="formModel" id="formModel" method="post"> 
                {{ csrf_field() }}

                <div class="box-body">

                  <div id="alert-msg"></div><!-- alert-msg, recebe a mensagem da ação de cadastro  -->
             
                  <div class="row">
                    <div class="col-md-6"> 
                      <div class="form-group">
                        <label>* Nome texto modelo</label>
                        {{ Form::text('model_name', $model_name, ['id' => 'model_name','class' => 'form-control','placeholder' => 'Preencha o campo', 'required' => 'required', 'tabindex' => '1' ]) }}
                      </div>               
                    </div>

                    <!-- /.col -->
                    <div class="col-md-6">
                      
                    </div>
                    <!-- /.col -->
                  </div>

                </div>

        <!-- ####################################################################################### -->

        <div class="box-body">
            <div class="box-header">              
          
          <h2 class="page-header">
             Texto Modelo
          </h2>
        
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Descrição *</label>
                {{ Form::textarea('model_description', $model_description, ['id' => 'model_description','class' => 'form-control','placeholder' => 'Descreva...', 'required' => 'required' ]) }}
              </div> 

            </div>
            
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>

       
        <!-- ######################################################################################## -->

        <div class="box-body">
            <div class="box-header">              
          
          <h2 class="page-header">
            <i class="fa fa-check"></i> Status
          </h2>
        
            </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-md-6">   
              <div class="form-group">
                <label>* Ativo</label>
                {{ Form::select('status', $lista_ativo, $model_ativo_checked, ['placeholder' => 'Selecione um tipo cliente',
                                     'class' => 'form-control', 'id' => 'status', 'required' => 'required', 'tabindex' => '12']) }}
              </div>             
              
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>

        <!-- ###################################################################################### -->
        


        <!-- /.box-body -->
        <div class="box-footer">
          <div class="col-xs-12">    

            <input id="model_id" name="model_id" type="hidden" value="{{ $model_id}}">             
             
            <input id="status_bt" name="status_bt" type="hidden" value=""> 
            
            <button type="submit" class="btn btn-success pull-right" tabindex="36"><i class="fa fa-fw fa-save"></i> Salvar
            </button>

          </div>
        </div>
                </form>

              
          </div>
      <!-- /.box -->

      <!-- /.row -->
      </section>
@endsection

@push('scripts')
<script src="{{ url('/assets_admin/js/script-util.js') }}"></script>
<script src="{{ url('/assets_admin/ckeditor/ckeditor.js') }}" type="text/javascript" ></script>
<script src="{{ url('/assets_admin/ckeditor/adapters/jquery.js') }}" type="text/javascript" ></script>
<script src="{{ url('/assets_admin/js/script-model.js') }}"></script>


<script>
  $('#model_description').ckeditor();
  /*
function excluirRegistroCliente(idRegistro){
      if (confirm("Tem certeza que deseja excluir o registro?")) {

        var urlJs = $('#urlJs').val();//recuperando a url, para ser usada via ajax
        var urlAdmin = '/talkadmin/';

        var urlJsonGet = urlJs+urlAdmin+'client/delete/'+idRegistro;

        $.get(urlJsonGet, function (results) {
                  var objetos = results;

                  if(results.success){
                    alert('Exclusão realizada com sucesso!');
                    var novaURL = urlJs+"/talkadmin/client/indexFull/all";
                    $(window.document.location).attr('href', novaURL);
                  }else{
                    alert(results.result);
                    return false;
                  }
        
        });
        
      }
  }
*/

</script>
@endpush
