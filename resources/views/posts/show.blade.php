@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection


@section('contenido')
    <div class="container mx-auto flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">

            <div class="p-3">
                <p>0 Likes</p>
            </div>

            <div>
                <p class="font-bold">{{ $post->user->username }}</p>

                {{-- diffForHumans() es un método de Carbon que nos devuelve el tiempo transcurrido desde la fecha que le pasamos como parámetro, Carbon es una librería integrada en laravel --}}
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5">
                    {{ $post->descripcion }}
                </p>
            </div>
        </div>
        <div class="md:w-1/2 p-5">

            <div class="shadown bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>

                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white uppercase font-bold">
                            {{ session('mensaje') }}
                        </div>
                    @endif

                    <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                        @csrf

                        {{-- Comentario --}}
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 capitalized block text-gray-500 font-bold">
                                Añade un comentario
                            </label>

                            <textarea id="comentario" name="comentario" placeholder="Escribe el texto"
                                class="border p-2 w-full rounded-lg @error('comentario') border-red-500 @enderror">
                            </textarea>

                            @error('comentario')
                                {{-- El mensaje de error se muestra en un div --}}
                                <div class="text-red-500 text-xs">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <div>
                            <input type="submit" value="Añade comentario"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                        </div>
                    </form>
                @endauth

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="" class="font-bold">
                                    {{ $comentario->user->username }}
                                </a>
                                <p>{{ $comentario->comentario }}</p>
                                <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentarios</p>
                    @endif
                </div>

            </div>

        </div>
    </div>
@endsection
