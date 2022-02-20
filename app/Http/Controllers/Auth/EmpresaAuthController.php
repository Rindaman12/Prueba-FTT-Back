<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Empresa;
class EmpresaAuthController extends Controller
{



    public function registrar(Request $request)
    {
        // Se crea una empresa


        //Se validan los campos de la DB

        $validator = Validator::make($request->all(), [
            'razon' => ['required', 'string', 'min:5', 'max:30'],
            'rif' => ['required', 'string', 'min:10', 'unique:empresas'],
            'tlf' => ['required', 'string', 'min:11', 'unique:empresas'],
            'email' => ['required', 'string', 'min:5', 'max:100', 'unique:empresas'],
            'password' => ['required', 'string', 'min:8', 'max:16'],
            ]);

        //Si hay un error lo muestra en formato json

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Se guardan los datos en la DB

        $empresa = Empresa::create([

            'razon' => $request->razon,
            'rif' => $request->rif,
            'tlf' => $request->tlf,
            'email' => $request->email,
            'password' => bcrypt($request->password),

        ]);

        return  $empresa;
    }
     /**
     * Handle an incoming admin authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Empresalogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8|max:16',
        ]);

        if(auth()->guard('empresas')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {

            return redirect()->intended(url('/empresas/inicio'));
        } else {
            return redirect('/loginEmp');
        }
    }


    public function Empresalogout()
    {
        Session::flush();
        return redirect('/loginEmp');
    }
}
