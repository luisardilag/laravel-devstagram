<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        /* Accede al archivo que sube por el request */
        $imagen = $request->file('file');

        /* Coloca un nombre unico al archivo */
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        /* Método que permite crear una imagen en Intervention */
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1024, 1024);

        /* Guarda la imagen en el servidor, crea la carpeta uploads */
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;

        /* Guarda la imagen en el servidor */
        $imagenServidor->save($imagenPath);


        return response()->json(['imagen' => $nombreImagen]);
    }
}
