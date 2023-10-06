<?php

namespace App\Http\Controllers;
use App\Models\cuenta;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Mail\correoMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;



use App\Http\Requests;

class transaccionesController extends Controller
{

    public function __construct(Guard $auth)
    {
        $this->middleware('auth');
    }

    public function moduloTransacciones()
    {
        return view('transacciones.transacciones');
    }


    public function recargarCuenta(Request $request)
    {

        if ($request->isMethod('post')){


            $documento = $request->input('documento');
            $celular = $request->input('celular');
            $valor = $request->input('valor');

             // Realiza la validación en la base de datos
            $cuenta = cuenta::where('cedula', $documento)
            ->where('celular', $celular)
            ->first();

            if ($cuenta) {
                // Actualiza el saldo de la cuenta
                $cuenta->saldo += $valor;
                $cuenta->save();
                $saldoFormateado = number_format($cuenta->saldo, 0, ',', '.');

            
                return response()->json(['status' => '1','message' => 'Recarga exitosa', 'saldo' => $saldoFormateado]);
            } else {
                return response()->json(['status' => '0','message' => 'No se encontró una cuenta con los datos proporcionados.']);
            }
        }

    
    }

    public function verCuenta(Request $request)
    {

        $documento = $request->input('documento');
        $celular = $request->input('celular');

         // Realiza la validación en la base de datos
         $cuenta = cuenta::where('cedula', $documento)
         ->where('celular', $celular)
         ->first();

         if ($cuenta) {

            $saldoFormateado = number_format($cuenta->saldo, 0, ',', '.');
            return response()->json(['status' => '1','saldo' => $saldoFormateado]);

         }else {
            return response()->json(['status' => '0','message' => 'No se encontró una cuenta con los datos proporcionados.']);
        }


    }

    public function pagarCuenta()
    {
        // Obtener el ID del usuario autenticado
        $userId = auth()->id();

        $idUsuario = $userId;

        $user = Cuenta::where('id_usuario', $idUsuario)->first();
        
        // Verificar si se encontró el usuario
        if ($user) {

            // Genera un token numérico
            $token = mt_rand(100000, 999999);
            
            $correoUsuario = $user->email;

            $correo = new correoMailable($token);
            Mail::to( $correoUsuario)->send($correo);

            // Encripta el token antes de guardarlo en la base de datos
            $tokenEncriptado = Crypt::encryptString($token);

            // Guarda el token en la base de datos
            $user->token = $tokenEncriptado;
            $user->save();
            
            return response()->json(['status' => '1','message' => 'Hemos enviado un token a tu correo por favor digitalo a continuación.']);
        } else {
            // El usuario no se encontró, maneja el caso de error
            return response()->json(['status' => '0','message' => 'Usuario no encontrado']);
        }
    }


    public function enviartoken(Request $request)
    {

        $userId = auth()->id();

        $idUsuario = $userId;

        $tokenIngresado = $request->input('token');
        
        $user = Cuenta::where('id_usuario', $idUsuario)->first();

        if ($user) {
            $token = $user->token;

            

            $tokenDesencriptado = Crypt::decryptString($token);

            // Verifica si el token desencriptado coincide con el token original
            if ($tokenDesencriptado == $tokenIngresado) {
                return response()->json(['status' => '1','message' => 'Token válido']);
            } else {
                return response()->json(['status' => '0','message' => 'Token inválido']);
            }

            try {
                // Intenta desencriptar el token
                
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                return response()->json(['status' => '0','message' => 'No se pudo desencriptar el token']);
            }
        }


    }


    public function enviarpago(Request $request){
        $saldo_compra = $request->input('saldo');

         // Obtener el ID del usuario autenticado
         $userId = auth()->id();

         $idUsuario = $userId;
 
         $user = Cuenta::where('id_usuario', $idUsuario)->first();

        if($user){
            $saldo_actual = $user->saldo;
            if( $saldo_actual >= $saldo_compra){
                $user->saldo -= $saldo_compra;
                $user->save();
                $saldoFormateado = number_format($user->saldo, 0, ',', '.');
                return response()->json(['status' => '1','message' => 'Compra exitosa', 'saldo' => $saldoFormateado]);
            }else{
                return response()->json(['status' => '0','message' => 'Saldo insuficiente para realizar la compra.']); 
            }

        
        }else{
            return response()->json(['status' => '0','message' => 'Error al realizar la compra']); 
        }

         
    }



}
