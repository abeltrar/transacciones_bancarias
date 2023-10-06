<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PhpParser\Node\Stmt\Return_;

class UsuariosController extends Controller
{
    public function listadoUsuarios()
    {
        $usuarios = User::all();
        return view('listados.usuarios',compact("usuarios"));
    }

    public function verUsuario(Request $request)
    {
        $idUsuario = $request->input('idusuario');

        $get_user = User::leftJoin('cargos', 'users.id_cargo', '=', 'cargos.id_cargo')
                        ->select('users.*', 'cargos.cargo as nombre_cargo')
                        ->find($idUsuario);

        if ($get_user != null) {
            // Devuelve una respuesta JSON con los datos del usuario
            return response()->json(['user' => $get_user]);
        } else {
            // Devuelve una respuesta JSON indicando que el usuario no existe
            return response()->json(['error' => 'No existe el usuario']);
        }
    }

    public function CrearUsuarioV()
    {
        return view('acciones.CrearUsuario');

    }

    public function store(Request $request)
    {

       
       $User = new User();
       $User->name = $request->input("name");
       $User->email = $request->input("email");
       $User->password = md5($request->input("password"));
       $User->id_cargo = $request->input("id_cargo");
       $User->save();

        

       $usuarios = User::all();
       return view('listados.usuarios',compact('usuarios'));

    }

    public function udpateUsuario(Request $informacion)
    {

       $get_user= User::find($informacion['idusuario']);
        if($get_user != null){

          return view('acciones.UpdateUsuario',compact("get_user"));
            
        }else
        {
            return "No existe el usuario";
        }
       
        
    }

    public function editUsuario(Request $request)
    {

        $usuario = User::findOrFail($request->input('idusuario'));
        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->id_cargo = $request->input('id_cargo');
        
        // Verifica si se proporcionó una nueva contraseña antes de encriptarla
        if ($request->has('password')) {
            $usuario->password = bcrypt($request->input('password'));
        }
        
        $usuario->save();
     
        $usuarios = User::all();
    
        return view('listados.usuarios', compact('usuarios'));
    }

    // Elimina un registro específico
    public function deleteUser(Request $request)
    {

    
        $carrera = User::findOrFail($request['idusuario']);
        $carrera ->delete();
 
        $usuarios = User::all();
        return view('listados.usuarios',compact('usuarios'));
       
        
    }

}


