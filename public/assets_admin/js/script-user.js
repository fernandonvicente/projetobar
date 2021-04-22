jQuery(document).ready(function(){

	var urlJs = $('#urlJs').val();//recuperando a url, para ser usada via ajax
	var urlAdmin = '/bayareaadmin/';
	
	$("#formNews").submit(function( event ) {

			var form=$("#formNews");

			if(!$('#status_bt').val()){

				$('#status_bt').val(1);

				$('.btn-success').html('<i class="fa fa-refresh fa-spin"></i> Enviando...');



				var urlJason;
				var news_id = '';
				if($('#news_id').val())
					news_id = $('#news_id').val();

				//----------------------------------------------------------------------------------------------------

				if($('#news_id').val() > 0){
					urlJason = urlJs+urlAdmin+'news/edit/'+news_id;
				}else{
					urlJason = urlJs+urlAdmin+'news/store';
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

							if(news_id > 0){
								$('.btn-success').html('<i class="fa fa-fw fa-save"></i> Salvar');

								alertSuccess('Sucesso no processo de alteração da notícia.');

								$('#alert-msg').show();

								var body = $("html, body");
								body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
								   //alert("Finished animating");
								});

								var novaURL = urlJs+"/gpbrasil/news/index";
								$(window.document.location).attr('href', novaURL);


							}else if(news_id == 0){
								$('.btn-success').html('<i class="fa fa-fw fa-save"></i> Salvar');

								alertSuccess('Sucesso no processo de cadastro da notícia.');

								$('#alert-msg').show();

								var body = $("html, body");
								body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
								   //alert("Finished animating");
								});

								var novaURL = urlJs+"/gpbrasil/news/index";
								$(window.document.location).attr('href', novaURL);
							}
				          
				          
				        }else{
				          $('.btn-success').html('<i class="fa fa-fw fa-save"></i> Salvar');
				         
				          alertError('Erro na processo de cadastrar ou alterar notícia.');

				          $('#alert-msg').show();

				          var 	body = $("html, body");
								body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
								   //alert("Finished animating");
								});

				          return false;
				        }

					},
					error:function(){
						$('.btn-success').html('<i class="fa fa-fw fa-save"></i> Salvar');				         
				        alertError('Erro ao enviar cadastro.');
					}

				})
			}

	});

	

	$("#role").change(function( event ) {

		var role = $('#role').val();

		var novaURL = urlJs+"/bayareaadmin/user/permission/role/"+role;
		$(window.document.location).attr('href', novaURL);

	});


	function alertError(msg){

			var div = '<div class="alert alert-danger alert-dismissible">';
              	div += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
              	div += '<h4><i class="icon fa fa-ban"></i> Alerta!</h4>';
              	div += msg;
            	div += '</div>';

            $('#alert-msg').html(div);

            return true;
	}

	function alertSuccess(msg){

			var div = '<div class="alert alert-success alert-dismissible">';
              	div += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
              	div += '<h4><i class="icon fa fa-check"></i> Alerta!</h4>';
              	div += msg;
            	div += '</div>';

            $('#alert-msg').html(div);

            return true;
	}

	//------------------------
})
