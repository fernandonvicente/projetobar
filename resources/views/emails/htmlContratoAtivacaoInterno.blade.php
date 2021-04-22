<!DOCTYPE html>
<html>
<head>
  <title>CONTRATO - ATIVAÇÃO DE RADIO</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
  <center>
    <table width="800" height="" border="0" cellpadding="0" cellspacing="0">
      <tr width="800" height="">
        <td width="40"><img src="https://talksat.com.br/assets/images/marcacao-titulo.jpg" style="margin-top: 14px;"></td>
        <td width="760"><p style="color: #000; font-family: Arial, Heveltica, sans-serif;font-size: 31px;text-align: left; margin: 0; margin-top: 14px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">

            <span>Cara equipe <strong>Talk Radio</strong>,</span><br></p></td>
      </tr>
      <tr width="800" height="">
        <td width="800" height="" colspan="2">
          <br>
          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1.1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">Segue abaixo os dados para ativação da emissora.</p>

          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1.1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Radio:</strong> {{ $radio }}</p>


          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1.1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">

            <table width="80%" class="x_table-bordered x_table-condensed x_table" cellspacing="0" cellpadding="0" border="1" style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1.1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">
              <tr style="text-align: center;">
                <td width="60%"><strong>Programa(s)</strong></td>
                <td width="20%"><strong>Valor</strong></td>
              </tr>
              {!!html_entity_decode($trTable)!!}              
            </table>

          </p> 


          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1.1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Valor:</strong> {{ $valor }}</p>

        

          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1.1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Código do Pedido:</strong> {{ $pedido }}</p>
        

          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1.1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Contrato:</strong> 6 MESES</p>
          
    
          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Vendedor:</strong> {{ $vendedor }}</p>
                   

          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>E-mail principal:</strong> {{ $emailPrincipal }}</p>
          
          
          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Contato 1:</strong> {{ $contato1 }}</p>         
          

          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Contato 2:</strong> {{ $contato2 }}</p>
          
          
          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Pagamento:</strong> <span style="color: #ff0000;">{{ $pagamento }}</span></p>

          @if($linkBoleto)
          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Boleto:</strong> <a href="{{ $linkBoleto }}">Ver Boleto</a> </p>
          @endif
         
          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Vencimento do boleto:</strong> Todo dia <span style="color: #ff0000;">{{ $vencimentoBoleto }}</span> Subsequente</p>

          
          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Nota Fiscal:</strong> {{ $notaFiscal }}</p>
                   

          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em;  text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Código do Cadastro:</strong> {{ $cadastro }}</p>

          @if($vendedor != 'VIA SITE')
            
            <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em;  text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Histórico:</strong> {!!html_entity_decode($historico)!!}
            </p>
          @endif

          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">Segue <strong style="color: #ff0000;">anexo</strong> a copia do contrato assinado digitalmente.</p>

          
          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1.1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">Atenciosamente.</p>
          

          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">===============================================================</p>
          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">Fazemos programas de rádio e distribuimos para o rádio.</p>
          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">Nosso compromisso é entregar conteúdos que - envolva, empolgue, emocione.</p>
          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">Assim, ajudamos o rádio a permanecer por mais tempo no coração das pessoas.</p>
          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">Talk Radio. Vai um conteúdo aí?</p>
          <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">===============================================================</p>
          
          

        </td>
      </tr>
      <!--
      <tr width="800" height="">
        <td width="800" height="" colspan="2">
          <table width="800" height="" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td>
                <table width="335" height="" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>
                      <img src="https://talksat.com.br/assets/assinaturas-email/assinatura-05-800px.jpg" border="0" style="display: block;" alt="Talk Radio (Assinatura de e-mail)">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    -->
    </table>
  </center>
</body>
</html>