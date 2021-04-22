
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
          <strong style="color: #ff0000;">Consultor: {{ $nomeConsultor }}</strong><br>
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
        <b>ID #{{ $cliente_id }}</b><br>
        <br>
        <strong>Telefone:</strong> {{ $telefone }}<br>
        <strong>Celular:</strong> {{ $celular }}<br>
        <strong>Antes e Depois:</strong> {{ $checkedSituacao }}<br>
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
            <th>Valor do Apontamento</th>
            <th>Total de Apontamentos</th>
            <th>Sócio ou Participações</th>
            <th>Serviço Contratado</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>{{ $valor_inicial_registro }}</td>
            <td>{{ $valor_total_registro }}</td>
            <td>{{ $checkedSocioOUparticipacoes }}</td>
            <td>{{ $checkedservicoContratado }}</td>
          </tr>
          </tbody>
        </table>
        
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-xs-12 table-responsive">
        <p class="lead">Sócio / Participação</p>
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Tipo Pessoa</th>
            <th>Documento</th>
            <th>Nome</th>
            <th>Valor Inicial</th>
            <th>Endereço</th>
          </tr>
          </thead>
          <tbody>
          @foreach($listsArrayFinanceiros as $socio_participante)
          <tr>
            <td>{{ $socio_participante->tipo_pessoa }}</td>
            <td>{{ $socio_participante->documento }}</td>
            <td>{{ $socio_participante->nome }}</td>
            <td>{{ $socio_participante->valor_inicial }}</td>
            <td>{{ $socio_participante->nome_socio_endereco }}</td>
          </tr>
          @endforeach
          </tbody>
        </table>

        <table class="table table-striped">
          <thead>
          <tr>
            <th>Valor do Consultor</th>
            <th>Valor da Empresa</th>
            <th>Valor do Contrato</th>
            <th>Tipo Contrato</th>
          </tr>
          </thead>
          <tbody>

          <tr>
            <td>{{ $custo_consultor }}</td>
            <td>{{ $custo_empresa }}</td>
            <td>{{ $custo_total }}</td>
            <td>{{ $checkedTipoContrato }}</td>
          </tr>
        
          </tbody>
        </table>
        
      </div>
      <!-- /.col -->
    </div>

    <div class="row">
      <div class="col-xs-12 table-responsive">
        <p class="lead">Descrição do Pagamento</p>
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Descrição da forma de pagamento</th>
          </tr>
          </thead>
          <tbody>

          <tr>
            <td>{{ $desc_forma_pagto }}</td>
          </tr>
        
          </tbody>
        </table>
        
      </div>
      <!-- /.col -->
    </div>

    <div class="row">
      <div class="col-xs-12 table-responsive">
        <p class="lead">Pagamento Empresa</p>
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Nº Parcelas</th>
            <th>Data Vencimento</th>
            <th>Valor</th>
            <th>Data Pagamento</th>
            <th>Pagou (sim/não)</th>
          </tr>
          </thead>
          <tbody>
          @foreach($listaArrayFinanceiraEmpresa as $financeiraEmpresa)
          <tr>
            <td>{{ $financeiraEmpresa->pos }}</td>
            <td>{{ $financeiraEmpresa->data_vencimento }}</td>
            <td>{{ $financeiraEmpresa->valor_vencimento }}</td>
            <td></td>
            <td></td>
          </tr>
          @endforeach
          </tbody>
        </table>
        
      </div>
      <!-- /.col -->
    </div>

    <div class="row">
      <div class="col-xs-12 table-responsive">
        <p class="lead">Pagamento Consultor</p>
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Nº Parcelas</th>
            <th>Data Vencimento</th>
            <th>Valor</th>
            <th>Data Pagamento</th>
            <th>Pagou (sim/não)</th>
          </tr>
          </thead>
          <tbody>
          @foreach($listaArrayFinanceiraConsultor as $financeiraConsultor)
          <tr>
            <td>{{ $financeiraConsultor->pos }}</td>
            <td>{{ $financeiraConsultor->data_vencimento }}</td>
            <td>{{ $financeiraConsultor->valor_vencimento }}</td>
            <td></td>
            <td></td>
          </tr>
          @endforeach
          </tbody>
        </table>
        
      </div>
      <!-- /.col -->
    </div>

    
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
