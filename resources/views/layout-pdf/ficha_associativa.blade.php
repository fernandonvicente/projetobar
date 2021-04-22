
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

  @foreach($listsArrayFinanceiros as $item)
  <div id="content" style="font-size: 12pt;">

  <p style="text-align: center;">
    
  </p>

  <p style="margin-top: 10px; text-align: center;">
     <strong>FICHADEINSCRIÇÃOASSOCIATIVA</strong> 
  </p>


  <p> <strong>Eu, {{ $item->nome }} CPF/CNPJ: {{ $item->documento }},
estabelecido à {{ $item->nome_socio_endereco }}.</strong></p>


    <p>
      Por meio deste documento estou ciente da inclusão do meu nome como <span style="font-weight: bold;">ASSOCIADO
e AUTORIZO</span> esta entidade a representar-me judicialmente e conforme
previsto no artigo 105, C.P.C. em vigor, propor contra os órgãos de crédito, as
ações coletivas para exclusão de apontamentos,recorrer a quaisquer instâncias
e tribunais, apresentar defesa nas ações contrárias conexas, bem como, para
desistir das ações propostas e praticar todos atos perante repartições públicas
Federais, Estaduais e Municipais, e órgãos da administração pública direta e
indireta, como também, praticar quaisquer atos extrajudiciais perante
empresas e órgãos privados, tais como requerer e apresentar documentos.

    </p>

    <p>
      E, para maior clareza, firmo a presente em duas vias.
    </p>  

    <p>
    Santa Cruz das Palmeiras, {{ $dia }} de {{ $mesEscrito }} de {{ $ano }}.
    </p>  

    <br /> 
    <br /> 
    <br /> 
    <br /> 
    <br /> 
    <br /> 
    <br /> 
    <br /> 
    <br /> 

    <p style="text-align: center;">---------------------------------------------------------------------</p> 
    <p style="text-align: center;">{{ $item->nome }}</p> 
    <p style="text-align: center;">CPF/CNPJ: {{ $item->documento }}</p> 


    <br /> 
    <br /> 
    <br /> 
    <br /> 
    <br /> 
    <br /> 
    <br /> 
    <br /> 
    <br /> 
    <br /> 
    <br /> 
    <br /> 
    <br /> 





  </div>
  @endforeach
</body>
</html>
