<!DOCTYPE html>
<html>
<head>
  <title>Confirmação de Cadastro</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
  <center>
    <table width="600" height="" border="0" cellpadding="0" cellspacing="0">
      <tr width="600" height="150">
        <td width="600" height="150">
          <img src="http://gruporecuperabrasil4.tempsite.ws/sistema/assets/img/header.png" border="0" style="display: block" width="600" height="150" alt="Grupo Recupera">
        </td>
      </tr>
      <tr width="600" height="">
        <td width="600" height="">
          <p style="font-family:arial; color: #444444;padding: 0 20px"><strong>{{$nome}}, você recebeu o(s) contrato(s) do GRUPO RECUPERA BRASIL.</strong></p>
          <p style="font-family:arial; color: #444444;padding: 0 20px">
          	Para acessar o(s) contrato(s), por favor clique no(s) link(s) abaixo.
          </p>
        </td>
      </tr>

      @if($tipo_contrato=='SERASA' || $tipo_contrato=='SERASA E SISBACEN')
      <tr>
      	<td style="text-align: center;padding: 25px"><a href="{{$link_contrato_serasa}}" style="text-decoration: none"><span  style="border-radius:5px;background-color: #3097d1; border: none; padding: 15px; font-size: 13pt;color: white; ">Download do Contrato SERASA</span></a></td>
      </tr>

      <tr>
        <td style="text-align: center;padding: 25px"><a href="{{$link_ficha_associativa_serasa}}" style="text-decoration: none"><span  style="border-radius:5px;background-color: #3097d1; border: none; padding: 15px; font-size: 13pt;color: white; ">Download da Ficha Associativa SERASA</span></a></td>
      </tr>
      @endif

      @if($tipo_contrato=='SISBACEN' || $tipo_contrato=='SERASA E SISBACEN')
      <tr>
        <td style="text-align: center;padding: 25px"><a href="{{$link_contrato_sisbacen}}" style="text-decoration: none"><span  style="border-radius:5px;background-color: #00a65a; border: none; padding: 15px; font-size: 13pt;color: white; ">Download do Contrato SISBACEN</span></a></td>
      </tr>

      <tr>
        <td style="text-align: center;padding: 25px"><a href="{{$link_ficha_associativa_sisbacen}}" style="text-decoration: none"><span  style="border-radius:5px;background-color: #00a65a; border: none; padding: 15px; font-size: 13pt;color: white; ">Download da Ficha Associativa SISBACEN</span></a></td>
      </tr>
      @endif

       @if($tipo_contrato=='PARCERIA' || $tipo_contrato=='REVISIONAL' || $tipo_contrato=='GOOGLE & MÍDIAS SOCIAIS')
      <tr>
        <td style="text-align: center;padding: 25px"><a href="{{$link_contrato}}" style="text-decoration: none"><span  style="border-radius:5px;background-color: #00a65a; border: none; padding: 15px; font-size: 13pt;color: white; ">Download do Contrato {{ $tipo_contrato }}</span></a></td>
      </tr>
      @endif
     
    </table>
  </center>
</body>
</html>
