<?php

function upload_documento($arquivoName,$arquivoTemp,$nameFileOriginal){

		//$caminho_arquivo = '../../assets/uploadTemp/arquivo/'. $nameFileOriginal;
		$caminho_arquivo = '../../assets/files/'. $nameFileOriginal;

		//a funcao php move_uploaded_file copia os arquivos enviados para o caminho que voc� desejar 
		if (move_uploaded_file($arquivoTemp, $caminho_arquivo)) { 
		  	$resp = "okUpload";//em caso de erro na copia do arquivo reposta vai ter o valor 'ok'
		} else {
			$resp = "erroUpload";//em caso de erro na copia do arquivo reposta vai ter o valor 'erro'
		}

    return $resp;	
}
 
function upload_arquivo($arquivoName,$arquivoTemp,$nameFileOriginal){

		$caminho_arquivo = '../../assets/uploadTemp/img_full/'. $nameFileOriginal;

		//a funcao php move_uploaded_file copia os arquivos enviados para o caminho que voc� desejar 
		if (move_uploaded_file($arquivoTemp, $caminho_arquivo)) { 
		  	$resp = "okUpload";//em caso de erro na copia do arquivo reposta vai ter o valor 'ok'
		} else {
			$resp = "erroUpload";//em caso de erro na copia do arquivo reposta vai ter o valor 'erro'
		}

    return $resp;	
}

function upload_img_full($foto,$arquivoName,$arquivoTemp,$nameFileOriginal){

		$caminho_arquivo = '../../assets/uploadTemp/img_full/'.$nameFileOriginal;
	
		//a funcao php move_uploaded_file copia os arquivos enviados para o caminho que voce desejar 
		if (move_uploaded_file($arquivoTemp, $caminho_arquivo)) { 
		  	$resp = "okUpload";//em caso de erro na copia do arquivo reposta vai ter o valor 'ok'
		} else {
			$resp = "erroUpload";//em caso de erro na copia do arquivo reposta vai ter o valor 'erro'
		}

    return $resp;	
}

function upload_mp3($arquivoName,$arquivoTemp,$nameFileOriginal){
	
	ini_set('post_max_size', '40M');
	ini_set('upload_max_filesize', '40M');

	$caminho_arquivo = '../../assets/upload/mp3/'. $nameFileOriginal;

	//a funcao php move_uploaded_file copia os arquivos enviados para o caminho que voc� desejar
	if (move_uploaded_file($arquivoTemp, $caminho_arquivo)) {
		$resp = "okUpload";//em caso de erro na copia do arquivo reposta vai ter o valor 'ok'
	} else {
		$resp = "erroUpload";//em caso de erro na copia do arquivo reposta vai ter o valor 'erro'
	}

	return $resp;
}