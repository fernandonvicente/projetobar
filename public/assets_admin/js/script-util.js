jQuery(document).ready(function(){

	var urlJs = $('#urlJs').val();//recuperando a url, para ser usada via ajax
	var urlAdmin = '/bayareaadmin/';

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

     $(".validarEmail").change(function() {
	  	$('#msg_email_invalido').html('');
    	var resp = validEmail($('#forum_email').val());
    
    	if(!resp){
    		$('#msg_email_invalido').html('Por favor, verifique campo E-mail, pois está incorreto!');
    		$('#forum_email').focus();
    		return false;
    	}
	});


    

	//$('.dinheiro').mask('#.##0,00', {reverse: true});
	//$(".maskTel").mask("(99) 99999-9999");


	$(".cep").mask("99999-999");

	$(".celx").mask("(99) 99999-9999");
	$(".telx").mask("(99) 9999-9999");



	//carregando cidades pela UF selecionada
    $("#state").change(function() {
        var idState = $( this ).val();//precuperando o id do avo selecionado
        carregarCidadesPorUF(idState);
    });
	

	//----------carregando as cidades pela UF do estado--------------------------------------------------------
	function carregarCidadesPorUF(idState){
		//mudando descrição do combobox unidade, caso não tenha selecionado nenhuma
		if($("#state").val()=='')
		$('#city').html('<option value="">Selecione o estado *</option>');


		if($("#state").val()){

			//mudando descrição do combobox unidade
			$('#city').html('<option value="">Carregando as cidades...</option>');

			$.ajax({
				url: urlJs+"/getCities/"+idState,
				type: "get",
				dataType: 'html',
				success: function(cities){

					var objCities = eval(cities);

					$('#city').html('');
					$('#city').html('<option value="">Selecione uma cidade</option>');

					$.each( objCities, function( key, city ) {
						$('#city').append('<option value="'+city.name+'">'+city.name+'</option>');
					});

				},
				error:function(){
					alert("erro em carregar_cidade"); 
				}
			});
		}
	}


	function carregarCidadesPorUFInstalacao(idState){
		//mudando descrição do combobox unidade, caso não tenha selecionado nenhuma
		if($("#stateInstalacao").val()=='')
		$('#cityInstalacao').html('<option value="">Selecione o estado *</option>');


		if($("#stateInstalacao").val()){

			//mudando descrição do combobox unidade
			$('#cityInstalacao').html('<option value="">Carregando as cidades...</option>');

			$.ajax({
				url: urlJs+"/getCities/"+idState,
				type: "get",
				dataType: 'html',
				success: function(cities){

					var objCities = eval(cities);

					$('#cityInstalacao').html('');
					$('#cityInstalacao').html('<option value="">Selecione uma cidade</option>');

					$.each( objCities, function( key, city ) {
						$('#cityInstalacao').append('<option value="'+city.name+'">'+city.name+'</option>');
					});

				},
				error:function(){
					alert("erro em carregar_cidade"); 
				}
			});
		}
	}


	

	//----------- setando estado / cidade no perfil ao editar cadastro---------------------------------------------------------
	if($('#state').val() != ''){
	
		if($('#state').val()){

			//após setar estado, carregar as cidade
			setTimeout(function(){

				carregarCidadesPorUF($('#state').val()); 

				setTimeout(function(){

					$('#city').val($('#valueCity').val());

				}, 3000);


			}, 4000);
  
		}

	}

	//----------- setando estado / cidade no perfil ao editar cadastro---------------------------------------------------------
	if($('#stateInstalacao').val() != ''){
	
		if($('#stateInstalacao').val()){

			//após setar estado, carregar as cidade
			setTimeout(function(){

				carregarCidadesPorUFInstalacao($('#stateInstalacao').val()); 

				setTimeout(function(){
					console.log('cidade....:'+$('#valueCityInstalacao').val());

					$('#cityInstalacao').val($('#valueCityInstalacao').val());

				}, 4000);


			}, 5000);
  
		}

	}
	

})
//sem carregamento jquery

	function validEmail(value) {  
	    var valid = true;  
	    var emails = value.replace(';', ',').split(",");  
	  
	    jQuery.each(emails, function () {  
	        if (jQuery.trim(this) != '')  
	        {  
	            if (!jQuery.trim(this).match(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i))  
	                valid = false;  
	        }  
	    });  
	    return valid;  
	}

	