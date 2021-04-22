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
     <strong>CONTRATO GERENCIAMENTO DE <span style="color: #ff0000;">Reputação</span> GOOGLE & MÍDIAS SOCIAIS </strong> 
  </p>

  <p>
    Pelo presente instrumento particular as partes a seguir qualificadas nos itens <strong>1.1</strong> e <strong>1.2</strong> têm por justo e contratado: 
<strong>1.1 {{ $cliente_nome }}, CPF/CNPJ: {{ $cliente_documento }}, ENDEREÇO: {{ $cliente_endereco }}, {{ $cliente_num }}, {{ $cliente_complemento }}, Bairro: {{ $cliente_bairro }}, CEP: {{ $cliente_cep }}, {{ $cliente_cidade }}/{{ $cliente_uf }}, REPRESENTADA</strong> doravante simplesmente denominado <strong>CONTRATANTE;</strong>
  </p>
 
  <p>
    <strong>1.2 FINANCE TALKING SERVICOS COMBINADOS E APOIO ADMINISTRATIVO EIRELI, CNPJ: 21.362.930/0001-65, com sede na Rua Monteiro de Barros, 585, 1º Andar, SALA 2, Centro, Santa Cruz das Palmeiras - SP, CEP 13650-000, neste ato representado por sua SÓCIA: MAÍRA BASSINELLO STOCCO</strong>, doravante denominado simplesmente <strong>CONTRATADO</strong>; 
  </p>

  <p>
    <strong>2 – OBJETO DO CONTRATO: 2.1 –</strong> O presente CONTRATO tem por objeto a prestação de serviços jurídicos para a defesa dos direitos da <strong>CONTRATANTE</strong>, mediante <strong>GERENCIAMENTO DE <span style="color: #ff0000;">Reputação</span> GOOGLE & MÍDIAS SOCIAIS<strong>, cujo objeto é a DESFRAGMENTAÇAO das informações do nome do <strong>CONTRATANTE</strong> junto aos links de pesquisas na INTERNET como um todo vinculados pelo GOOGLE em Território Nacional, com abrangência em todos os tipos de links (Site notícias – Uol, Terra, Globo, etc.), BLOGS, vídeos, JUSBrasil, Escavador, etc. . O Contrato em supra, atua de forma Legal, Sistêmica e Administrativa, com atuação para remover e desindexar dos mecanismos de busca do Google, onde não há ocultação dos resultados de busca e sim a execução e destruição dos links em <strong>Definitivo</strong>, à partir da data de efetivação do pagamento do CONTRATADO em epígrafe. 
  </p>

  <p>
    <strong>2.2 CONTRATANTE: </strong>
  </p>

  <p>
    <table width="100%" class="comBordaSimples" style="font-size: 10pt; text-align: center;">
  <tr style="font-weight: bold;">
    <td>CPF/CNPJ</td>
    <td>GERENCIAMENTO DE REPUTAÇAO</td>
  </tr>
<!-- loop devedores -->
@foreach($lists as $item)
  <tr>
    <td>{{ $item->documento }}</td>
    <td>{{ $item->associado }}</td>
  </tr>
 @endforeach
<!-- loop -->
</table>
  </p>

  <p>
    <strong>2.3<strong> - As informações inseridas <strong>posteriores</strong> ao contrato aos mecanismos de pesquisas <span style="font-weight:bold; background-color: #f0ff00;">GOOGLE & MÍDIAS SOCIAIS estarão amparadas por 12 meses</span>, com garantia de todas informações atuais excluídas e de novo orçamento caso haja novas informações inseridas posterior ao prazo do Contrato.
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
<br />
<br />
  <p>
    <strong>4 – OBRIGAÇÕES E DIREITOS DO CONTRATADO: 4.1</strong> – Prestar serviços de <strong>GERENCIAMENTO DE <span style="color: #ff0000;">Reputação</span> GOOGLE & MÍDIAS SOCIAIS</strong> na defesa e interesses do cliente, por profissional indicado do CONTRATADO, com finalidade específica constante no item 2. 
  </p>

  <p>
    <strong>4.2</strong> - <span style="font-style:italic;">Tendo em vista a necessidade atual da valorização da imagem das pessoas e de empresas no ambiente digital, o GERENCIAMENTO de Reputação é essencial para quem quer ser bem visto na internet. E a contratação de profissionais especializados nesse engajamento e focados em trazer um Diagnóstico de Reputação é essencial para a apresentação de bons resultados, oferecendo a seus clientes ou parceiros de negócios aquilo que é primordial para a valorização de sua imagem.</span>
  </p>

  <p>
   <strong>4.3</strong> – Prestar informações ao <strong>CONTRATANTE</strong> acerca do andamento das desfragmentações das informações, em suas diversas fases, com PREVISAO DE EXCLUSAO TOTAL DAS INFORMAÇOES QUE DENIGREM IMAGEM EM ATÉ 30 DIAS.
  </p>

  <p style="text-decoration: underline;">
    <span style="color: #00A3FC;">Gerenciamento de Reputação</span>: <span style="color: #196A93;">A reputação é algo que sempre acompanhou a sociedade. Muito antes do advento da internet, as pessoas já se preocupavam com a imagem que era transmitida para a sociedade. </span>
  </p>

  <p>
    Fotos / Vídeos <strong>X</strong>  Fotos e Vídeos (Informações DENIGREM IMAGEM)
Notícias <strong>X</strong>  Notícias, Matérias, Reportagens, Posts (Informações DENIGREM IMAGEM)
Processo Judicial <strong>X</strong> Jusbrasil, Escavador, RadarOficial, JustiçaOnline, etc... (Informações DENIGREM IMAGEM)
  </p>

  <p>
     <strong>5 – DAS DESPESAS E HONORÁRIOS: 5.1</strong> – Como contraprestação pecuniária pelos serviços descritos no ITEM “2.”, o <strong>CONTRATANTE</strong> pagará ao <strong>CONTRATADO</strong> o valor <strong>TOTAL</strong> de <strong>R$ {{ $valor_total }}, referente ao Gerenciamento de REPUTAÇAO do Item2.2</strong>.
  </p>

  <p>
    <strong>5.2</strong> – Para efeitos Bancários conta para Depósito e/ou Pagamentos à ser creditado: 
    <br /><span background-color: #00FFFF;> Banco do Brasil - Ag 3341-3 Conta Corrente 18125-0/ FINANCE TALKING /CNPJ: 21.362.930/0001-65</span>
  </p>

  <p>
    <strong>5.3</strong> – A elaboração dos trabalhos, visando DESFRAGMENTAÇAO TOTAL DOS LINKS relacionados em MÍDIAS SOCIAIS no Território Nacional, terão início a partir da assinatura deste Instrumento, e pagamentos dos HONORÁRIOS estabelecidos. 
  </p>

  <p>
    <strong>5.3</strong> – A elaboração dos trabalhos, visando DESFRAGMENTAÇAO TOTAL DOS LINKS relacionados em MÍDIAS SOCIAIS no Território Nacional, terão início a partir da assinatura deste Instrumento, e pagamentos dos HONORÁRIOS estabelecidos. 
  </p>

  <p>
    <strong>5.4</strong> – Havendo rescisão do contrato, substabelecimento sem reserva de poderes por determinação do cliente por qualquer motivo, os honorários contratados serão devidos <strong style="font-style:italic;">integralmente</strong>. 
  </p>

  <p>
    <strong>5.5</strong> – A responsabilidade da execução da entrega da prestação de serviço, à se contar à partir da assinatura do contrato, e item 5.1 (efetivação do pagamento inicial), à contar em até 30 (trinta) dias corridos para <span style="font-weight:bold; background-color: #D3D3D3;">DESFRAGMENTAÇAO TOTAL DOS LINKS EM DEFINITIVO</span>, ficando <strong>CONTRATADO</strong> com a responsabilidade, caso o mesmo não seja executado nesse prazo descrito, conforme Código Defesa do Consumidor, podendo esse prazo ser alterado por força maior processual, desde que o <strong>CONTRATADO</strong> se responsabilize em repassar todas informações ao <strong>CONTRATANTE</strong>.
  </p>

  <p style="font-style:italic;">
    <strong>5.6</strong> - É de responsabilidade dos profissionais que zelam pela Gestão de Reputação <strong>(CONTRATADO)</strong> utilizar de sua expertise para apresentar melhorias para as pessoas e empresas que contratam seus serviços, efetuando pesquisas, engajando matérias positivas, fazendo com que aquilo que seja benéfico tenha mais relevância e atinja os objetivos defendidos por aquele que preza pela sua vida pessoa, marca ou um produto.
  </p>

  <p>
    <strong>6 – CLÁSULA COMPROMISSÓRIA: 6.1</strong> – <span style="font-style:italic;">“Fica eleito o Tribunal Arbitral de Santa Cruz das Palmeiras/São Paulo, com endereço à Rua Monteiro de Barros, 585, na cidade de Santa Cruz das Palmeiras/São Paulo, para resolução de quaisquer dúvidas advindas do presente contrato”</span>.
  </p>

  <p>
    <strong>7 – DISPOSIÇÕES GERAIS: 7.1</strong> – Fica estabelecido entre as partes que a prestação de serviços objeto do presente, caracteriza-se por um serviço de resultados.                      
  </p>

  <p>
    <strong>7.2</strong> - O <strong>CONTRATANTE</strong> declara estar ciente pelo <strong>CONTRATADO</strong> de todas as peculiaridades da situação em que se encontra, nas MÍDIAS SOCIAIS que denigrem sua imagem, da extrema complexidade da natureza do <span style="font-weight:bold; background-color: #D3D3D3;">GERENCIAMENTO DE <span style="color: #ff0000;">Reputação</span> GOOGLE & MÍDIAS SOCIAIS</span>.
  </p>

  <p>
    <strong>8 – DISPOSIÇÕES FINAIS: 8.1</strong> – O presente contrato é um título executivo extrajudicial conforme previsão legal e em caso de inadimplemento da cliente, permite a propositura de ação de execução autônoma para o recebimento dos honorários devidos e não pagos.                  
  </p>

  <p>
    <strong>8.2</strong> – Todas as informações relacionadas neste documento, referentes às consultas em mídias sociais, são de caráter <strong>CONFIDENCIAL</strong> e não podem ser repassadas e ou divulgadas, senão pelo <strong>CONTRATANTE</strong>. 
  </p>

  <p style="text-align: center; background-color: #00C6C6;">
    CONTRATO VÁLIDO POR 03 DIAS
  </p>

  <p style="float: right; color: #ff0000;">Santa Cruz das Palmeiras, {{ $dia }} de {{ $mesEscrito }} de {{ $ano }}.</p>

<br />
<br />

<table>

<tr>
 <td> 
     <p>______________________________________</p>
     <p style="font-weight:bold;">CONTRATANTE</p>
  </td>
  <td> 
     <p>______________________________________</p>
     <p style="font-weight:bold;">CONTRATADO 2
      <br />FINANCE TALKING SERVICOS COMBINADOS E APOIO ADMINISTRATIVO
    </p>
  </td>
</tr>


<tr>
 <td> 
     <p>______________________________________</p>
     <p style="font-weight:bold;">TESTEMUNHA 1</p>
  </td>
  <td> 
     <p>______________________________________</p>
     <p style="font-weight:bold;">TESTEMUNHA 2</p>
  </td>
</tr>


</table>

  </div>
</body>
</html>
