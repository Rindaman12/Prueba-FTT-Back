<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class CargoController extends Controller
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

        $cargos = Cargo::get();

        return response()
            ->json(['cargos' => $cargos]);
    }

    public function ingresar(Request $request)
    {
        //Se crean las reglas de validacion para la creacion de un usuario en el dashboard

        $validator = Validator::make($request->all(), [
            'cargo' => ['required', 'string', 'min:4', 'max:80'],
        ]);

        //Si el validator falla muestra los errores

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //Se guardan los datos del usuario creado

        $cargo = Cargo::create([
            'cargo' => $request->cargo,
     
        ]);

        return $cargo;
    }

    public function actualizar(Request $request, $id)
    {
        //Modificar usuario en el dashboard

        $validator = Validator::make($request->all(), [
            'cargo' => ['required', 'string', 'min:5', 'max:130', Rule::unique('cargos')->ignore($request->id)],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $cargo = Cargo::find($id)->update($request->all());

        return $cargo;
    }

}
