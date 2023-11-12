<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }


    /*
        Para acceder a los datos del formulario, automaticamente se le pasa
        el objeto Request, el cual contiene los datos del mismo.
    */
    public function store(Request $request)
    {
        // dd($request->all());

        // Accedo a los valores por el name="email" del input
        // dd($request->get('email'));


        /* Modifica el request */
        $request->request->add(['username' => Str::slug($request->username)]);

        /* Validación */
        $this->validate(
            $request,
            [
                'name' => 'required|min:3|max:20',
                'username' => 'required|unique:users|min:3|max:20',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|min:6|confirmed'
            ]
        );

        /* Creo el usuario en la BD */
        User::create(
            [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                // Encripto la contraseña
                'password' => bcrypt($request->password)
            ]
        );

        /* Autentica un usuario */
        auth()->attempt($request->only('email', 'password'));

        // Redirecciono a la ruta home
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
