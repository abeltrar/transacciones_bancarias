<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrera;

class CarrerasController extends Controller
{

    public function listarcarrera()
    {

        $carreras = Carrera::all();
        return view('listados.carreras',compact("carreras"));
    }


    public function crearCarrera()
    {
        return view('acciones.CreaCarrera');
    }

  
    public function AddCarrera(Request $request)
    {
       $carrera = new carrera();
       $carrera->nombre_carrera = $request->input("nombre_carrera");
       $carrera->descripcion = $request->input("descripcion");
       $carrera->tiempo = $request->input("tiempo");
       $carrera->save();

       $carreras = carrera::all();
       return view('listados.carreras',compact('carreras'));
   

    }

    public function UpdateCarrera(Request $informacion)
    {

        
       $get_carrera= carrera::find($informacion['id_carrera']);
        if($get_carrera != null){

          return view('acciones.UpdateCarrera',compact("get_carrera"));
            
        }else
        {
            return "No existe el usuario";
        }
       
        
    }

    public function editCarrera(Request $request)
    {

       
        $carrera = carrera::findOrFail($request['id_carrera']);
        $carrera->nombre_carrera = $request->input("nombre_carrera");
        $carrera->descripcion = $request->input("descripcion");
        $carrera->tiempo = $request->input("tiempo");
        $carrera->save();
 
        $carreras = carrera::all();
        return view('listados.carreras',compact('carreras'));
       
        
    }

    public function delete(Request $request)
    {

    
        $carrera = carrera::findOrFail($request['id_carrera']);
        $carrera ->delete();
 
        $carreras = carrera::all();
        return view('listados.carreras',compact('carreras'));
       
        
    }



    
}
