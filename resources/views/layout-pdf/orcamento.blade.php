<html>
<head>
  <style>
    @page { margin: 160px 50px; }
    #header { position: fixed; left: 0px; top: -140px; right: 0px; text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -10px; right: 0px; }
    #footer .page:after { content: counter(page); }

    table.comBordaSimples {
    border-collapse: collapse; /* CSS2 */
    background: #FFFFF0;
    }
     
    table.comBordaSimples td {
        border: 1px solid black; 
    }
     
    table.comBordaSimples th {
        border: 1px solid black;
        background: #F0FFF0;
    }

    body {
      font-family: verdana, sans-serif;
    }
  </style>
<body>
  <div id="header">
    <table border="0"  width="100%" style="border-bottom: 1px solid #000000; font-size: 8pt; margin-bottom: 10px;">
      <tr>
          <td>
            <img alt="" title="" width="710" height="150" src="{{asset('assets/img/header.png')}}">
          </td>          
      </tr>
  </table>
  </div>
  <div id="footer">
    <table width="100%" style="vertical-align: bottom; font-size: 8pt; color: #000000; border-top: 0px solid #000000;">
      <tr>
        <td width="10%" style="text-align: right; vertical-align: text-top;"><span class="page"></span></td>
      </tr>
      <tr>
          <td width="100%" align="center">
             
              <img alt="" title="" width="710" height="100" src="{{asset('assets/img/footer.png')}}">
          </td>
      </tr>
  </table>
  </div>
  <div id="content" style="font-size: 10pt;">

  <p style="text-align: center;">
     <strong>Santa Cruz das Palmeiras, </strong> 
  </p>

  <p>
     <strong>ABRADECO – Associação Brasileira Defesa do Consumidor:</strong> Através de Processo Judicial, os CPF/CNPJ, abaixo
mencionados, serão beneficiados com a Inibição dos Registros junto aos Órgãos de Proteção ao Crédito, (em caráter
nacional), sem que haja inclusão de novos apontamentos, (durante 12 meses Serasa). *Prazo à ser negociado.

  </p>

  <ul>
     <li>
       Ação de Inibição dos Apontamentos/Negativações, cumulada com pedido de tutela antecipada de sustação
das negativações. 
    </li>
  </ul>

  <p> <strong>Fundamentos Legais:</strong></p>


      
       <ul>
         <li>
           Lei Complementar nº 105, de 10 de janeiro de 2001. (Dispõe sobre o sigilo das operações de instituições financeiras e dá outras
providências), saber: Art. 1 - As instituições financeiras conservarão sigilo em suas operações ativas e passivas e serviços prestados.
        </li>
        <li>
           Súmula 359 do STJ:
“Cabe ao órgão mantenedor do cadastro de proteção ao crédito a notificação do devedor antes de proceder à inscrição”.
Ademais, o descumprimento da obrigação insculpida no art. 43, § 2º, da Legislação Consumerista, enseja a ilegalidade da inscrição
e o dever de cancelamento do registro desabona tório. Vejamos o que dispõe o supracitado artigo:
“Art. 43. O consumidor, sem prejuízo do disposto no art. 86, terá acesso às informações existentes em cadastros, fichas, registros
e dados pessoais e de consumo arquivados sobre ele, bem como sobre as suas respectivas fontes.
§ 2º A abertura de cadastro, ficha, registro e dados pessoais e de consumo deverá ser comunicada por escrito ao consumidor,
quando não solicitada por ele. ”
        </li>
        <li>
           Lei nº 8.078, de 11 de setembro de 1990. (Dispõe sobre a proteção do consumidor e dá outras providências) Art. 42 – Na cobrança de
débitos, o consumidor inadimplente não será exposto a ridículo, nem será submetido a qualquer tipo de constrangimento ou ameaça.

        </li>
     </ul>


<br><br>


<table width="100%" class="comBordaSimples" style="font-size: 10pt; text-align: center;">
  <tr style="font-weight: bold;">
    <td>CPF/CNPJ</td>
    <td>ASSOCIADOS</td>
    <td>Total Débitos</td>
  </tr>
<!-- loop devedores -->
@foreach($lists as $item)
  <tr>
    <td>{{ $item->documento }}</td>
    <td>{{ $item->associado }}</td>
    <td>{{ $item->debito_sp }}</td>
  </tr>
 @endforeach
<!-- loop -->
<tr style="font-weight: bold; color: #ff0000;">
  <td>Total DÉBITOS </td>
  <td colspan="2">R$ {{ $valor_total }} - {{ $valor_total_por_extenso }}</td>
</tr>
<tr style="font-weight: bold; color: #2F5597;">
  <td>Total CUSTOS</td>
  <td colspan="2">R$ {{ $custo_total }} - {{ $custo_total_por_extenso }}</td>
</tr>
</table>
 

<table style="font-size: 10pt;">
  <tr>
    <td colspan="2">
      <div>
        
         <p style="background-color: #f0ff00;">
     2 – <strong>OBJETO DO CONTRATO:</strong> 2.1 – O presente Instrumento Particular tem por objeto a prestação de serviços jurídicos para a defesa dos
direitos da <strong>CONTRATANTE</strong>, mediante a propositura de ação judicial, com pedido de tutela de urgência, cujo objeto é a INIBIÇÃO dos nomes
dos ASSOCIADOS junto aos ORGÃOS DE PROTEÇÃO AO CRÉDITO em Território Nacional, e neste caso, <strong>a PREVENÇÃO para futuros apontamento</strong>, com abrangência em todos os tipos de restrições. O Processo tem como finalidade a permanência do bloqueio de futuras
“inserções” de negativações junto aos Órgãos SERASA, <span style="background-color: #00FFFF;">mantendo “blindados” pelo prazo médio de 12 meses</span>, à partir da data de efetivação da
prestação de serviço contratada.
  </p>
    </div>
 </td>
</tr>
<tr>
  <td colspan="2">
    <div style="text-align: right; width: 90%; margin:0 auto">
      
      <strong style="color: #ff0000;">
      DE ACORDO
      </strong>
      <br><br><br>
   </div>
</td>
</tr>
<tr>
  <td colspan="2">
    <div style="text-align: right; width: 90%; margin:0 auto">
      <p style="color: #ff0000; font-weight: bold;"> Cliente fez a assinatura online em {{ $data_aceite_pdf }} pelo IP {{ $ip }}</p>
      <strong style="background-color: #f0ff00;">
      Responsável: ERG Engenharia Ltda.<br>
   </strong><br><br><br>
   </div>
</td>
</tr>
<tr>
  <td colspan="2">
    <div style="text-align: right; width: 90%; margin:0 auto">
      <strong style="background-color: #00FFFF;">
        Banco do Brasil - Ag 3341-3 Conta Corrente 18408-0 / ABRADECO /CNPJ: 30.560.286/0001-20.
      </strong>
   </div>
</td>
<tr>
  <td colspan="2">
    <div style="text-align: right; width: 90%; margin:0 auto">
      <strong style="color: #ff0000;">
        *Nenhum recebimento está autorizado à não ser em contas mencionadas no Orçamento.
      </strong>
   </div>
</td>
</tr>

<tr>
  <td colspan="2">
    <div style="text-align: right; width: 90%; margin:0 auto; font-size: 12pt;">
      <strong style="color: #2F5597;">
        Contrato com validade por 07 dias.
      </strong>
   </div>
</td>
</tr>
</table>


  </div>
</body>
</html>
