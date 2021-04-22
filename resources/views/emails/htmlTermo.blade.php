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
          <p style="font-family:arial; color: #444444;padding: 0 20px"><strong>Seja bem-vindo {{$nome}} ao GRUPO RECUPERA BRASIL.</strong></p>
          <p style="font-family:arial; color: #444444;padding: 0 20px">
          	Para acessar nosso painel de gerenciamento de cliente, por favor clique no botão 'CONFIRME SEU CADASTRO' e para acessar utilize os dados de login citados abaixo:
          </p>
          <p style="font-family:arial; color: #444444; padding: 0 40px">
          	<span style="display: block;"><strong>Login:</strong> {{$email}}</span>
          	<span style="display: block;"><strong>Senha:</strong> {{$senha}}</span>
          </p>
        </td>
      </tr>
      <tr>
      	<td style="text-align: center;padding: 25px"><a href="{{$link}}" style="text-decoration: none"><span  style="border-radius:5px;background-color: #3097d1; border: none; padding: 15px; font-size: 13pt;color: white; ">Confirme seu Cadastro</span></a></td>
      </tr>
      <tr width="600" height="63" style="background-color: #f5f8fa">
        <td width="600" height="63" style="font-family:arial; color: #444444;">
          	<p style="padding: 10px 15px; text-align: center;">
        	  Se estiver com problemas para acessar, clique no batão 'Confirme seu Cadastro' copie e cole  o URL abaixo em seu navegador da web {{$link}}
      		</p>
        </td>
      </tr>
    </table>
  </center>
</body>
</html>
