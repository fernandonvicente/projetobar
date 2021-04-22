<?php
namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\All\Cliente;
use App\Models\All\Comanda;
use App\Models\All\ComandaItens;
use Mail;
use Auth;


use App\User;
use Carbon\Carbon;
use App\Funcoes\Funcoes;

use DataTables;

class ClienteLoginController extends Controller
{

  
	
  public function login(Request $request){

    $celular = $request->input('login_telefone');

    $password = $request->input('login_senha');

    $credentials = ['celular' => $celular, 'password' => $password];

    if (Auth::guard('area-cliente')->attempt($credentials)) {
      $data = ['success' => true, 
               'message ' => 'Login realizado com sucesso!'
              ];
    }else{
      $data = ['success' => false, 
               'message ' => 'Os dados do login estão incorretos!'
              ];
    }

    return response()->json($data);

  } 


  public function destroy()
    {
        Auth::guard('area-cliente')->logout();
        return redirect('/cliente');
    }


  public function store(Request $request)
    { 
        //if(Gate::denies('create_consultores')) {
              //abort(404);
        //}
        set_time_limit(0);

        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

        try{
            DB::beginTransaction(); 
            include_once(public_path() . '/assets/funcoes/funcoesGeral.php');                  

            //$documento = (preg_replace('/\D+/', '', $request->input('documento')));

            $clienteInsert = Cliente::create([
                'documento'         => null,
                'nome'              => $request->input('login_nome'),
                'email'             => null,
                'celular'           => $request->input('login_telefone'),
                'password'          => bcrypt($request->input('login_senha')),
            ]);
                        
            if($clienteInsert){

                DB::commit();

                $data = ['success' => true, 
                         'message ' => 'Cadastro realizado com sucesso!',
                         'registro ' => $clienteInsert->id,
                        ];   

            }else{
              DB::rollBack();
              $data = ['success' => false, 
                       'message ' => 'Erro ao realizado cadastro!',
                       'registro ' => 0,
                      ];

            }
        
        } 
        catch(\Exception $e){
            DB::rollBack();
                      $data = ['success' => false, 
                               'message ' => 'Erro no acesso cadastro!'.$e->getMessage(),
                               'registro ' => 0,
                      ];
        }

      return response()->json($data);

    }


    public function comandas(Request $request)
    {

      //echo "login cliente";
      $title = 'Comandas';
      $pagAction = 'Lista';
     
      return view('area-cliente.comandas', compact('title','pagAction')); 

    } 

    public function carregaTabela(Request $request)
    {
      //if(Gate::denies('view_consultores')) {
            //abort(404);
      //}

        set_time_limit(0);

        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');
        
        //if ($request->ajax()) {
        /*
            if(!Auth::user()->cliente_id)
              $query = ViewConsultores::where('status','Ativo')->orderBy('nome', 'asc')->get();  
            else
              $query = ViewConsultores::where('status','Ativo')
                                        ->where('id',Auth::user()->cliente_id)->orderBy('nome', 'asc')->get(); 
      */
            $cliente_id = 4;
            $query = Comanda::where('cliente_id',$cliente_id)->orderBy('created_at', 'DESC')->get();

            $data = DataTables::of($query)
                    ->addIndexColumn()
                    ->editColumn('created_at', function ($data) {

                      $data_cadastro = '';
                      
                      if($data->created_at)
                        $data_cadastro = Carbon::parse($data->created_at)->format('d/m/Y H:i:s');

                      return $data_cadastro;
                    })
                    ->editColumn('updated_at', function ($data) {

                      $data_fechamento = '';
                      
                      if($data->comanda_status == 'F'){
                        if($data->updated_at)
                          $data_fechamento = Carbon::parse($data->updated_at)->format('d/m/Y H:i:s');
                      }
                     
                      return $data_fechamento;
                    })

                    ->editColumn('status', function ($data) {

                      return $data->comanda_status == 'A' ? 'Aberto' : 'Fechado';
                    })

                    ->editColumn('valor', function ($data) {

                     $valor = 'R$ '.number_format($data->valor_total, 2, ',', '.');

                      return $valor;
                    })

                    
                    ->addColumn('action', function($row){

                          //$link = url("/bayareaadmin/comanda/edit").'/'.$row->id;
                         
                          $btn = '';


                           $btn .= '<a href="#" onclick="verComanda('.$row->id.')" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-file-text" title="Visualizar Comanda"></i></a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        //}
      
        return $data;
    }

     
  

}