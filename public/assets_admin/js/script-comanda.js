jQuery(document).ready(function(){

	var urlJs = $('#urlJs').val();//recuperando a url, para ser usada via ajax
	var urlAdmin = '/bayareaadmin/';

  $('.money').mask("#.##0,00", {reverse: true, maxlength: false});

  $(".number").keydown(function(event) {
                    
        /* Testar as teclas não numérica */
                
        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode >= 35 && event.keyCode <= 39))
        {
            return;
        }
        else 
        {
        
            /* Testar acionamento de outras teclas */
        
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) 
            {
                event.preventDefault(); 
            }   
        }
    });

  $("#formComandaItem").submit(function( event ) {

      var form=$("#formComandaItem");

      if(!$('#status_bt_item').val()){

        $('#status_bt_item').val(1);

        $('.btn-success-item').html(' <i class="fa fa-refresh fa-spin"></i> Enviando...');

        var urlJason = urlJs+urlAdmin+'comanda/store';       

        //console.log(urlJason);
        //return false;        

        $.ajax({
          url: urlJason,
          type: "post",
          dataType: 'json',
          data:form.serialize(),
          success: function(results){

            if(results.success){

              notification('Item','Adicionado com sucesso!','success');
              $('.btn-success-item').html(' <i class="fa fa-save"></i> Salvar');
              $('#status_bt_item').val('');
              $('#idRecord2').val(results.result);
              $('#idRecord').val(results.result);
              $('.total_despesas').html('R$ '+results.totalDespesas);
              $('#valor_total_final').val(results.totalDespesas);
              $('#listaDespesas').html(results.htmlListaDespesa); 
              $('.btn-final').show();
              $('.clearItem').val('');
 
            }else{
              $('.btn-success-item').html(' <i class="fa fa-check"></i> Salvar');
              $('#status_bt_item').val('');
             
              if(results.estoque){
                notification('Item','Adicionado com erro!','error');
              }else{
                notification('Item',results.mensagem,'error');
                $('#quantidade').val(results.qtdadeDisponivel);
              }

              return false;
            }

          },
          error:function(){
            $('.btn-success-item').html(' <i class="fa fa-check"></i> Salvar');
              $('#status_bt_item').val('');
             
               notification('Item','Acesso com erro!','error');

              return false;
          }

        })
      }

  });

	
	$("#formComanda").submit(function( event ) {

      var form=$("#formComanda");

      if(!$('#status_bt').val()){

        $('#status_bt').val(1);

        $('.btn-success').html(' <i class="fa fa-refresh fa-spin"></i> Enviando...');

        var comanda_id = $('#idRecord').val();

        var urlJason = urlJs+urlAdmin+'comanda/edit/'+comanda_id;  

        $.ajax({
          url: urlJason,
          type: "post",
          dataType: 'json',
          data:form.serialize(),
          success: function(results){

            if(results.success){

                  $('.btn-success').html(' <i class="fa fa-check"></i> Salvar');
                  $('#status_bt').val('');

                  notification('Fechamento','Realizado com sucesso!','success');

                  var body = $("html, body");
                  body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
                      var novaURL = urlJs+urlAdmin+'comanda/index';
                      $(window.document.location).attr('href', novaURL);
                  });

            }else{
              $('.btn-success').html(' <i class="fa fa-check"></i> Salvar');
              $('#status_bt').val('');
             
               notification('Fechamento','Realizado com erro!','error');

              var   body = $("html, body");
              body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
                 //alert("Finished animating");
              });

              return false;
            }

          },
          error:function(){
            $('.btn-success').html(' <i class="fa fa-check"></i> Salvar');
            $('#status_bt').val('');               
             notification('Fechamento','Não foi possível fazer o acesso!','error');
          }

        })
      }

   });

  
  if(!$('#idRecord').val())
    $('.btn-final').hide();

  

  $('.btn-final-troco').hide();
  



  //calculando o troca para fechamento da comanda
  $("#valor_recebido").blur(function( event ) {

    var valor_recebido = ajustarMoedaCalculo($("#valor_recebido").val());
    var valor_total_final = ajustarMoedaCalculo($("#valor_total_final").val());

    if(valor_recebido < valor_total_final){
      notification('Checamento','Valor recebido é inferior ao total da comanda!','error');
      $('#troco').val();
      $('.btn-final-troco').hide();
    }else{
      var troco = (valor_recebido - valor_total_final);
      troco = formatarMoeda(troco);
      notification('Trocp','O troco do fechamento da comanda R$ '+troco,'success');
      $('#troco').val(troco);
      $('.btn-final-troco').show();
    }

  });


  
  $(".showCardapio").change(function( event ) {

      if($('#cardapio_id').val()){

        var cardapio_id = $('#cardapio_id').val();

        var urlJason = urlJs+urlAdmin+'cardapio/show/'+cardapio_id;  

        $.ajax({
          url: urlJason,
          type: "GET",
          dataType: 'json', 
          success: function(results){

            if(results.success){
              $('#valor').val(results.preco_consumo);
            }else{
              $('#valor').val('');
              return false;
            }

          },
          error:function(){              
            notification('Consulta','Não foi possível fazer o acesso!','error');
            $('#valor').val('');
            return false;
          }

        })
      }

   });


//------------------------
});

function notification(heading1,text1,icon1){
  /*
  *icon: 'info', informação - azul
  *icon: 'warning', alerta - amarelo
  *icon: 'success', sucesso - verde
  *icon: 'error', error - vermelho
  */
  $.toast({
            heading: heading1,
            text: text1,
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: icon1,
            hideAfter: 3500,
            stack: 6
        });
}

//------------------------




	function excluirRegistro(idRegistro){
      if (confirm("Tem certeza que deseja excluir o registro?")) {

        var urlJs = $('#urlJs').val();//recuperando a url, para ser usada via ajax
        var urlAdmin = '/bayareaadmin/';

        var urlJsonGet = urlJs+urlAdmin+'despesa/delete/'+idRegistro;

        $.get(urlJsonGet, function (results) {
                  var objetos = results;

                  if(results.success){

                    notification('Exclusão','Realizada com sucesso!','success');

                    location.reload();                   

                  }else{
                    notification('Exclusão','Realizada com erro!','error');
                    return false;
                  }
        
        });
        
      }
  }


  function excluirRegistroItem(idRegistro){
      if (confirm("Tem certeza que deseja excluir o registro?")) {

        var urlJs = $('#urlJs').val();//recuperando a url, para ser usada via ajax
        var urlAdmin = '/bayareaadmin/';

        var urlJsonGet = urlJs+urlAdmin+'comanda/deleteItem/'+idRegistro;

        $.get(urlJsonGet, function (results) {
                  var objetos = results;

                  if(results.success){

                    notification('Exclusão','Realizada com sucesso!','success');

                    $('#tr_item_'+idRegistro).remove();

                    $('.total_despesas').html('R$ '+results.totalDespesas);   
                    $('#valor_total_final').val(results.totalDespesas);                

                  }else{
                    notification('Exclusão','Realizada com erro!','error');
                    return false;
                  }
        
        });
        
      }
  }


  function formatarMoeda(valor){

    var valor = valor;
    var valorFormatado = valor.toLocaleString('pt-BR', { minimumFractionDigits: 2});

    return valorFormatado;
  }

  function ajustarMoedaCalculo(moeda) {
      if (moeda) {
          moeda = moeda.replace(',', '');
          moeda = moeda.replace('.', '');
          moeda = moeda.replace('.', '');

          var valor = parseFloat(moeda / 100);

          return valor;

      } else {
          return null;
      }
  }