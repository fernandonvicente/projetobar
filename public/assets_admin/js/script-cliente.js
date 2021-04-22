jQuery(document).ready(function(){

	var urlJs = $('#urlJs').val();//recuperando a url, para ser usada via ajax
	var urlAdmin = '/bayareaadmin/';

	
	$("#formCliente").submit(function( event ) {

			var form=$("#formCliente");

			if(!$('#status_bt').val()){

				$('#status_bt').val(1);

				$('.btn-success').html(' <i class="fa fa-refresh fa-spin"></i> Enviando...');

				var urlJason;
				var cliente_id = '';
				if($('#idRecord').val())
					cliente_id = $('#idRecord').val();

				//----------------------------------------------------------------------------------------------------

				if($('#idRecord').val() > 0){
					urlJason = urlJs+urlAdmin+'cliente/edit/'+cliente_id;
				}else{
					urlJason = urlJs+urlAdmin+'cliente/store';
				}

				//console.log(urlJason);
				//return false;
				

				$.ajax({
					url: urlJason,
					type: "post",
					dataType: 'json',
					data:form.serialize(),
					success: function(results){

						if(results.success){

							if(cliente_id > 0){
								$('.btn-success').html(' <i class="fa fa-check"></i> Salvar');
                $('#status_bt').val('');

								notification('Alteração','Realizada com sucesso!','success');

								var body = $("html, body");
								body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
								    var novaURL = urlJs+urlAdmin+'cliente/edit/'+cliente_id;
                    $(window.document.location).attr('href', novaURL);
								});

							}else if(cliente_id == 0){
								$('.btn-success').html(' <i class="fa fa-check"></i> Salvar');
                $('#status_bt').val('');

								notification('Cadastro','Realizado com sucesso!','success');

								var body = $("html, body");
								body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
                    $('#idRecord').val(results.result);

                    var novaURL = urlJs+urlAdmin+'cliente/edit/'+results.result;
                    $(window.document.location).attr('href', novaURL);
								});

								
							}
				          
				          
				        }else{
				          $('.btn-success').html(' <i class="fa fa-check"></i> Salvar');
                  $('#status_bt').val('');
				         
				           notification('Cadastro','Realizado com erro!','error');

				          var 	body = $("html, body");
  								body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
  								   //alert("Finished animating");
  								});

				          return false;
				        }

					},
					error:function(){
						$('.btn-success').html(' <i class="fa fa-check"></i> Salvar');
            $('#status_bt').val('');			         
				     notification('Cadastro','Não foi possível fazer o acesso!','error');
					}

				})
			}

	});

  $("#documento").keydown(function(){
    
      try {
        $("#documento").unmask();
      } catch (e) {}
      
      var tamanho = $("#documento").val().length;

      if(tamanho < 11){
          $("#documento").mask("999.999.999-99");
      } else if(tamanho > 11){
          $("#documento").mask("99.999.999/9999-99");
      }

      
      // ajustando foco
      var elem = this;
      setTimeout(function(){
        // mudo a posição do seletor
        elem.selectionStart = elem.selectionEnd = 10000;
      }, 0);
      // reaplico o valor para mudar o foco
      var currentValue = $(this).val();
      $(this).val('');
      $(this).val(currentValue);
      
  });

  $('.maskTel').focusout(function(){
    var phone, element;
    element = $(this);

    phone = element.val().replace(/\D/g, '');

    if(phone.length > 10) {
      element.mask("(99) 99999-9999");
    } else {
      element.mask("(99) 9999-9999");
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

        var urlJsonGet = urlJs+urlAdmin+'cliente/delete/'+idRegistro;

        $.get(urlJsonGet, function (results) {
                  var objetos = results;

                  if(results.success){

                    notification('Exclusão','Realizada com sucesso!','success');

                    var body = $("html, body");
                    body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
                        location.reload();
                    });

                  }else{
                    notification('Exclusão','Realizada com erro!','error');
                    return false;
                  }
        
        });
        
      }
  }