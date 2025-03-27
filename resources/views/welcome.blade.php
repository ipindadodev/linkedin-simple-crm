<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ?? 'LinkedIn Simple CRM' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
    </head>

<flux:main>
    <body class="bg-gradient-to-r from-[#0f172a]  to-[#334155] dark:bg-gradient-to-bl dark:from-[#0f172a] dark:via-[#1e1a78] dark:to-[#0f172a] text-[#fefefe] dark:text-[#fefefe] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <!-- Desde aquí lienzo en blanco -->
    <section class="">
        <h1 class="text-4xl font-bold tracking-tight sm:text-5xl md:text-6xl p-6 ">
            <span class="block">
                {{ __('The one and only') }}
                <span class="text-transparent bg-clip-text bg-gradient-to-tr to-cyan-500 from-blue-600">
                    {{ __('CRM') }}
                </span>
                {{ __('your small business needs.') }}
            </span>
        </h1>
        <h2 class="text-3xl font-bold tracking-tight  sm:text-3xl md:text-4xl p-6">
            {{ __('For keep your prospection activity on') }}
            <span class="text-transparent bg-clip-text bg-gradient-to-tr to-cyan-500 from-blue-600">
                {{ __('LinkedIn') }}
            </span>
        </h2>
        @if (Route::has('login'))
        <section class="flex items-center justify-center gap-4 mt-24">
            <p class="mt-2 text-xl text-gray-400 italic">
                Ya lo estás usando. Solo necesitas continuar.
            </p>            
            @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="text-4xl inline-block px-4 py-2 rounded-md font-medium text-white bg-gradient-to-tr from-cyan-500 to-blue-600 hover:from-blue-600 hover:to-cyan-400 transition"
                >
                    {{ __('Desk') }}
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="text-4xl inline-block px-4 py-2 rounded-md font-medium text-white bg-gradient-to-tr from-cyan-500 to-blue-600 hover:from-blue-600 hover:to-cyan-400 transition"
                >
                    Iniciar sesión
                </a>
            @endauth

        </section>
        @endif
    </section>
</flux:main>