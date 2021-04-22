<?php
function slug( $string )
{
   //transforma $string em palavra amigavel ex: slug( 'frase composta, frase ação' ) para: (frase-composta, frase-acao' )
   return strtolower(preg_replace( array( '/([`^~\'"])/', '/([-]{2,}|[-+]+|[\s]+)/', '/(,-)/' ), array( null, '-', ', ' ), iconv( 'UTF-8', 'ASCII//TRANSLIT', $string ) ));
}

function RandomPass($numchar){  
   $letras = "A,B,C,D,E,F,G,H,I,J,K,1,2,3,4,5,6,7,8,9,0";  
   $array = explode(",", $letras);  
   shuffle($array);  
   $senha = implode($array, "");  
   return substr($senha, 0, $numchar);  
}  

function limpaCPF_CNPJ($valor){
 $valor = trim($valor);
 $valor = str_replace(".", "", $valor);
 $valor = str_replace(",", "", $valor);
 $valor = str_replace("-", "", $valor);
 $valor = str_replace("/", "", $valor);
 $valor = str_replace("(", "", $valor);
 $valor = str_replace(")", "", $valor);
 $valor = str_replace(" ", "", $valor);
 return $valor;
}

function RandomPassNumber($numchar){  
   $letras = "1,2,3,4,5,6,7,8,9,0";  
   $array = explode(",", $letras);  
   shuffle($array);  
   $senha = implode($array, "");  
   return substr($senha, 0, $numchar);  
} 

function deletaImagemTemp($nomeImagem){
	
  	$apagar1 = "../../assets/uploadTemp/img_full/".$nomeImagem;
  		@unlink($apagar1);
  	$apagar2 = "../../assets/uploadTemp/img_large/".$nomeImagem;  		 
  		@unlink($apagar2);
  	$apagar3 = "../../assets/uploadTemp/img_medium/".$nomeImagem;  		 
  		@unlink($apagar3);	
  	$apagar4 = "../../assets/uploadTemp/img_small/".$nomeImagem;  		 
  		@unlink($apagar4);

  	return true;

}

function deletaImagem($nomeImagem){
	
  	$apagar1 = "../../assets/upload/img_full/".$nomeImagem;
  		@unlink($apagar1);
  	$apagar2 = "../../assets/upload/img_large/".$nomeImagem;  		 
  		@unlink($apagar2);
  	$apagar3 = "../../assets/upload/img_medium/".$nomeImagem;  		 
  		@unlink($apagar3);	
  	$apagar4 = "../../assets/upload/img_small/".$nomeImagem;  		 
  		@unlink($apagar4);

  	return true;

}

function deletaImagemUser($nomeImagem){
  
    $apagar1 = "../../assets/upload/user/img_full/".$nomeImagem;
      @unlink($apagar1);
    $apagar2 = "../../assets/upload/user/img_large/".$nomeImagem;       
      @unlink($apagar2);
    $apagar3 = "../../assets/upload/user/img_medium/".$nomeImagem;      
      @unlink($apagar3);  
    $apagar4 = "../../assets/upload/user/img_small/".$nomeImagem;       
      @unlink($apagar4);

    return true;

}

function deletaFileUser($file){
  
    $apagar1 = "../../assets/upload/user/voice/".$file;
      @unlink($apagar1);
    return true;

}

function deletaImagemProduto($nomeImagem){
  
    $apagar1 = "../../assets/upload/products/img_full/".$nomeImagem;
      @unlink($apagar1);
    $apagar2 = "../../assets/upload/products/img_large/".$nomeImagem;       
      @unlink($apagar2);
    $apagar3 = "../../assets/upload/products/img_medium/".$nomeImagem;      
      @unlink($apagar3);  
    $apagar4 = "../../assets/upload/products/img_small/".$nomeImagem;       
      @unlink($apagar4);

    return true;

}

function deletaDocumento($nomeFile){
  
    $apagar1 = "../../assets/upload/arquivo/".$nomeFile;
      @unlink($apagar1);

    return true;

}

function deletaArquivoConsultor($nomeFile){
  
    $apagar1 = "../../assets/files/".$nomeFile;
      @unlink($apagar1);

    return true;

}

function deletaDocumentoPDFTemp($nomeFile){
  
    $apagar1 = "../../assets/uploadTemp/arquivo/".$nomeFile;
      @unlink($apagar1);

    return true;

}

function deletaMP3Temp($nomeFile){
  
    $apagar1 = "../../assets/uploadTemp/arquivo/".$nomeFile;
      @unlink($apagar1);

    return true;

}

function deletaDocumentoPDFProduto($nomeFile){
  
    $apagar1 = "../../assets/upload/products/pdf/".$nomeFile;
      @unlink($apagar1);

    return true;

}

function deletaDocumentoPDFDuvidaResposta($nomeFile){
  
    $apagar1 = "../../assets/upload/doubts/".$nomeFile;
      @unlink($apagar1);

    return true;

}

function moveImg($caminhoOrigem,$caminhoDestino,$arquivo){
			
  $caminhoOrigemDeleteAux = explode('/', $caminhoOrigem);
  $caminhoOrigemDelete = '../../'.$caminhoOrigemDeleteAux[1].'/'.$caminhoOrigemDeleteAux[2].'/'.$caminhoOrigemDeleteAux[3].'/'.$arquivo;
  

	$de = $caminhoOrigem.'/'.$arquivo;
  	$para = $caminhoDestino.'/'.$arquivo;
  	copy($de, $para);
	@unlink($caminhoOrigemDelete);
		 	
}

function moveMP3($caminhoOrigem,$caminhoDestino,$arquivo){
      
  //$caminhoOrigemDeleteAux = explode('/', $caminhoOrigem);
  //$caminhoOrigemDelete = '../../'.$caminhoOrigemDeleteAux[1].'/'.$caminhoOrigemDeleteAux[2].'/'.$caminhoOrigemDeleteAux[3].'/'.$arquivo;
  

    $de = $caminhoOrigem.'/'.$arquivo;
    $para = $caminhoDestino.'/'.$arquivo;
    copy($de, $para);
  //@unlink($caminhoOrigemDelete);
      
}

function converteData($data){
  if (strstr($data, "/")){
    $A = explode ("/", $data);
    $V_data = $A[2] . "-". $A[1] . "-" . $A[0];
  }
  else{
    $A = explode ("-", $data);
    $V_data = $A[2] . "/". $A[1] . "/" . $A[0]; 
  }
  return $V_data;
}

function cropImagemProdutoTemp($arquivo,$pastaOrigem,$pastaDestino,$type,$width,$height){
  
  include_once("resize-class.php");

  $diretorio = '../uploadTemp/'.$pastaOrigem.'/';
  $img = $diretorio.$arquivo;

  // *** 1) Initialise / load image
  $resizeObj = new resize($img);

  // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
  $resizeObj -> resizeImage($width, $height, $type);

  // *** 3) Save image
  $img2 = "../uploadTemp/".$pastaDestino."/".$arquivo;
  $resizeObj -> saveImage($img2, 100);

}


function addDiasData ($data,$dias){

  $data = explode ("-", $data);
  $dia = $data[2];
  $mes = $data[1];
  $ano = $data[0];
  $proxima_data = mktime(0, 0, 0, date($mes), date($dia) + $dias, date($ano));
  $proxima_data = converteData(date("d/m/Y", $proxima_data));
  
  
  return $proxima_data;
}


function subtractDiasData($data,$dias){

  $data_substraida = date('Y-m-d', strtotime('-'.$dias.' days', strtotime($data)));
  
  
  return $data_substraida;
}



function diferencaDiasEntreDatas ($dataInicial,$dataFinal){

  $data_inicial = $dataInicial; //'aaaa-mm-dd';
  $data_final = $dataFinal;//'aaaa-mm-dd';
  // Usa a função strtotime() e pega o timestamp das duas datas:
  $time_inicial = strtotime($data_inicial);
  $time_final = strtotime($data_final);
  // Calcula a diferença de segundos entre as duas datas:
  $diferenca = $time_final - $time_inicial; // 19522800 segundos
  // Calcula a diferença de dias
  $dias = (int)floor( $diferenca / (60 * 60 * 24)); 
  
  
  return $dias;
}

function diferencaMesesEntreDatas ($dataInicial,$dataFinal){

  $data_ini  = $dataInicial;
  $data_end  = $dataFinal;
   
  $diferenca = strtotime($data_end) - strtotime($data_ini);
   
  $meses = floor($diferenca / (60 * 60 * 24 * 30));
   
  return $meses;

}

function adicionarAnoData($data,$dia = null){

    $date_sum_year = date('d/m/Y', strtotime( '+1 year', strtotime( $data) ) );

    $dataArray = explode('/', $date_sum_year);

    return $dia.'/'.$dataArray[1].'/'.$dataArray[2];
}

function adicionarMesData($data,$qtMeses){

    $date_sum_month = date('d/m/Y', strtotime( '+'.$qtMeses.' month', strtotime( $data) ) );

    return $date_sum_month;
}

function diaSemana($data) {

  $diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');

  //$data = date('Y-m-d');

  $diasemana_numero = date('w', strtotime($data));

  $resp = $diasemana[$diasemana_numero];

  return  $resp;
}


function replace($de, $para, $texto){

    return $texto = str_replace($de, $para, $texto);
    
}

function calcularIdade($data){
  // Declara a data! :P
    //$data = '29/08/2008';
   
    // Separa em dia, mês e ano
    list($dia, $mes, $ano) = explode('/', $data);
   
    // Descobre que dia é hoje e retorna a unix timestamp
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    // Descobre a unix timestamp da data de nascimento do fulano
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
   
    // Depois apenas fazemos o cálculo já citado :)
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
    
    return $idade;
}


function mask($val, $mask){
 $maskared = '';
 $k = 0;
 for($i = 0; $i<=strlen($mask)-1; $i++)
 {
 if($mask[$i] == '#')
 {
 if(isset($val[$k]))
 $maskared .= $val[$k++];
 }
 else
 {
 if(isset($mask[$i]))
 $maskared .= $mask[$i];
 }
 }
 return $maskared;
}

function gravarValorMoeda($valor){
  $valor = str_replace(",",".",str_replace(".","",$valor));
  
  return $valor; 
}

function criarSlug($texto){
  $trocarIsso = array('à','á','â','ã','ä','å','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ù','ü','ú','ÿ','À','Á','Â','Ã','Ä','Å','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','O','Ù','Ü','Ú','Ÿ',' ','%','&',',','!','/','?',"'",'"','#');
  $porIsso = array('a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','u','u','u','y','A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','O','U','U','U','Y','-','-','e','-','','-','','','-','-');
  $titletext = strtolower(str_replace($trocarIsso, $porIsso, $texto));
  $titletext = strtolower(str_replace('--', '-', $titletext));
  return $titletext;
}

function mesPorEscrito($mes){
  $meses = array(
    '01'=>'Janeiro',
    '02'=>'Fevereiro',
    '03'=>'Março',
    '04'=>'Abril',
    '05'=>'Maio',
    '06'=>'Junho',
    '07'=>'Julho',
    '08'=>'Agosto',
    '09'=>'Setembro',
    '10'=>'Outubro',
    '11'=>'Novembro',
    '12'=>'Dezembro'
);

return $meses[$mes];
}


/** Para somar +1 dia faça: */

//$date_sum_day= date(“d/m/Y”, strtotime( “+1 day”, strtotime( $date) ) );

//echo$date_sum_day; //

 

/** Para somar +1 mês */

//$date_sum_month= date(“d/m/Y”, strtotime( “+1 month”, strtotime( $date) ) );

//echo$date_sum_month; //

 

/** Para somar +1 ano */

//$date_sum_year= date(“d/m/Y”, strtotime( “+1 year”, strtotime( $date) ) );

//echo$date_sum_year; //

?>