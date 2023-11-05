<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        // Protege todas las rutas de este controlador
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard');
    }
}
