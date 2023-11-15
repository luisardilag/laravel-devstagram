<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function __construct()
    {
        // Protege todas las rutas de este controlador
        $this->middleware('auth');
    }

    public function index(User $user)
    {

        $posts = Post::where('user_id', $user->id)->paginate(5);


        return view('dashboard', [
            'user' => $user,
            'posts' => $posts,
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
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    /* Muestra el detalle del Post */
    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user,
        ]);
    }


    /* Elimina el Post */
    public function destroy(Post $post)
    {
        /* Corrobora que está autorizado */
        $this->authorize('delete', $post);

        /* Elimina el post */
        $post->delete();

        /* Url de la imagen */
        $imagen_path = public_path('storage/' . $post->imagen);

        /* ELimina la imagen del post */
        if (File::exists($imagen_path)) {
            unlink($imagen_path);
        }


        return redirect()->route('posts.index', auth()->user()->username);
    }
}
