<?php

namespace App\Funcoes;

use Exception;

class Funcoes
{
 
    public static function ultimadaDataMes($ano, $mes)
    {
        return date("t", mktime(0,0,0,$mes,'01',$ano)); // Mágica, plim!

    } 
    //------------------------*****************************--------------------
    //------------------------*****************************--------------------
    //------------------------*****************************--------------------
    //------------------------*****************************--------------------


    public static function mesEscrito($mes)
    {
        $escrita = '';
        $arr_meses = array(
          '01' => 'Janeiro',
          '02' => 'Fevereiro',
          '03' => 'Março',
          '04' => 'Abril',
          '05' => 'Maio',
          '06' => 'Junho',
          '07' => 'Julho',
          '08' => 'Agosto',
          '09' => 'Setembro',
          '10' => 'Outubro',
          '11' => 'Novembro',
          '12' => 'Dezembro'
       );

        foreach ($arr_meses as $key => $value) {
            if($key==$mes)
                $escrita = $value;
        }

        return $escrita;

    }

    public static function mesAnterio($data,$type)
    {

        $arrayData = explode('-', $data);
        $dataN = '01-'.$arrayData[1].'-'.$arrayData[0];

        $dt = date('d/m/Y', strtotime('-30 days', strtotime($dataN)));
        
        $arrayDt = explode('/', $dt);

        $mesEscrito = Funcoes::mesEscrito($arrayDt[1]);

        if($type=='escrita')
          return $mesEscrito.'/'.$arrayDt[2];
        else
          return $arrayDt[2].'-'.$arrayDt[1].'-'.Funcoes::ultimadaDataMes($arrayDt[2], $arrayDt[1]);

    }

    /************************************/

    public static function gravarValorBD($valor){
      $valor = str_replace(",",".",str_replace(".","",$valor));
      
      return $valor; 
    }

    /*
    echo mask($cnpj,'##.###.###/####-##');
    echo mask($cpf,'###.###.###-##');
    echo mask($cep,'#####-###');
    echo mask($data,'##/##/####');
    */
    public static function mask($val, $mask)
    {
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


  public static function converteData($data){
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


  public static function RandomPass($numchar){  
   $letras = "A,B,C,D,E,F,G,H,I,J,K,1,2,3,4,5,6,7,8,9,0";  
   $array = explode(",", $letras);  
   shuffle($array);  
   $senha = implode($array, "");  
   return substr($senha, 0, $numchar);  
  } 

  public static function addDiasData ($data,$dias){

  $data = explode ("-", $data);
  $dia = $data[2];
  $mes = $data[1];
  $ano = $data[0];
  $proxima_data = mktime(0, 0, 0, date($mes), date($dia) + $dias, date($ano));
  $proxima_data = date("d/m/Y", $proxima_data);
  
  
  return $proxima_data;
  }

  public static function removerUmMes($data)
  {
    return date("Y-m-d", strtotime( "-1 month", strtotime($data) ) );
  }
 



}