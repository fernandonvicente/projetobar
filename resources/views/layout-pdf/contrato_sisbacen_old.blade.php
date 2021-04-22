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
    <table border="0"  width="100%" style="font-size: 8pt; margin-bottom: 10px;">
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
     <strong>INSTRUMENTO PARTICULAR PRESTAÇÃO DE SERVIÇOS PROFISSIONAIS E OUTRAS AVENÇAS</strong> 
  </p>

  <p>
    Pelo presente instrumento particular as partes a seguir qualificadas nos itens <strong>1.1</strong> e <strong>1.2</strong> têm por justo e contratado: <strong>1.1 {{ $cliente_nome }}, CPF/CNPJ: {{ $cliente_documento }}, Estabelecido {{ $cliente_endereco }}, {{ $cliente_num }}, {{ $cliente_complemento }}, Bairro: {{ $cliente_bairro }}, CEP: {{ $cliente_cep }}, {{ $cliente_cidade }}/{{ $cliente_uf }}, REPRESENTADA</strong> doravante simplesmente denominado <strong>CONTRATANTE; 1.2 ABRADECO – ASSOCIACAO BRASILEIRA DE DEFESA DO CONSUMIDOR, CNPJ: 30.560.286/0001-20, com sede na Rua Monteiro de Barros, 585, 1º Andar, Centro, Santa Cruz das Palmeiras - SP, CEP 13650-000, neste ato representado</strong> por sua 1ª SECRETARIA <strong>MAÍRA BASSINELLO STOCCO</strong>, doravante denominado simplesmente <strong>CONTRATADO</strong>; 
  </p>
 
  <p style="background-color: #FFFF00;">
    <strong>2 – OBJETO DO CONTRATO</strong>
  </p>

  <p style="background-color: #FFFF00;">
    <strong>2.1</strong> – O presente Instrumento Particular tem por objeto a prestação de serviços jurídicos para a defesa dos direitos da <strong>CONTRATANTE</strong>, mediante a propositura de ação judicial, com pedido de tutela de urgência, cujo objeto é a INIBIÇÃO dos nomes dos ASSOCIADOS junto ao <strong>SISBACEN</strong>, sem que haja inclusão de novas informações (durante 12 meses Serasa), <span style="background-color: #00FF00; font-weight: bold;">mantendo “blindados” pelo prazo de 12 meses</span>, à partir da data de efetivação da prestação de serviço contratada.  
  </p>


  <p>
    2.3 – Relação beneficiários propositura do Processo Judicial SERASA, órgãos de proteção ao crédito E SISBACEN: 
  </p>

  <p>
    <table width="100%" class="comBordaSimples" style="font-size: 10pt; text-align: center;">
  <tr style="font-weight: bold; background-color: #0070C0;">
    <td>CPF/CNPJ</td>
    <td>ASSOCIADOS</td>
    <td>DÉBITOS</td>
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
  <td colspan="2">R$ {{ $valor_total }}</td>
</tr>
<tr style="font-weight: bold; color: #2F5597;">
  <td>Total CUSTOS</td>
  <td colspan="2">R$ {{ $custo_total }} - {{ $custo_total_por_extenso }}</td>
</tr>
</table>
  </p>

  <p>
    <strong>3 – OBRIGAÇÕES E DIREITOS DO CLIENTE: 3.1</strong> – Manter sempre atualizado o endereço de correspondência indicado no item 1.1 e para o caso de alteração de endereço, informar ao <strong>CONTRATADO</strong> mediante escrito, por meio de telegrama ou carta, ambos com aviso de recebimento. 
  </p>

  <p>
    <strong>3.2</strong> – Realizar os pagamentos dos honorários contratuais, e demais valores previstos neste instrumento, na forma e no prazo estipulados nestas cláusulas.  
  </p>

  <p>
    <strong>3.3</strong> – A rescisão do contrato, bem como, a revogação do mandato, não exime o cliente do pagamento dos honorários contratados, que são devidos na forma estabelecida no item 5 deste contrato. 
  </p>

  <p>
    <strong>4 – OBRIGAÇÕES E DIREITOS DO CONTRATADO: 4.1</strong> – Prestar serviços de Advocacia Judicial ou Extrajudicial na defesa de interesses do cliente, por profissional indicado do <strong>CONTRATADO</strong>, adotando as medidas judiciais e extrajudiciais que entender necessárias, finalidade específica constante no item 2. 
  </p>

  <br />
    <br />
    <br />

  <p>

    <div style="background-color: #FFFF00;">
    <strong>4.2</strong> – Prestar informações ao <strong>CONTRATANTE</strong> acerca do andamento do processo, em suas diversas fases, conforme abaixo:
    <br />- Vinculo à <strong>Associação ABRADECO – Associação Brasileira Defesa Consumidor 30.560.286/0001-20</strong>
    <br />- Petição e inclusão ao Processo//- Expedição Ofício
    <br />- Protocolo Ofício nos Órgãos de Proteção ao Crédito (Serasa/SCPCBoaVista/SPCBrasil/Equifax/CNDL)
    <br />- Previsão de início das baixas junto aos órgãos 48h após protocolos (dias corridos úteis, sem feriados)
  </div>
    <span style="background-color: #FFF;">-Devido “default” de atualização do relatório mensal do Sisbacen ter 2 (dois) meses, informamos que a decisão que retira as informações do Sisbacen de vencidos, prejuízos e ativos em geral ser imediata, a visualização do benefício de Inibição das Informações constantes no relatório, ocorrerá em D+2 (em dois meses futuros).</span>
 
  </p>
   
  <p>    
    <strong>5 – DAS DESPESAS E HONORÁRIOS: 5.1</strong> – Como contraprestação pecuniária pelos serviços descritos no ITEM “2.”, o <strong>CONTRATANTE</strong> pagará ao <strong>CONTRATADO</strong> o valor <strong>TOTAL</strong> de <span style="background-color: #00FFFF; font-weight: bold;">R$ {{ $desc_forma_pagto }}, referente às Associações do Item2.2.</span>
  </p>

  <p>
    <strong>5.1.1.</strong> Propositura de Ação Judicial de Exclusão de Negativação Cumulada de Pedido de Tutela Antecipada de Sustação das Negativação, com baixa imediata nas negativações junto aos Órgãos de Proteção ao Crédito em território nacional, nos Associados mencionados nos itens 2.2 desse contrato, após o pagamento efetivado e contrato assinado por ambas as partes.
  </p>

  <p>
    <strong>5.2</strong> Para efeitos Bancários conta para Depósito e/ou Pagamentos à ser creditado: 
    <br /><span style="background-color: #00FFFF; font-weight: bold;">Banco do Brasil - Ag 3341-3 Conta Corrente 18408-0 / ABRADECO /CNPJ: 30.560.286/0001-20.</span>
  </p>

  <p>
    <strong>5.3</strong> – A preparação e elaboração dos trabalhos, visando a propositura das respectivas ações judiciais, terão início a partir da assinatura deste Instrumento, porém o protocolo no Poder Judiciário somente será realizado quando do adiantamento das custas e despesas judiciais e da quitação da 1ª parcela/Valor Entrada do contrato. 
  </p>

  <p>
    <strong>5.4</strong> – Havendo revogação tácita ou expressa do mandato, rescisão do contrato, substabelecimento sem reserva de poderes por determinação do cliente por qualquer motivo, os honorários contratados serão devidos integralmente. 
  </p>

  <p>
    <strong>5.5</strong> – A responsabilidade da execução da entrega da prestação de serviço, à se contar à partir da assinatura do contrato, e item 5.1 (efetivação do pagamento inicial), à contar em até 60 (sessenta) dias corridos para Exclusão dos Apontamentos, ficando <strong>CONTRATADO</strong> com a responsabilidade de devolução de 100% do valor recebido, caso o mesmo não seja executado nesse prazo descrito, conforme Código Defesa do Consumidor, podendo esse prazo ser alterado por força maior processual, feriados forenses, desde que o <strong>CONTRATADO</strong> se responsabilize em repassar todas informações ao <strong>CONTRATANTE</strong>.
  </p>

  <p>
    <strong>CLÁSULA COMPROMISSÓRIA: 6.1 </strong> – “Fica eleito o Tribunal Arbitral de Santa Cruz das Palmeiras/São Paulo, com endereço à Rua Monteiro de Barros, 585, na cidade de Santa Cruz das Palmeiras/São Paulo, para resolução de quaisquer dúvidas advindas do presente contrato”.  
  </p>

  <p>
    <strong>7 – DISPOSIÇÕES GERAIS: 7.1</strong> – Fica estabelecido entre as partes que a prestação de serviços objeto do presente, caracteriza-se por um serviço de resultados.                                                                                                                           
  </p>

  <p>
    <strong>7.2</strong> – O <strong>CONTRATANTE</strong> declara ter sido devidamente cientificado pelo <strong>CONTRATADO</strong> de todas as peculiaridades da situação em que se encontra, da morosidade processual, da extrema complexidade da natureza desse litígio. 
  </p>

  <p>
    <strong>7.3</strong> – O <strong>CONTRATANTE</strong> desde já autoriza a divulgação das decisões administrativas e/ou judiciais inerentes deste Instrumento.
  </p>

  <p>
    <strong>8 – DISPOSIÇÕES FINAIS: 8.1 </strong> – O presente contrato é um título executivo extrajudicial conforme previsão legal e em caso de inadimplemento da cliente, permite a propositura de ação de execução autônoma para o recebimento dos honorários devidos e não pagos.
  </p>

   <p>
    <strong>8.2 </strong> – Todas as informações relacionadas neste documento, referentes às consultas realizadas e situação cadastral e crédito, são de caráter confidenciais e não podem ser repassadas e ou divulgadas, senão pelo <strong>CONTRATANTE</strong>. 
  </p>

  <p>
    <span style="background-color: #FFFF00; font-weight: bold;">ESTE CONTRATO TERÁ VALIDADE POR 07 DIAS</span>
  </p>

  <p style="float: right">Santa Cruz das Palmeiras, {{ $dia }} de {{ $mesEscrito }} de {{ $ano }}.</p>

<br />
<br />
<br />
<br />
<br />
<br />
<br />


<table>
<tr>
 <td> 
   <div style="text-align: justify; width: 80%; margin:0 auto">
     <p>______________________________________</p>
     <p>CONTRATANTE</p>
     <p></p>
     
  </div>
</td>
<td>
   <div style="text-align: justify; width: 80%; margin:0 auto">
    <p>______________________________________</p>
     <p>CONTRATADO</p>
     <p>ABRADECO</p>
  
      
  </div>
</td>
</tr>



<tr>
 <td> 
   <div style="text-align: justify; width: 80%; margin:0 auto">
     
     <p>TESTEMUNHA 1:</p>
     <p>______________________________________</p>
  </div>
</td>
<td>
   <div style="text-align: justify; width: 80%; margin:0 auto">
    
     <p>TESTEMUNHA 2:</p>
      <p>______________________________________</p>
  </div>
</td>
</tr>
</table>











 
  

  



  </div>
</body>
</html>
