<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Validator;
use DB;
use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\All\RoleUser;
use App\Models\All\Role;
use App\Models\All\Permission;
use App\Models\All\PermissionRole;
use App\Models\View\ViewUser;
use App\Models\All\Consultor;

class UserController extends Controller
{
    
    public $status = [
      'A' => 'Ativo',
      'I' => 'Inativo',
    ];

    private $userModel;
    private $roleUserModel;
    private $roleModel;
    private $permissionModel;
    private $permissionRoleModel;
    private $viewUserModel;


    private $qtRecordPage = 10;

    public function __construct(User $user, RoleUser $roleUser, ViewUser $viewUser, Role $role, Permission $permission, PermissionRole $permissionRole){
        $this->userModel = $user;
        $this->roleUserModel = $roleUser;
        $this->roleModel = $role;
        $this->permissionModel = $permission;
        $this->permissionRoleModel = $permissionRole;
        $this->viewUserModel = $viewUser;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Usuários';
        $pagAction = 'Lista';


        if(Gate::denies('view_usuarios')) {
            //abort(404);
        }

        include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

        $users = $this->viewUserModel->where('status', '!=', 'E')
                                     ->orderBy('name', 'asc')
                                     ->get();

        $pos = 1;
        foreach ($users as $key => $userAux) {

            $users[$key]['id'] = $userAux->id;
            $users[$key]['name'] = $userAux->name;
            $users[$key]['email'] = $userAux->email;
            $users[$key]['file'] = $userAux->file;
            $users[$key]['avatar'] = $userAux->avatar;
            $users[$key]['status'] = $userAux->status == 'A' ? 'Ativo' : 'Inativo';
            $users[$key]['role_id'] = $userAux->role_id;
            $users[$key]['role_name'] = $userAux->role_name;          

            $pos++;
        }

        //echo "<pre>";
        //print_r($users);
            
        $users = json_decode(json_encode($users), FALSE);//convertendo array em objeto

        return view('admin.user.indexajax', compact('title','pagAction','users')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(Gate::denies('create_usuarios')) {
           // abort(404);
        }

        //tipo de usuários-------------------------------------------------------------------------
        //$roles = $this->roleModel->where('id','>',1)->orderBy('name', 'asc')->get();
        $roles = $this->roleModel->orderBy('name', 'asc')->get();

        $arrayRoles = Array();
        foreach ($roles as $key => $value) {
            $arrayRoles[$value->id] = $value->label;
        }

        $listRoles = json_decode(json_encode($arrayRoles), FALSE);//convertendo array em objeto
        //-----------------------------------------------------------------------------------------

        $data = [
               'name' => '',
               'email' => '',
               'file' => '',
               'avatar' => '',
               'numberPage' => '',
               'totalImage' => null,
               'id' => '',
               'statuses' => $this->status,
               'checkedStatus' => 'A',
               'required_password' => 'required',
               'listRoles' => $listRoles,
               'selectdRole' => null,
               'formAction' => 'create',
        ]; 

        $title = 'Cadastro de Usuário';
        $pagAction = 'Cadastrar';

        return view('admin.user.create-edit', $data, compact('title','pagAction')); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        if(Gate::denies('create_usuarios')) {
            //abort(404);
        }

        try{
            DB::beginTransaction(); 
            include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

            $fileName = $request->input('nomeImagem') == '' ? null : $request->input('nomeImagem');
                  
            $insert = $this->userModel->create([
                       'name' => $request->input('name'),
                       'email' => $request->input('email'),
                       'status' => 'A',
                       'avatar' => $fileName,
                       'password' => bcrypt($request->input('password')),
            ]);

            if($insert){     

                $insertRoleUser = $this->roleUserModel->create([
                           'role_id' => $request->input('role'),
                           'user_id' => $insert->id,
                ]);

                if($insert && $insertRoleUser){
                    DB::commit();

                    if($request->input('nomeImagem')!='' && $request->input('stautsImagem')=='up'){
                        include_once(public_path() . '/assets/funcoes/uploadGerenciamento.php');

                        //movendo imagem img_full--------------------------------------------------
                        $caminhoOrigem = public_path().'/assets/uploadTemp/img_full';
                        $caminhoDestino = public_path().'/assets/upload/user/img_full';
                        moveImg($caminhoOrigem,$caminhoDestino,$fileName);

                        //movendo imagem img_large--------------------------------------------------
                        $caminhoOrigem = public_path().'/assets/uploadTemp/img_large';
                        $caminhoDestino = public_path().'/assets/upload/user/img_large';
                        moveImg($caminhoOrigem,$caminhoDestino,$fileName);

                        //movendo imagem img_medium--------------------------------------------------
                        $caminhoOrigem = public_path().'/assets/uploadTemp/img_medium';
                        $caminhoDestino = public_path().'/assets/upload/user/img_medium';
                        moveImg($caminhoOrigem,$caminhoDestino,$fileName);
                    }

                    return redirect('bayareaadmin/user/index')
                                     ->with('message', 'Inclusão realizada com sucesso!')
                                     ->withInput();
                }else{
                    DB::rollBack();
                    return redirect('bayareaadmin/user/index')
                    ->with('message', 'Erro na inclusão - insert e insertRoleUser! '.$e->getMessage())
                    ->withInput();
                }
            }else{
                DB::rollBack();
                return redirect('bayareaadmin/user/index')
                ->with('message', 'Erro na inclusão - insert! '.$e->getMessage())
                ->withInput();
            }
        } 
        catch(\Exception $e){
            DB::rollBack();
            return redirect('bayareaadmin/user/create')
             ->with('message', 'Erro na inclusão! '.$e->getMessage())
             ->withInput();
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
        if(Gate::denies('edit_usuarios')) {
            //abort(404);
        }

        if(Auth::user()->consultor_id)
            $user = $this->userModel->find(Auth::user()->id);
        else
            $user = $this->userModel->find($id);

        $totalImage = $user->avatar !='' ? 1 : 0;//validando se tem image cadastrada

        //tipo de usuários-------------------------------------------------------------------------
        //$roles = $this->roleModel->where('id','>',1)->orderBy('name', 'asc')->get();
        $roles = $this->roleModel->orderBy('name', 'asc')->get();

        $arrayRoles = Array();
        foreach ($roles as $key => $value) {
            $arrayRoles[$value->id] = $value->label;
        }

        $listRoles = json_decode(json_encode($arrayRoles), FALSE);//convertendo array em objeto
        //-----------------------------------------------------------------------------------------

        $objRole = json_decode($user->roles);

        $data = [
               'name' => $user->name,
               'email' => $user->email,
               'avatar' => $user->avatar,
               'numberPage' => '',
               'totalImage' => $totalImage,
               'id' => $user->id,
               'statuses' => $this->status,
               'checkedStatus' => $user->status,
               'required_password' => '',
               'listRoles' => $listRoles,
               'selectdRole' => $objRole[0]->id,
               'formAction' => 'edit',
        ]; 

        $title = 'Cadastro de Usuário';
        $pagAction = 'Editar';

        return view('admin.user.create-edit', $data, compact('title','pagAction','user')); 
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
        if(Gate::denies('edit_usuarios')) {
            //abort(404);
        }
        
        try{
            DB::beginTransaction(); 
            include_once(public_path() . '/assets/funcoes/funcoesGeral.php');

            $fileName = $request->input('nomeImagem') == '' ? null : $request->input('nomeImagem');

            $user = $this->userModel->find($id);
                  
            $update = $user->update([
                       'name' => $request->input('name'),
                       'email' => $request->input('email'),
                       'status' => 'A',
            ]); 

            if($update){    

                $objUserRole = $this->roleUserModel->where('user_id',$user->id)->get()->first(); 

                $objRoleUserModel = $this->roleUserModel->find($objUserRole->id);

                $updateRoleUser = $objRoleUserModel->update([
                           'role_id' => $request->input('role'),
                           'user_id' => $user->id,
                ]);
                if($updateRoleUser)
                    DB::commit();

                if($request->input('password')){
                    $updatePassword = $user->update([ 
                       'password' => bcrypt($request->input('password')),
                    ]);
                }

                if($update){
                    DB::commit();

                    if($request->input('nomeImagem')!='' && $request->input('stautsImagem')=='up'){
                        include_once(public_path() . '/assets/funcoes/uploadGerenciamento.php');

                        //movendo imagem img_full--------------------------------------------------
                        $caminhoOrigem = public_path().'/assets/uploadTemp/img_full';
                        $caminhoDestino = public_path().'/assets/upload/user/img_full';
                        moveImg($caminhoOrigem,$caminhoDestino,$fileName);

                        //movendo imagem img_large--------------------------------------------------
                        $caminhoOrigem = public_path().'/assets/uploadTemp/img_large';
                        $caminhoDestino = public_path().'/assets/upload/user/img_large';
                        moveImg($caminhoOrigem,$caminhoDestino,$fileName);

                        //movendo imagem img_medium--------------------------------------------------
                        $caminhoOrigem = public_path().'/assets/uploadTemp/img_medium';
                        $caminhoDestino = public_path().'/assets/upload/user/img_medium';
                        moveImg($caminhoOrigem,$caminhoDestino,$fileName);
                    }

                    return redirect('bayareaadmin/user/edit/'.$user->id)
                                     ->with('message', 'Alteração realizada com sucesso!')
                                     ->withInput();

                }else{
                    DB::rollBack();
                    return redirect()->route('admin::user.edit', $user->id)
                    ->with('message', 'Erro na alteração - update! '.$e->getMessage())
                    ->withInput();
                }
            }else{
                DB::rollBack();
                return redirect('bayareaadmin/user/index')
                ->with('message', 'Erro na alteração - update! '.$e->getMessage())
                ->withInput();
            }
        } 
        catch(\Exception $e){
            DB::rollBack();
             return redirect('bayareaadmin/user/edit/role/'.$user->id)
             ->with('message', 'Erro na alteração - update! '.$e->getMessage())
             ->withInput();
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
        if(Gate::denies('delete_usuarios')) {
            //abort(404);
        }

        try{
            $user = $this->userModel->find($id);

            $emailDelete = "delete_".$user->email;

            if($user->avatar){
                include_once(public_path() . '/assets/funcoes/funcoesGeral.php');
                deletaImagemUser($user->avatar);
            }

            $update = $user->update([
                   'avatar' => null,
                   'status' => 'E',
                   'email' => $emailDelete,
            ]);

            if($update)
                return 'Registro excluido com sucesso!';

        } 
        catch(\Exception $e){
             return 'Erro na exclusão! '.$e->getMessage();
        }
    }

    public function updateAvatar($id)
    {

        $user = $this->userModel->find($id);

        if($user->avatar){
            include_once(public_path() . '/assets/funcoes/funcoesGeral.php');
            deletaImagemUser($user->avatar);
        }
  
        $update = $user->update([
                   'avatar' => null,
        ]);

        if($update)
            return 'ok';
        else
            return 'erro';
   
    }


    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permission($selectdRole = null)
    {
        if(Gate::denies('edit_permissao_usuarios')) {
           // abort(404);
        }
    
        //tipo de usuários-------------------------------------------------------------------------
        $roles = $this->roleModel->where('id','>',1)->orderBy('name', 'asc')->get();

        $arrayRoles = Array();
        foreach ($roles as $key => $value) {
            $arrayRoles[$value->id] = $value->label;
        }

        $listRoles = json_decode(json_encode($arrayRoles), FALSE);//convertendo array em objeto

        //pegar as permissões------------------------------------------------------------------------

        $groupPermission = DB::table('permissions')
                 ->select('session', DB::raw('count(*) as total'))
                 ->groupBy('session')
                 ->orderBy('session')
                 ->get();
  
        $tr = '';
        foreach ($groupPermission as $key => $value) {
            //echo ">>".$value->session.'|';
            $tr .= '<tr>';

            $tr .= '<td>'.$value->session.'</td>';

             $listPermission = $this->permissionModel->where('session',$value->session)->get();

             foreach ($listPermission as $k => $v) {
                 //echo $v->id.'|'.$v->name.' ** ';

                 //verifico se pra role tem permissão--------------------------------------------------
                 $qtCkeckbox = $this->permissionRoleModel->where('permission_id',$v->id)
                                           ->where('role_id',$selectdRole)
                                           ->get()->count(); 

                 $checkbox = $qtCkeckbox == 1 ? 'checked': '';


                $tr .= '<td>
                            
                              <label>
                                <input type="checkbox" class="checkbox" value="'.$v->id.'" name="input_permissions[]" '.$checkbox.'>
                              </label>
                            
                        </td>';
             }
            $tr .= '</tr>'; 
         } 


        $title = 'Perfil de Usuário';
        $pagAction = 'Permissões';


        return view('admin.user.permission', compact('title','pagAction','listRoles','tr','selectdRole')); 
    }

    public function createProfilePermission(Request $request)
    {
        if(Gate::denies('edit_permissao_usuarios')) {
           // abort(404);
        }

        try{  

            $role_id = $request->input('role');

            if($request->input('role') && count($request->input('input_permissions')) > 0 ){
              $permissionRoles = $this->permissionRoleModel->where('role_id', $role_id)->get();
              foreach ($permissionRoles as $key => $permissionRole) {
                $permissionRole->delete();
              }  
              DB::commit();            
            }   

 
            //Inicia o Database Transaction, na gravação do cliente no bd
            DB::beginTransaction();

            foreach ($request->input('input_permissions') as $key => $permission) {
              
                $insert = $this->permissionRoleModel->create([
                 'permission_id' => $permission,
                 'role_id' => $role_id,
                ]);
                DB::commit();
            }

            return redirect('bayareaadmin/user/permission/role/'.$role_id)->with('message', 'Inclusão realizada com sucesso!');

          } 
          catch(\Exception $e){

            DB::rollBack();
             
            return redirect('bayareaadmin/user/permission/role/'.$role_id)->with('message', 'Erro na inclusão! '.$e->getMessage());
          }
    }

}
