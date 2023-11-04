@extends('layouts.app')

@section('titulo')
    Registrate en DevStagram
@endsection


@section('contenido')
    <div class="md:flex md:gap-4 md:items-center">
        <div class="md:w-6/12 p-5">

            {{-- asset() apunta directamente a la carpeta public --}}
            <img src="{{ asset('img/registrar.jpg') }}" alt="imagen registro de usuario">
        </div>

        <div class="md:w-4/12 md:justify-center bg-white p-6 rounded-lg shadow-xl">

            {{-- El action llama a la url que tiene registrado el metodo store del controlador RegisterController --}}
            {{-- El atributo "novalidate" es para que no se valide el formulario con html5 --}}
            <form action="{{ route('register') }}" method="POST" novalidate>

                {{-- Cuando aparece el error "419 Page Expired" es porque no se ha enviado el token de seguridad --}}
                @csrf

                {{-- Name --}}
                <div class="mb-5">
                    <label for="name" class="mb-2 capitalized block text-gray-500 font-bold">
                        Nombre
                    </label>

                    {{-- El old() es para que se mantenga el valor que se ingreso en el input --}}
                    <input id="name" type="text" name="name" placeholder="Ingresa tu nombre"
                        class="border p-2 w-full rounded-lg @error('name') border-red-500 @enderror"
                        value="{{ old('name') }}">

                    @error('name')
                        {{-- El mensaje de error se muestra en un div --}}
                        <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>


                {{-- Username --}}
                <div class="mb-5">
                    <label for="username" class="mb-2 capitalized block text-gray-500 font-bold">
                        Username
                    </label>
                    <input id="username" type="text" name="username" placeholder="Tu nombre de usuario"
                        class="border p-2 w-full rounded-lg">

                    @error('username')
                        {{-- El mensaje de error se muestra en un div --}}
                        <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>


                {{-- Email --}}
                <div class="mb-5">
                    <label for="email" class="mb-2 capitalized block text-gray-500 font-bold">
                        Email
                    </label>
                    <input id="email" type="email" name="email" placeholder="Tu email"
                        class="border p-2 w-full rounded-lg">

                    @error('email')
                        {{-- El mensaje de error se muestra en un div --}}
                        <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>


                {{-- Password --}}
                <div class="mb-5">
                    <label for="password" class="mb-2 capitalized block text-gray-500 font-bold">
                        Password
                    </label>
                    <input id="password" type="password" name="password" placeholder="Tu password"
                        class="border p-2 w-full rounded-lg">

                    @error('password')
                        {{-- El mensaje de error se muestra en un div --}}
                        <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>


                {{-- Confirmacion Password --}}
                {{-- "password_confirmation" es necesario para laravel por convención escrito de esa forma --}}
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 capitalized block text-gray-500 font-bold">
                        Repetir Password
                    </label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        placeholder="Repite tu password" class="border p-2 w-full rounded-lg">
                </div>


                {{-- Submit --}}
                <input type="submit" value="Crear Cuenta"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">

            </form>
        </div>
    </div>
@endsection
