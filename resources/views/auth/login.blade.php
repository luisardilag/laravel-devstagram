@extends('layouts.app')

@section('titulo')
    Inicia sesión en DevStagram
@endsection


@section('contenido')
    <div class="md:flex md:gap-4 md:items-center">
        <div class="md:w-6/12 p-5">

            {{-- asset() apunta directamente a la carpeta public --}}
            <img src="{{ asset('img/registrar.jpg') }}" alt="imagen inicio de sesión">
        </div>

        <div class="md:w-4/12 md:justify-center bg-white p-6 rounded-lg shadow-xl">

            {{-- El action llama a la url que tiene registrado el metodo store del controlador RegisterController --}}
            {{-- El atributo "novalidate" es para que no se valide el formulario con html5 --}}
            <form method="POST" action="{{ route('login') }}" novalidate>

                {{-- Cuando aparece el error "419 Page Expired" es porque no se ha enviado el token de seguridad --}}
                @csrf

                @if (session('status'))
                    {{-- El status de error se muestra en un div --}}
                    <div class="text-red-500 text-xs">{{ session('status') }}</div>
                @endif

                {{-- Email --}}
                <div class="mb-5">
                    <label for="email" class="mb-2 capitalized block text-gray-500 font-bold">
                        Email
                    </label>
                    <input id="email" type="email" name="email" placeholder="Tu email"
                        class="border p-2 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}">

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
                        class="border p-2 w-full rounded-lg @error('password') border-red-500 @enderror"
                        value="{{ old('password') }}">

                    @error('password')
                        {{-- El mensaje de error se muestra en un div --}}
                        <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Remember --}}
                <div class="mb-5">
                    <label for="remember" class="mb-2 capitalized block text-gray-500 font-bold">
                        <input id="remember" type="checkbox" name="remember" class="mr-1"
                            {{ old('remember') ? 'checked' : '' }}>
                        Recuérdame
                    </label>
                </div>

                {{-- Submit --}}
                <div>
                    <input type="submit" value="Iniciar Sesión"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                </div>

            </form>
        </div>
    </div>
@endsection
