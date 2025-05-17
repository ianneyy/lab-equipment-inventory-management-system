<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />

    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            
            <div class="w-full sm:max-w-md mt-6 px-6 py-10 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg text-center">
            @if (Route::has('register') && Route::currentRouteName() !== 'register')

                <h2 class="text-3xl text-gray-200 mb-2 font-bold">Welcome</h2>
                <h4 class="text-gray-400 mb-4">Log in to continue</h4>
                @else
                <h2 class="text-3xl text-gray-200 mb-2 font-bold">Welcome</h2>
                <h4 class="text-gray-400 mb-4">Register to continue</h4>
            @endif



                {{ $slot }}

            </div>
            @if (Route::has('register') && Route::currentRouteName() !== 'register')
            <div class="flex  mt-4 gap-2">
                <h4 class="text-gray-400">Dont have an account?</h4>
                <a href="{{route('register')}}" class="text-indigo-500 cursor-pointer hover:text-indigo-400">Register</a>
            </div>
            @else
            <div class="flex  mt-4 gap-2">
                <h4 class="text-gray-400">Already registered?</h4>
                <a href="{{route('login')}}" class="text-indigo-500 cursor-pointer hover:text-indigo-400">Login</a>
            </div>
            @endif

        </div>
    </body>
</html>
