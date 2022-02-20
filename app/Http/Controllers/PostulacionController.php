<?php

namespace App\Http\Controllers;

use App\Models\Postulacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostulacionController extends Controller
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

        $postulaciones = Postulacion::get();

        return response()
            ->json(['postulaciones' => $postulaciones]);
    }

}
