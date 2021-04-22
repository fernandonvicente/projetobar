jQuery(document).ready(function(){

	var urlJs = $('#urlJs').val();//recuperando a url, para ser usada via ajax
	var urlAdmin = '/bayareaadmin/';

	
	$("#loginClienteForm").submit(function( event ) {

			var form=$("#loginClienteForm");

			if(!$('#status_bt_cliente').val()){

				$('#status_bt_cliente').val(1);

				$('.btn-success-cliente').html(' <i class="fa fa-refresh fa-spin"></i> Logando...');

				var urlJason = urlJs+'/cliente/login';
				

				//console.log(urlJason);
				//return false;
				

				$.ajax({
					url: urlJason,
					type: "post",
					dataType: 'json',
					data:form.serialize(),
					success: function(results){

						if(results.success){

								$('.btn-success-cliente').html(' Login');
                $('#status_bt_cliente').val('');

								notification('Login','Realizado com sucesso!','success');

								var body = $("html, body");
								body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
                    $('#idRecord').val(results.result);

                    var novaURL = urlJs+'/area-cliente/cardapio';
                    $(window.document.location).attr('href', novaURL);
								});
				          
				    }else{
				          $('.btn-success-cliente').html(' Login');
                  $('#status_bt_cliente').val('');
				         
				           notification('Login','Não foi possível realizar o acesso!','error');

				          var 	body = $("html, body");
  								body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
  								   //alert("Finished animating");
  								});

				          return false;
				        }

					},
					error:function(){
						$('.btn-success-cliente').html(' Login');
            $('#status_bt_cliente').val('');
			         
				     notification('Login','Não foi possível fazer o acesso!','error');
					}

				})
			}

	});

  $("#cadastroClienteForm").submit(function( event ) {

      var form=$("#cadastroClienteForm");

      if(!$('#status_bt_cadastro_cliente').val()){

        $('#status_bt_cadastro_cliente').val(1);

        $('.btn-success-cadastro-cliente').html(' <i class="fa fa-refresh fa-spin"></i> Logando...');

        var urlJason = urlJs+'/cliente/store';

        //checando telefone--------------------------------
        if($('#login_telefone').val().length != 15){

          $('.btn-success-cadastro-cliente').html(' Inscrever-se');
          $('#status_bt_cadastro_cliente').val('');
                 
          notification('Telefone','Estão faltando números!','error');

          var   body = $("html, body");
          body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
             //alert("Finished animating");
          });

          return false;

        }

        //checando senha-----------------------------------
        if($('#login_senha').val() != $('#login_senha_conf').val()){

          $('.btn-success-cadastro-cliente').html(' Inscrever-se');
          $('#status_bt_cadastro_cliente').val('');
                 
          notification('Senha','As senhas estão diferentes!','error');

          var   body = $("html, body");
          body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
             //alert("Finished animating");
          });

          return false;

        }




        alert('ok');
        return false;


        //-------------------------------------------------
        

        //console.log(urlJason);
        //return false;
        

        $.ajax({
          url: urlJason,
          type: "post",
          dataType: 'json',
          data:form.serialize(),
          success: function(results){

            if(results.success){

                $('.btn-success-cadastro-cliente').html(' Inscrever-se');
                $('#status_bt_cadastro_cliente').val('');

                notification('Cadastro','Realizado com sucesso!','success');

                var body = $("html, body");
                body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
                    $('#idRecord').val(results.result);

                    var novaURL = urlJs+'/cliente/cadastro';
                    $(window.document.location).attr('href', novaURL);
                });
                  
            }else{
                  $('.btn-success-cadastro-cliente').html(' Inscrever-se');
                  $('#status_bt_cadastro_cliente').val('');
                 
                   notification('Cadastro','Não foi possível realizar!','error');

                  var   body = $("html, body");
                  body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
                     //alert("Finished animating");
                  });

                  return false;
                }

          },
          error:function(){
            $('.btn-success-cadastro-cliente').html(' Inscrever-se');
            $('#status_bt_cadastro_cliente').val('');
               
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

  $('.maskTel').keydown(function(){
    var phone, element;
    element = $(this);

    phone = element.val().replace(/\D/g, '');

    //if(phone.length > 11) {
      element.mask("(99) 99999-9999");
    //} else {
      //element.mask("(99) 9999-9999");
    //}

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

function verComanda(comanda_id){
alert(comanda_id);
}

//------------------------




	