	
$(".buscaDadosCep").blur(function() {
	var urlJs = $('#urlJs').val();//recuperando a url, para ser usada via ajax

	var cep = $('#cep').val();
	
	var urlWebservice = urlJs+'/consultCep/'+cep;

	if(cep!='' && cep!='_____-___'){
		$.ajax({
	        url: urlWebservice,
	        type: "get",
	        dataType: 'html',
	        success: function(result){

	        	var obj = jQuery.parseJSON(result);

	        	if(obj.logradouro)
	        		$('#endereco').val(obj.logradouro);
	        	if(obj.bairro)
	        		$('#bairro').val(obj.bairro);
	        	
	        	$('#valueCity').val(obj.cidade.toUpperCase());
	        	$('#state').val(obj.uf);
	        	//$('#latitude').val(obj.lat);
	        	//$('#longitude').val(obj.long);
	        	//$('#ibge').val(obj.ibge);
	        	if(obj.logradouro)
	        		$('#num').focus();
	        	else
	        		$('#endereco').focus();
	        	
	        	//carrego as cidades do estado e seto cidade correspondente----------
				if(obj.uf){

					//após setar estado, carregar as cidade
					setTimeout(function(){

						carregarCidadesPorUF(obj.uf);

						setTimeout(function(){

							$('#city').val($('#valueCity').val());

						}, 3000);


					}, 2000);

				}
	        	//-------------------------------------------------------------------
	 
	        	if($('#admin').val()){
	        		$('#error_confirmar_lat_lng').hide();
	        	}
	        },
	        error:function(){
	            alert("Não foi possível carregar os dados. Tente novamente!");
	            return false;
	        }
		});
	}
});

$(".buscaDadosCepInstalacao").blur(function() {
	var urlJs = $('#urlJs').val();//recuperando a url, para ser usada via ajax

	var cep = $('#cepInstalacao').val();
	
	var urlWebservice = urlJs+'/consultCep/'+cep;

	if(cep!='' && cep!='_____-___'){
		$.ajax({
	        url: urlWebservice,
	        type: "get",
	        dataType: 'html',
	        success: function(result){

	        	var obj = jQuery.parseJSON(result);

	        	if(obj.logradouro)
	        		$('#enderecoInstalacao').val(obj.logradouro);
	        	if(obj.bairro)
	        		$('#bairroInstalacao').val(obj.bairro);
	        	
	        	$('#valueCityInstalacao').val(obj.cidade.toUpperCase());
	        	$('#stateInstalacao').val(obj.uf);
	        	$('#latitudeInstalacao').val(obj.lat);
	        	$('#longitudeInstalacao').val(obj.long);
	        	//$('#ibge').val(obj.ibge);
	        	if(obj.logradouro)
	        		$('#numInstalacao').focus();
	        	else
	        		$('#enderecoInstalacao').focus();
	        	
	        	//carrego as cidades do estado e seto cidade correspondente----------
				if(obj.uf){

					//após setar estado, carregar as cidade
					setTimeout(function(){

						carregarCidadesPorUFInstalacao(obj.uf);

						setTimeout(function(){

							$('#cityInstalacao').val($('#valueCityInstalacao').val());

						}, 3000);


					}, 2000);

				}
	        	//-------------------------------------------------------------------
	 
	        	if($('#admin').val()){
	        		$('#error_confirmar_lat_lng').hide();
	        	}
	        },
	        error:function(){
	            alert("Não foi possível carregar os dados. Tente novamente!");
	            return false;
	        }
		});
	}
});

$(".importarEnderecoCadastro").click(function( event ) {
var urlJs = $('#urlJs').val();//recuperando a url, para ser usada via ajax

	var cep = $('#cep').val();
	
	var urlWebservice = urlJs+'/consultCep/'+cep;

	if(cep!='' && cep!='_____-___'){
		$.ajax({
	        url: urlWebservice,
	        type: "get",
	        dataType: 'html',
	        success: function(result){

	        	var obj = jQuery.parseJSON(result);

	        	$('#cepInstalacao').val(cep);

	        	if(obj.logradouro)
	        		$('#enderecoInstalacao').val(obj.logradouro);
	        	if(obj.bairro)
	        		$('#bairroInstalacao').val(obj.bairro);
	        	
	        	$('#valueCityInstalacao').val(obj.cidade.toUpperCase());
	        	$('#stateInstalacao').val(obj.uf);
	        	$('#latitudeInstalacao').val(obj.lat);
	        	$('#longitudeInstalacao').val(obj.long);
	        	//$('#ibge').val(obj.ibge);
	        	if(obj.logradouro)
	        		$('#numInstalacao').focus();
	        	else
	        		$('#enderecoInstalacao').focus();
	        	
	        	//carrego as cidades do estado e seto cidade correspondente----------
				if(obj.uf){

					//após setar estado, carregar as cidade
					setTimeout(function(){

						carregarCidadesPorUFInstalacao(obj.uf);

						setTimeout(function(){

							$('#cityInstalacao').val($('#valueCityInstalacao').val());

						}, 3000);


					}, 2000);

				}
	        	//-------------------------------------------------------------------
	 
	        	if($('#admin').val()){
	        		$('#error_confirmar_lat_lng').hide();
	        	}
	        },
	        error:function(){
	            alert("Não foi possível carregar os dados. Tente novamente!");
	            return false;
	        }
		});
	}

 });


function carregarCidadesPorUF(idState){
	//mudando descrição do combobox unidade, caso não tenha selecionado nenhuma
	if($("#state").val()=='')
	$('#city').html('<option value="">Selecione o estado *</option>');

	if($("#state").val()){

		var urlJs = $('#urlJs').val();//recuperando a url, para ser usada via ajax

		//mudando descrição do combobox unidade
		$('#city').html('<option value="">Selecione uma cidade *</option>');

		$.ajax({
			url: urlJs+"/getCities/"+idState,
			type: "get",
			dataType: 'html',
			success: function(cities){

				var objCities = eval(cities);

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

		var urlJs = $('#urlJs').val();//recuperando a url, para ser usada via ajax

		//mudando descrição do combobox unidade
		$('#cityInstalacao').html('<option value="">Selecione uma cidade *</option>');

		$.ajax({
			url: urlJs+"/getCities/"+idState,
			type: "get",
			dataType: 'html',
			success: function(cities){

				var objCities = eval(cities);

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
//fim da parte do cadastro---------------------------------------------------------------	
 

//****inicio google maps cadastro-------------------------------------------------------------------------
//$('#check-mapa-confirma').hide();


function getLatLongConfirmacao(){
	
	var urlWebservice = 'classe/Empresa.php';
	if($('#admin').val()){
		urlWebservice = '../classe/Empresa.php';
	}

	var endereco = $('#endereco').val();
	var cidade = $('#cidade').val();
	var bairro = $('#bairro').val();
	var uf = $("#estado option:selected").text();
	var num = $('#num').val();

	if(endereco && cidade && uf){
	
		var acao = "getLatLongConfirmacao"; 
		$.ajax({
	        url: urlWebservice,
	        type: "post",
	        dataType: 'html',
	        data: {'endereco':endereco,'num':num,'cidade':cidade,'uf':uf,'bairro':bairro,'acao':acao},
	        success: function(retorno){

	        	retorno = retorno.split("|");
	        	if(retorno[0])
	        		$('#lat_confirmado').val(retorno[0]);
	        	if(retorno[1])
	        		$('#long_confirmado').val(retorno[1]);
	        	
	        	if(retorno[0] && retorno[1]){
	        		showMap('',retorno[0],retorno[1]);//monta o mapa com a lat e long do endereço
	        	}else{
	        		$('#map_canvas').html('<p style="color: #ff0000; font-weight: bold;">Não foi possível carregar o mapa, favor verificar seu endereço!</p>');
	        	}	        	
	        	
	        },
	        error:function(){
	            alert("erro de carregar dados getLatLongConfirmacao");
	            return false;
	        }
		});
	}
}


function initialize() {
	var lat = '';//-23.5625267;
	var lng = '';//-46.6554438;
	var text = "";

	showMap(text,lat,lng);
}

if($('#pagina').val()=='cadastrar'){
	google.maps.event.addDomListener(window, 'load', initialize);//usado para inicializar o mapa
}
//monto o mapa
function showMap(text,lat,lng){

        var mapOptions = {
          zoom: 17,
          center: new google.maps.LatLng(lat,lng),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };

	var mapDiv = document.getElementById('map_canvas');
        var map = new google.maps.Map(mapDiv,mapOptions);

        var marker = new google.maps.Marker({
          position: map.getCenter(),
	  draggable: true,
          map: map,
          title: text
        });

	//----------------------------------------------
	  $('#lat').html(mapOptions.center.lat());
          $('#lng').html(mapOptions.center.lng());
          $('#lat2').val(mapOptions.center.lat());
          $('#lng2').val(mapOptions.center.lng());
	//----------------------------------------------

	google.maps.event.addListener(marker, "dragend", function() {
		//----------------------------------------------
		  $('#lat').html(marker.getPosition().lat());
		  $('#lng').html(marker.getPosition().lng());
		  $('#lat2').val(marker.getPosition().lat());
		  $('#lng2').val(marker.getPosition().lng());
		//----------------------------------------------
	});

}

$(".abrirModalMaps").blur(function(e){
	var enderecox = $('#endereco').val();
	var cidadex = $('#cidade').val();
	var ufx = $('#estado').val();
	
    if(enderecox && cidadex && ufx){
    
        getLatLongConfirmacao();//função que pegar o endereço, gera o lat e long e exibe o mapa

        $("#mapa-confirma, #mask").fadeIn(150);
    }
});

$(".confirmarLocalizacao").click(function(e){
	$('#error_confirmar_lat_lng').html('');
    $('#lat_confirmado').val($('#lat2').val());
    $('#long_confirmado').val($('#lng2').val());
    $("#mapa-confirma, #mask").fadeOut(150); 
    $("#tel").focus(); 
});
