<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UsuarioRequest;
use RealRashid\SweetAlert\Facades\Alert;

class UsuariosController extends Controller{
    public function index(Request $filtro) {
        $filtragem = $filtro->get('desc_filtro');
        if ($filtragem == null)
            $usuarios = User::orderBy('name')->paginate(10);
        else
            $usuarios = User::where('name', 'like', '%'.$filtragem.'%')
            ->orderBy("name")
            ->paginate(5);

        $teste = auth()->user();
     
        return view('usuarios.index', ['usuarios'=>$usuarios]);
    }

    public function create(){ 
        return view('usuarios.create');
    }

    public function store(UsuarioRequest $request){ 
        $teste = auth()->user();
        dd($teste);
        $senha_criptografada = Hash::make($request->password);
        $request->merge(['password' => $senha_criptografada]);
        User::create($request->all());
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

    public function edit(Request $request){
        $usuario = User::find(\Crypt::decrypt($request->get('id')));
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(UsuarioRequest $request, $id){
        $data = $request->all();
        $compara_db = Auth::user()->all();

        if ($data['password'] != null){
            $data['password'] = bcrypt($data['password']); 
        }
            
        foreach($compara_db as $db){
            if ($data['email'] == $db->email){
                Alert::error('E-mail utilizado', 'Esse e-mail já está sendo utilizado, tente novamente')->persistent('Close');
                return redirect()->back()->withInput();
            }else{
                $update = auth()->user()->update($data);
                if($update == true){
                    return redirect()->route('usuarios')->with('success', "Usuário alterado cadastrado com sucesso")->persistent('Close');
                }else{
                    Alert::error('Erro', 'Falha ao alterar usuário, tente novamente!');
                    return redirect()->back()->withInput();
                }
            }  
        }
        
            
            // $update = User::find($id)->update($request->all());
        


        // $alterada = Hash::make($request->password);
        // $request->merge(['password' => $alterada]);
        // $c = User::find($id)->update($request->all());
        // return redirect()->route('usuarios');
    }
}

