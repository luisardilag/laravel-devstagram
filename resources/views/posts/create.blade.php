@extends('layouts.app')

@section('titulo')
    Crea una nueva publicación
@endsection


@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">

            <form action="{{ route('imagenes.store') }}" id="dropzone"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
            </form>

        </div>

        <div class="md:w-1/2 p-10 bg-white rounded-lg shadown-xl mt-10 md:mt-0">

            <form action="{{ route('register') }}" method="POST" novalidate>

                {{-- Cuando aparece el error "419 Page Expired" es porque no se ha enviado el token de seguridad --}}
                @csrf

                {{-- Titulo --}}
                <div class="mb-5">
                    <label for="titulo" class="mb-2 capitalized block text-gray-500 font-bold">
                        Título
                    </label>

                    {{-- El old() es para que se mantenga el valor que se ingreso en el input --}}
                    <input id="titulo" type="text" name="titulo" placeholder="Título de la publicación"
                        class="border p-2 w-full rounded-lg @error('titulo') border-red-500 @enderror"
                        value="{{ old('titulo') }}">

                    @error('titulo')
                        {{-- El mensaje de error se muestra en un div --}}
                        <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Descripción --}}
                <div class="mb-5">
                    <label for="description" class="mb-2 capitalized block text-gray-500 font-bold">
                        Descripción
                    </label>

                    {{-- El old() es para que se mantenga el valor que se ingreso en el input --}}
                    <textarea id="descripcion" name="descripcion" placeholder="Descripción de la publicación"
                        class="border p-2 w-full rounded-lg @error('descripcion') border-red-500 @enderror">
                      {{ old('descripcion') }}
                    </textarea>

                    @error('descripcion')
                        {{-- El mensaje de error se muestra en un div --}}
                        <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>

            </form>

        </div>
    </div>
@endsection
