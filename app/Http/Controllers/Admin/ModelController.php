<?php

namespace App\Http\Controllers\Admin;


use Auth;
use Validator;
use Collection;
use Session;
use Cookie;
use DB;
use App\User;
use App\Models\All\State;
use App\Models\All\TextModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModelController extends Controller
{

    public $ativo = [
      'A' => 'Ativo',
      'I' => 'Inativo',
    ];

    private $stateModel;
   
    public function __construct(State $state){

        $this->stateModel = $state;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listModels = TextModel::orderBy('name', 'asc')->get();

        $data = Array();
        $dados = Array();
        if(count($listModels)>0){
            foreach ($listModels as $k => $model) {
                $dados[$k]['id'] = $model->id;
                $dados[$k]['name'] = $model->name;
                $dados[$k]['status'] = $model->status == 'A' ? 'Ativo' : 'Inativo';
            }
        }
        $arrayModels = json_decode(json_encode($dados), FALSE);//convertendo array em objeto

        $data = [
               'arrayModels' => $arrayModels,
        ];


        $title = 'Relatório de Textos Modelos';
        $pagAction = 'Relatório';

        return view('admin.model.index', $data, compact('title','pagAction')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $data = [
               'model_id' => 0,
               'model_name' => '',
               'model_description' => '',
               'lista_ativo' => $this->ativo,
               'model_ativo_checked' => 'A',
        ]; 

        $title = 'Cadastro de Texto Modelo';
        $pagAction = 'Cadastrar';

        return view('admin.model.create-edit', $data, compact('title','pagAction')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

        try{
            DB::beginTransaction(); 
            //'client_id' => Auth::user()->id,   
            $insert = TextModel::create([
                       'client_id' => 1,
                       'name' => $request->input('model_name'),
                       'text' => $request->input('model_description'),                       
                       'status' => $request->input('status'),
            ]);

            if($insert){     
                    DB::commit();

                    return response()->json([
                        'success'   => true,
                        'result' => $insert,
                    ], 200);
                
            }else{
                DB::rollBack();
                return response()->json([
                        'success'   => false,
                        'result' => $e->getMessage(),
                    ]);
            }
        } 
        catch(\Exception $e){
            DB::rollBack();
             return response()->json([
                        'success'   => false,
                        'result' => $e->getMessage(),
                    ]);
        }
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
       //pegando o objeto do forum--------------------------------------------------------------------

        $getModel = TextModel::find($id);

        $data = [
               'model_id' => $getModel->id,
               'model_name' => $getModel->name,
               'model_description' => $getModel->text,
               'lista_ativo' => $this->ativo,
               'model_ativo_checked' => $getModel->status, 
        ]; 

        $title = 'Editar de Texto Modelo';
        $pagAction = 'Editar';

        return view('admin.model.create-edit', $data, compact('title','pagAction')); 
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
        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

        try{
            DB::beginTransaction(); 

            $model = TextModel::find($id);
            $update = $model->update([
                       'client_id' => 1,
                       'name' => $request->input('model_name'),
                       'text' => $request->input('model_description'),  
                       'status' => $request->input('status'),
            ]);

            if($update){                
                DB::commit();

                    return response()->json([
                        'success'   => true,
                        'result' => $update,
                    ], 200);

            }
        } 
        catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                        'success'   => false,
                        'result' => $e->getMessage(),
                    ]);
        }
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
}
