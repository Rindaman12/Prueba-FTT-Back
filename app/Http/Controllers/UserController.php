<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:web');
    }
    
    public function index()
    {

        if (Auth::check()) {
            return view('usuario');
        } else {
            Session::flush();
            return redirect('/loginUser');
        }
    }

    public function lista()
    {
 //Muestra todos los usuarios en el dashboard

 $users = User::get();

 return response()
     ->json(['users' => $users]);
    }


    public function listaEmpresas()
    {
 //Muestra todos los usuarios en el dashboard

 $empresas = Empresa::get();

 return response()
     ->json(['empresas' => $empresas]);
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ingresar(Request $request)
    {
        //Se crean las reglas de validacion para la creacion de un usuario en el dashboard

        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'min:4', 'max:80'],
            'password' => ['required', 'string', 'min:8', 'max:16'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
        ]);

        //Si el validator falla muestra los errores

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //Se guardan los datos del usuario creado

        $user = User::create([
            'nombre' => $request->nombre,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'email_verified_at' => $request->email_verified_at = now(),
        ]);

 
        return $user;
    }

    public function actualizar(Request $request, $id)
    {
        //Modificar usuario en el dashboard

        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'min:4', 'max:80'],
            'email' => ['required', 'string', 'email', 'max:50', Rule::unique('users')->ignore($request->id)],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::find($id)->update($request->all());

        return $user;
    }


}
