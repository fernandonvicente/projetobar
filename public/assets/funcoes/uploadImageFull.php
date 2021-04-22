<?php 
require_once('funcoesGeral.php');
require_once('uploadArquivo.php');


if($_REQUEST['tipoArquivo']=="imagem"){

	if($_FILES['arquivo']){

		$filesize = ($_FILES['arquivo']["size"] / 1024);//Pega size da imagem

		$dimensoes = getimagesize($_FILES['arquivo']["tmp_name"]);// Pega as dimensao da imagem
		
		$codigo = RandomPass("8");

		if($_FILES['arquivo']['name']){
			$arquivo = $_FILES['arquivo'];
 			$arquivoName = $_FILES['arquivo']['name'];
 			$nomeImagem = $codigo.'-'.slug($_FILES['arquivo']['name']);
 			$arquivoTemp = $_FILES['arquivo']['tmp_name'];
			$resp = upload_img_full($arquivo, $arquivoName, $arquivoTemp, $nomeImagem);
			if($resp=="okUpload"){
				cropImagemProdutoTemp($nomeImagem,"img_full","img_medium","crop",$_REQUEST['tamanhoImagemPequenaHorizontal'],$_REQUEST['tamanhoImagemPequenaVertical']);
				cropImagemProdutoTemp($nomeImagem,"img_full","img_large","crop",$_REQUEST['tamanhoImagemGrandeHorizontal'],$_REQUEST['tamanhoImagemGrandeVertical']);
				//echo $nomeImagem;
				//header('Content-Type: application/json');
				echo json_encode($nomeImagem);
			}else{
				//echo $resp;
				//header('Content-Type: application/json');
				echo json_encode($resp);
			}
		}				
		
	}
}

