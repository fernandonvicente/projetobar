
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ $title }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="apple-touch-icon" href="{{ url('/assets/icones/favicon.ico') }}">
  <link rel="icon" type="image/png" href="{{ url('/assets/icones/favicon.ico') }}">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- onload="window.print();" -->
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          {{ $title }}
          <small class="pull-right">Date: {{ $data_rel }}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        
        <address>
          <strong>{{ $nome }}</strong><br>
          <strong>Documento (CPF/CNPJ):</strong> {{ $documento }} / <strong>{{ $tipo_documento }}</strong><br>
          <strong>Contato:</strong> {{ $contato }}<br>
          <strong>E-mail:</strong> {{ $email }}<br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        
        <address>
         <strong>CEP:</strong> {{ $cep }}<br>
          <strong>Endereço:</strong> {{ $endereco }}, <strong>Nº:</strong> {{ $num }}<br>
          <strong>Complemento:</strong> {{ $complemento }}<br>
          <strong>Bairro:</strong> {{ $bairro }}<br>
          <strong>Cidade:</strong> {{ $checkedCity }} <strong>Estado:</strong> {{ $checkedState }}<br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>ID #{{ $consultor_id }}</b><br>
        <br>
        <strong>Telefone:</strong> {{ $telefone }}<br>
        <strong>Celular:</strong> {{ $celular }}<br>
        <strong>Celular1:</strong> {{ $celular1 }}<br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <p class="lead">Financeiro</p>
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Doc. 1</th>
            <th>Banco 1</th>
            <th>Tipo Conta 1</th>
            <th>Ag. 1</th>
            <th>Conta 1</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>{{ $banco_1_documento }}</td>
            <td>{{ $checkedTipo_1_codbanco }}</td>
            <td>{{ $checkedTipo_1_conta }}</td>
            <td>{{ $banco_1_agencia }}</td>
            <td>{{ $banco_1_conta }}</td>
          </tr>
          </tbody>
        </table>
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Doc. 2</th>
            <th>Banco 2</th>
            <th>Tipo Conta 2</th>
            <th>Ag. 2</th>
            <th>Conta 2</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>{{ $banco_2_documento }}</td>
            <td>{{ $checkedTipo_2_codbanco }}</td>
            <td>{{ $checkedTipo_2_conta }}</td>
            <td>{{ $banco_2_agencia }}</td>
            <td>{{ $banco_2_conta }}</td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
