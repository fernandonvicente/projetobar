<?php 
require_once('funcoesGeral.php');
require_once('uploadArquivo.php');

	if($_FILES['arquivo']){

		$filesize = ($_FILES['arquivo']["size"] / 1024);//Pega size da imagem

		//$dimensoes = getimagesize($_FILES['arquivo']["tmp_name"]);// Pega as dimensao da imagem
		
		$codigo = RandomPass("8");

		if($_FILES['arquivo']['name']){
			$arquivo = $_FILES['arquivo'];
 			//$arquivoName = $_FILES['arquivo']['name'];
 			$arquivoName = $codigo.'-'.slug($_FILES['arquivo']['name']);
 			$nomeImagem = $codigo.'-'.slug($_FILES['arquivo']['name']);
 			$arquivoTemp = $_FILES['arquivo']['tmp_name'];

 			if(isset($_REQUEST['tipoArquivo']) && $_REQUEST['tipoArquivo']=='arquivo')
				$resp = upload_documento($arquivoName, $arquivoTemp, $nomeImagem);
			else if(isset($_REQUEST['tipoArquivo']) && $_REQUEST['tipoArquivo']=='mp3')
				$resp = upload_mp3($arquivoName, $arquivoTemp, $nomeImagem);			
			else
				$resp = upload_arquivo($arquivoName, $arquivoTemp, $nomeImagem);

			if($resp=="okUpload"){
				//echo $nomeImagem;
				echo json_encode($arquivoName);
			}else{
				//echo $resp;
				echo json_encode($resp);
			}
		}				
		
	}

