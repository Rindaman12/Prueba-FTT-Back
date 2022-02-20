<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
class PersonalController extends Controller
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
    
     $personals = Personal::get();
    
     return response()
         ->json(['personals' => $personals]);
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
                'email' => ['required', 'string', 'email', 'max:50', 'unique:personal'],
                'tlf' => ['required', 'string', 'min:11', 'max:15','unique:personal'],
                'descripcion' => ['required', 'string', 'max:500'],
                'cargo_id' => ['required'],
                'anos' => ['required', 'integer', 'min:1', 'max:25'],
            ]);
    
            //Si el validator falla muestra los errores
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
    
            //Se guardan los datos del usuario creado
    
            $personal = Personal::create([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'tlf' => $request->tlf,
                'descripcion' => $request->descripcion,
                'cargo_id' => $request->cargo_id,
                'anos' => $request->anos,
            ]);
    
     
            return $personal;
        }
    
        public function actualizar(Request $request, $id)
        {
            //Modificar usuario en el dashboard
    
            $validator = Validator::make($request->all(), [
              
                'email' => ['required', 'string', 'email', 'max:50', Rule::unique('personal')->ignore($request->id)],
                'tlf' => ['required', 'string', 'min:11', 'max:15', Rule::unique('personal')->ignore($request->id)],
                'descripcion' => ['required', 'string', 'max:500'],
            
                ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
    
            $personal = Personal::find($id)->update($request->all());
    
            return $personal;
        }
    
    
    }
    
