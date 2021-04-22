
<html>
<head>
  <style>
    @page { margin: 60px 50px; }
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
            
          </td>          
      </tr>
  </table>
  </div>
  <div id="footer">

  </div>

  
  <div id="content" style="font-size: 10pt;">

  <p style="text-align: center;">
     <strong>FICHA DE INSCRIÇÃO ASSOCIATIVA</strong> 
  </p>

  <p style="font-weight: bold;">
    Nome: {{ $cliente_nome }}, CPF/CNPJ: {{ $cliente_documento }}, 
  </p>
  <p style="font-weight: bold;">
    Rua:{{ $cliente_endereco }} nº{{ $cliente_num }} Compl: {{ $cliente_complemento }} Bairro: {{ $cliente_bairro }} CEP:  {{ $cliente_cep }}, 
  </p>
  <p style="font-weight: bold;">
    Cidade: {{ $cliente_cidade }}/{{ $cliente_uf }}. 
  </p>
 
  <p style="font-size: 8pt;">
    Por meio deste documento estou ciente da inclusão do meu nome como ASSOCIADO AUTORIZO esta entidade a representar-me judicialmente e conforme previsto no artigo 105, C.P.C. em vigor, propor contra os órgãos de crédito, as ações coletivas para exclusão de apontamentos, recorrer a quaisquer instâncias e tribunais, apresentar defesa nas ações contrárias conexas, bem como, para desistir das ações propostas e praticar todos atos perante repartições públicas Federais, Estaduais e Municipais, e órgãos da administração pública direta e indireta, como também, praticar quaisquer atos extrajudiciais perante empresas e órgãos privados, tais como requerer e apresentar documentos.
  </p>

  <p style="text-align: center; font-weight: bold;">
    Ação de Inibição das Informações constantes no SCR/Sisbacen. 
  </p>

  

  <p style="font-weight: bold;">
    Fundamentos Legais: 
  </p>

  <p style="font-size: 8pt; font-style:italic;">
    • Lei Complementar n° 105, de 10 de Janeiro de 2001. (Dispõe sobre o sigilo das operações de instituições financeiras e dá outras providências), saber: Art. 1 · As instituições financeiras conservarão sigilo em suas operações ativas e passivas e serviços prestados.  
  </p>

  <p style="font-size: 8pt;">
    No tocante à inscrição de débitos no SISBACEN/SCR, mister é a prévia notificação antes de inserir o nome no referido cadastro, na forma do CÓDIGO DO CONSUMIDOR, bem como a teor da Súmula 359 do STJ. Senão vejamos, Súmula 359 do STJ: 
  </p>

  <p style="font-size: 8pt; font-weight:bold;">
    Cabe ao órgão mantedor do cadastro de proteção ao crédito a notificação do devedor antes de proceder à inscrição.
  </p>

   <p style="font-size: 8pt;">
    Ademais, o descumprimento da obrigação insculpida no art. <span style="font-weight:bold;">43, S 2°, da Legislação Consumerista, enseja a ilegalidade da inscrição e o dever de cancelamento do registro "desabonatório". Vejamos o que dispõe o supracitado artigo:</span>
  </p>

  <p style="font-size: 8pt; font-style:italic;">
    <strong>"Art. 43.</strong> O consumidor, sem prejuízo do disposto no art. 86, terá acesso às informações existentes em cadastros, fichas, registros e dados pessoais e de consumo arquivados sobre ele, bem como sobre as suas respectivas fontes.
  </p>

  <p style="font-size: 8pt; font-style:italic; font-style:italic;">
    Paragráfo 2° <strong> A abertura de cadastro, ficha, registro e dados pessoais e de consume deverá ser comunicada por escrito ao consumidor, quando não solicitada por ele. "</strong>
  </p>

  

  <p>
    E, para maior clareza, firmo a presente em 1 via, RECONHECIDA firma em cartório.
  </p>

  <br />
  <br />
   
  <p style="text-align: right;">    
   ___________________, ____de_______________ de 2019.
  </p>


<table>
<tr>
 <td> 
   <div style="text-align: justify; width: 80%; margin:0 auto">
     
     
     <p>______________________________________</p>
     <p>Assinatura:</p>
     <p>CPF/CNPJ:</p>
  </div>
</td>

</tr>
</table>

  </div>
  
</body>
</html>
