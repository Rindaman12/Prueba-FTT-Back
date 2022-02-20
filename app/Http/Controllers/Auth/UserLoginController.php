<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserLoginController extends Controller
{

    /**
     * Handle an incoming admin authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Userlogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8|max:16',
        ]);

        if (auth()->guard('web')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {

            return redirect()->intended(url('/usuarios'));
        } else {
            return redirect('/loginUser');
        }
    }

    public function Userlogout()
    {
        Session::flush();
        return redirect('/loginUser');
    }
}
