<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        // Protege todas las rutas de este controlador
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        return view('dashboard', [
            'user' => $user,
        ]);
    }

    /* Permite crear y visualizar el formulario tipo get */
    public function create()
    {
        return view('posts.create');
    }


    /* Es el que guarda en la BD */
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required',
        ]);

        /* EJM1: Como guardar los datos en la BD de Post */
        // Post::create([
        //     'user_id' => auth()->id(),
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        // ]);

        /* EJM2: Como guardar los datos en la BD de Post */
        // $post = new Post();
        // $post->user_id = auth()->id();
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->save();

        /* EJM3: Como guardar los datos en la BD de Post */
        $request->user()->post()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
