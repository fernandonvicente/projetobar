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
     <strong>Contrato De Prestação De Serviços e Honorários Advocatícios</strong> 
  </p>

  <p>
    Pelo presente instrumento particular de contrato, <span style="color: #4281BC;">RECUPERA BRASIL SERVICOS COMBINADOS E APOIO ADMINISTRATIVO LTDA</span>, Pessoa Jurídica de Direito Privado, inscrita CNPJ sob o nº 30.166.393/0001-79, com sede na Rua Monteiro de Barros, 585, 1º Andar, Centro, Santa Cruz das Palmeiras - SP, neste ATO REPRESENTADO por sua sócia MAÍRA BASSINELLO STOCCO, doravante denominado(a) <strong>“Contratado”</strong>, convenciona e contrata com Nome: <span style="color: #ff0000;"> {{ $cliente_nome }}, CPF/CNPJ: {{ $cliente_documento }}, ENDEREÇO: {{ $cliente_endereco }}, {{ $cliente_num }}, {{ $cliente_complemento }}, Bairro: {{ $cliente_bairro }}, CEP: {{ $cliente_cep }}, {{ $cliente_cidade }}/{{ $cliente_uf }}</span>, referido como <strong>“Contratante”</strong> o seguinte:
  </p>
 
  <p>
    <strong>Cláusula 1ª.</strong> O Contratado compromete-se com o presente termo a prestar Assessoria Jurídica ao Contratante no tocante aos ajuizamentos e acompanhamentos até a segunda instância das <span style="font-weight: bold; font-weight: bold; font-style:italic;">Ações Revisionais conforme RELAÇÃO ABAIXO:</span>
    <span style="color: #ff0000;">
    <br />______________________________________________________________________________________________
    <br />______________________________________________________________________________________________
    <br />______________________________________________________________________________________________
    <br />______________________________________________________________________________________________
    </span>
  </p>

  <p>
    <strong>Cláusula 2ª.</strong> Em remuneração aos serviços profissionais ora pactuados honorários, o Contratante pagará ao Contratado a importância equivalente a <span style="color: #F0FFF0;"> {{ $valor_total }} </span> do valor bruto do proveito econômico obtido pelo Contratante, a ser pago ao final da ação. Fixam ainda as seguintes remunerações:
<br /><strong>– Para ingresso da ação em primeira instância</strong>,  <span style="text-decoration: underline; color: #ff0000;"> o valor total será de {{ $desc_forma_pagto }} </span>
<br /><strong>– Para atuação em segunda instância</strong>, o valor deverá ser negociado levando em conta a complexidade do recurso, sendo objeto de anexo deste contrato. 
<br />• <strong>§ 1º.</strong> Fica estabelecido que os valores fixados ou arbitrado judicialmente, a título de honorários de sucumbência porventura existentes, pertencerão, por direito, ao Contratante, de acordo com o estabelecido na lei nº 8.906, de 4 de julho de 1994, em seus arts. 22 e 23.
<br />• <strong>§ 2º.</strong> Quando os honorários forem contratados para pagamentos futuros, são estabelecidas as seguintes condições:
<br />a.  Quando pactuados honorários mínimos ou parcelados, para pagamento futuro e ainda indeterminado, ou dependente de condição, este valor será atualizado monetariamente, a partir da data da assinatura do contrato, até o efetivo pagamento ou início de pagamento, pelo índice INPC.
<br />b.  Sempre que houver falta de pagamento dos honorários dentro dos prazos pactuados, sejam integrais ou parcelados, fica acordada a aplicação de multa contratual de 20% (vinte por cento), juros de mora de 1% ao mês e atualização monetária pelo índice INPC.
  </p>

  <p>
    <strong>Cláusula 3ª.</strong> Nos honorários avençados não estão incluídas as despesas processuais de viagens, fotocópias, despesas para elaboração de conta de liquidação e outras, que deverão ser pagas a parte pelo Contratante, caso necessárias ao bom andamento do processo, das quais, todavia, serão prestadas contas pela Contratada ao Contratante sempre que esta desejar.
  </p>

  <p>
    <strong>Cláusula 4ª.</strong> Nos honorários avençados também não estão incluídas as custas para pericias ou qualquer documentação referente a estas, se necessário, sendo estes valores de total responsabilidade do Contratado.
  </p>
<br />
<br />
  <p>
    <strong>Cláusula 5ª.</strong> O valor total dos honorários poderá ser considerado (a critério do Contratado) automaticamente vencido e imediatamente exigível, sendo passível de execução, sem prévia notificação ou interpelação judicial, e resguardado o direito aos honorários de sucumbência, acrescido de multa contratual de 20 % (vinte por cento), juros de mora de 1% ao mês a atualização monetária pelo índice INPC nos seguintes casos:
<br />– Se houver composição amigável realizada por qualquer uma das partes litigantes sem anuência do Contratado;
<br />– Quando não forem pagos os honorários nas datas estabelecidas, sejam integrais, sejam parcelados;
<br />– No caso do não prosseguimento da ação por qualquer circunstância;
<br />– Se for cassado o mandato sem culpa do Contratado.
  </p>

  <p>
    <strong>Cláusula 6ª.</strong> Fica o Contratado autorizado desde já a fazer a retenção de seus honorários quando do recebimento de valores devidos ao Contratante, advindos de êxito da demanda, ainda que parcial.
  </p>

  <p>
    <strong>Cláusula 7ª.</strong> São OBRIGAÇÕES DO CONTRATANTE: fornecer a documentação necessária à propositura e andamento da ação; pagar todas as despesas derivadas da causa, tais como custas processuais judiciais, periciais e honorários advocatícios da parte contrária, em caso de eventual sucumbência; custas de projeto e laudo técnico de topografia; despesas com viagens, xerox, certidões, averbações e outras, como honorários advocatícios contratuais.
  </p>

  <p>
    <strong>Cláusula 8ª.</strong> São OBRIGAÇÕES DO CONTRATADO: promover a defesa dos interesses do Contratante na ação já mencionada, até segunda instância, com diligência e dedicação.
  </p>

  <p>
    <strong>Cláusula 9ª.</strong> Pelo pactuado neste contrato obrigam-se os Contratantes e seus sucessores(as).
  </p>

  <p>
    <strong>Cláusula 10ª.</strong> O Contratante fica obrigado a, sempre que houver mudança de endereço, telefone ou e-mail, comunicar imediatamente ao Contratado.
  </p>

  <p>
    <strong>Cláusula 11ª.</strong> A inobservância por parte da Contratante, de qualquer cláusula deste instrumento acarretará a rescisão deste contrato, independente de notificações e avisos, ficando sujeito aos honorários pactuados, bem como multa contratual de 20% sobre os mesmos, mais juros de 1% ao mês e correção monetária pelo índice INPC.
  </p>

  <p>
    <strong>Cláusula 12ª.</strong> O presente contrato não tem caráter personalíssimo, podendo o Contratado ser representado por outro(s) advogado(s) em qualquer ato processual.
  </p>

  <p>
    <strong>Cláusula 13ª.</strong> Para dirimir qualquer questão oriunda do presente contrato, as partes elegem o foro de Santa Cruz das Palmeiras/SP, com renúncia expressa de qualquer outro, por mais privilegiado que seja.
  </p>

  <p>
     E, para firmeza e como prova de assim haverem contratado, fizeram este instrumento particular, impresso em 2 (duas) vias de igual teor e forma, assinado pelas partes contratantes e pelas testemunhas abaixo, a tudo presentes.
  </p>

  

  <p style="float: left; color: #ff0000;">Santa Cruz das Palmeiras, {{ $dia }} de {{ $mesEscrito }} de {{ $ano }}.</p>

<br />
<br />
<br />
<br />
<br />
<br />


<p style="text-align: center;">
  ____________________________________________________________________________________
  <br /><strong>RECUPERA BRASIL SERVICOS COMBINADOS E APOIO ADMINISTRATIVO LTDA</strong>
  <br /><strong>Contratado</strong>
</p>
<br />

<p style="text-align: center;">
  ____________________________________________________________________________________
  <br /><span style="font-weight:bold; color: #ff0000;"> {{ $cliente_nome }} </span>
  <br /><span style="font-weight:bold;"> Contratante:</span>
</p>
<br />

<table>

  <tr>
 <td>  
     <p>TESTEMUNHAS</p>
</td>
</tr>

<tr>
 <td> 
     <p>Nome e assinatura:______________________________________</p>
     <p>RG..:___________________________________________________</p>
</td>
</tr>

<tr>
 <td> 
     <p>Nome e assinatura:______________________________________</p>
     <p>RG..:___________________________________________________</p>
</td>
</tr>

</table>

  </div>
</body>
</html>
