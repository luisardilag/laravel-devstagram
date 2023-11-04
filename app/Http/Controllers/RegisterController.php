<?php

namespace App\Http\Controllers;

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

        /* Validación */
        $this->validate(
            $request,
            [
                'name' => 'required|min:3|max:20',
                'username' => 'required|min:3|max:20|unique:users',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|min:8'
            ]
        );
    }
}
