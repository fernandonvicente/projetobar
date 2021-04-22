<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\All\State;
use App\Models\All\City;

class CityController extends Controller
{

    private $stateModel;
    private $cityModel;


    public function __construct(State $state, City $city){
        $this->stateModel = $state;
        $this->cityModel = $city;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


   /*
    *receuperando as cidades do estado
   */

    public function getCities($idState)
    {
        $state = $this->stateModel->where('uf',$idState)
                                  ->get()
                                  ->first();

        /*$cities = $state->cities()->getQuery()->get(['nome', 'nome']);
        */

        $cities = $this->cityModel->where('state_id',$state->id)->get();
        return response()->json($cities);
    }

    public function getIdCityInIdStateAndCity($idState,$city)
    {
        
        $city = $this->cityModel->where([['state_id','=',$idState],['name','=',$city]])
                        ->get()
                        ->first();

        return $city->id;
        
    }

    public function getDadosLatitudeLongitude($endereco,$bairro,$cidade,$estado,$tipo){
    
        $endereco = str_replace(' ', '+', $endereco);
        $cidade = str_replace(' ', '+', $cidade);
        $bairro = str_replace(' ', '+', $bairro);
        $estado = str_replace(' ', '+', $estado);
        
        $address = $endereco.','.$cidade.','.$estado.',brasil';
        
        //$address=$endereco.'+'.$bairro.','.$cidade.','.$estado.',brasil';

        //$geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false');
        $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
        
        
            $output = json_decode($geocode);

           //echo  $output->status.'<br />';
            
             //echo'<pre>';
              //print_r($output);
             //echo'</pre>';

            
            if($output->status == 'OK'){
                $lat = $output->results[0]->geometry->location->lat;
                $long = $output->results[0]->geometry->location->lng;
                
                $array['lat'] = $lat;
                $array['long'] = $long;

                if($tipo=='php'){
                    return $array;
                }
            }else{
                $array['lat'] = '';
                $array['long'] = '';

                if($tipo=='php'){
                    return $array;
                }
            }
        
    }
}
