<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Personal;
use App\Models\Postulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:empresas');
    }

    public function index()
    {

        if (Auth::check()) {
            return view('empresa');
        } else {
            Session::flush();
            return redirect()->route('login');
        }
    }

    public function listaCargos()
    {
        //Muestra todos los usuarios en el dashboard

        $cargos = Cargo::get();

        return response()
            ->json(['cargos' => $cargos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ingresarPostulacion(Request $request)
    {
        //Se crean las reglas de validacion para la creacion de un usuario en el dashboard

        $validator = Validator::make($request->all(), [
            'cargo_id' => ['required'],
            'anos' => ['required', 'integer', 'min:1', 'max:25'],
        ]);

        //Si el validator falla muestra los errores

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //Se guardan los datos del usuario creado


        $postulacion = Postulacion::create([
            'empresa_id' => Auth::id(),
            'cargo_id' => $request->cargo_id,
            'anos' => $request->anos,
        ]);

        return $postulacion;

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function buscarPersonal(Request $request)
    {
     

        $personals = Personal::get();

        return response()
            ->json(['personals' => $personals]);

}}

