<?php

namespace App\Http\Controllers\All;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CepController extends Controller
{  

    public function testeX()
    {
echo "string";
    }

    /*
    * getAddressByZipCode o CEP tem que ter um -, como 19400-000
    */
    
    public function getAddressByZipCode($zipCode)
    {
        ini_set('allow_url_fopen',1);
        ini_set("allow_url_include", 1);
        //via o cep, recupero  os dados de endereço-----------------------------------------
        $cep  = $zipCode;

        //$cep = preg_replace("/[^0-9]/", "", $cep);//pegando só numero do cep

        $qtCaracterCep = strlen($cep);//contando a qt de caracter do cep

        if($qtCaracterCep == 9){
            
            $pos = strpos($cep, '-');
            if(!$pos){
                $dados['message_error_cep'] = 'Incorrect zip - diferente de 9 caracter (00000-000)';

                return $dados;
            }


            /*
            $urlJson = 'https://viacep.com.br/ws/'.$cep.'/json/';

            $json_file = file_get_contents($urlJson);   
            $json_str = json_decode($json_file, true);
            */
            $curl = curl_init();
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://viacep.com.br/ws/'.$cep.'/json/',
                CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ]);
            // Send the request & save response to $resp
            //$json_str = curl_exec($curl);
            $json_str = json_decode(curl_exec($curl), true);
            // Close request to clear up some resources
            curl_close($curl);

            if(isset($json_str['erro']) && $json_str['erro'] == 1){

                //para no caso de cep inesistente 

                return response()->json([
                'message'   => 'Incorrect zip - viacep',
                ], 400);

            }else{

                //para caso de cep OK

                $dados['cep'] =  $cep;
                $dados['cidade'] = trim($json_str['localidade']);
                $dados['uf'] = trim($json_str['uf']);
                $dados['logradouro'] = trim($json_str['logradouro']);
                $dados['bairro'] = trim($json_str['bairro']);
                $dados['ibge'] = trim($json_str['ibge']); 

                $dadosCidadeUF = $dados['cidade'].'+'.$dados['uf'];

                //desbloquei o SSL local-------------------------------------------------------------
                stream_context_set_default([
                    'ssl' =>[
                    'verify_peer' => false,
                     'verify_peer_name' => false,
                    ]
                ]);  

                //$dadosLatLong = $this->getLatitudeLongitudeByCityState($cep);

                $dados['lat'] = '';
                $dados['long'] = '';
                $dados['message_error_cep'] = null;

                return $dados;
            }


        }else{ 
            //para no caso de cep com qtidde menor/maior de 8 caracter 

            /*return response()->json([
                'message'   => 'Incorrect zip - diferente de 8 caracter',
            ], 400);
            */

            $dados['message_error_cep'] = 'Incorrect zip - diferente de 9 caracter (00000-000)';

            return $dados;
        }
        
    }

    public function getLatitudeLongitudeByCityState($cep)
    {
        
        $geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$cep.'&sensor=false');
                 
        $output = json_decode($geocode);
       
        $lat = $output->results[0]->geometry->location->lat;
        $long = $output->results[0]->geometry->location->lng;
        
        $loc['lat'] = $lat;
        $loc['long'] = $long;

        return $loc;
    }

    public function distanciaLatLong($lat1, $lon1, $lat2, $lon2, $unit) 
    {
        /*
         $unit
         m = milhas
         k = Km
         n = Milhas Nauticas
         */

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        
        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }

    }

    public function verificaDistanciaPorOutorga($outorgaTemp,$outorgaEmpresa)
    {
        //3 é COM
        if( (($outorgaTemp == 'COM') && ($outorgaEmpresa == 'COM')) || (($outorgaTemp == 'COM') && ($outorgaEmpresa == 'WEB')) )
            $km = 30;
        elseif( (($outorgaTemp == 'WEB') && ($outorgaEmpresa == 'WEB')) || (($outorgaTemp == 'WEB') && ($outorgaEmpresa == 'COM')) )
            $km = 30;
        else
            $km = 60;

        return $km;
    }
   
}
