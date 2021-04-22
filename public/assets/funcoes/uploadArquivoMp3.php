<?php 
require_once('funcoesGeral.php');
require_once('uploadArquivo.php');

ini_set('post_max_size', '4M');
ini_set('upload_max_filesize', '4M');

	if($_FILES['inputFileMP3']){

		$filesize = ($_FILES['inputFileMP3']["size"] / 1024);//Pega size da imagem

		$dimensoes = getimagesize($_FILES['inputFileMP3']["tmp_name"]);// Pega as dimensao da imagem
		
		$codigo = RandomPass("8");

		if($_FILES['inputFileMP3']['name']){
			$arquivo = $_FILES['inputFileMP3'];
 			$arquivoName = $_FILES['inputFileMP3']['name'];
 			//$nomeImagem = $codigo.'-'.criarSlug($_FILES['inputFileMP3']['name']);
 			$nomeImagem = $_FILES['inputFileMP3']['name'];
 			$arquivoTemp = $_FILES['inputFileMP3']['tmp_name'];
 			
 			$resp = upload_mp3($arquivoName, $arquivoTemp, $nomeImagem);

			if($resp=="okUpload"){
				//echo $nomeImagem;
				echo json_encode($nomeImagem);
			}else{
				//echo $resp;
				echo json_encode($resp);
			}
		}				
		
	}

?>