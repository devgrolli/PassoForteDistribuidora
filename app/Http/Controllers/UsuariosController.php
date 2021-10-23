<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UsuarioRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UsuariosController extends Controller{
    public function index(Request $filtro) {
        $filtragem = $filtro->get('desc_filtro');
        if ($filtragem == null)
            $usuarios = User::orderBy('name')->paginate(10);
        else
            $usuarios = User::where('name', 'like', '%'.$filtragem.'%')
            ->orderBy("name")
            ->paginate(5);
     
        return view('usuarios.index', ['usuarios'=>$usuarios]);
    }

    public function create(){ 
        return view('usuarios.create');
    }

    public function store(UsuarioRequest $request){
        if($request->permission == '1'){
            $role = 'writer';
        }else{
            $role = 'Super-Admin';
        }

        $senha_criptografada = Hash::make($request->password);
        $request->merge(['password' => $senha_criptografada]);
        $user = User::create($request->all());

        $user->assignRole($role);
        return redirect()->route('usuarios')->with('success', "Usuário novo cadastrado com sucesso!");
    }

    public function destroy($id){
        try {
            User::find($id)->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        }catch(\Illuminate\Database\QueryException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }catch(\PDOException $e){
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret; 
    }

    public function edit($id){
        $usuario = User::find($id);
        return json_encode($usuario);
    }

    public function update(UsuarioRequest $request, $id){
        $data = $request->all();
        if ($data['password'] != null){
            $data['password'] = bcrypt($data['password']); 
        }

        $search_users = DB::table('users')->get();
        foreach($search_users as $user){
            if($user->email == $request->email){
                Alert::error('E-mail já utilizado', 'Utilize um e-mail diferente!');
                return redirect()->back()->withInput();
            }
        }

        $update = Auth::user()->update($data);
        if($update == true){
            return redirect()->route('usuarios')->with('success', "Usuário alterado cadastrado com sucesso");
        }else{
            Alert::error('Erro', 'Falha ao alterar usuário, tente novamente!');
            return redirect()->back()->withInput();
        }
    }
}

