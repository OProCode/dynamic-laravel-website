<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="w-full text-center">
                    <div class="flex flex-row mx-20 p-6">
                        <h1 class="w-full text-orange-400 text-3xl text-left align-middle">
                            {{ $header }}
                        </h1>
                        @if (Str::endsWith(request()->route()->getName(), '.index'))
                            <div class="w-full max-w-xs text-center">
                                @foreach(['create-success', 'update-error', 'update-success', 'delete-error', 'delete-success', 'message'] as $message)
                                    @if(session()->has($message))
                                        <p class="bg-red-200 text-red-800 p-2 rounded-md">{{ session($message) }}</p>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>

                    @if($errors->any())
                        <div class="flex flex-row mb-6 mx-20 p-4 bg-red-200 text-red-800 text-center">
                            @foreach($errors->all() as $error)<p class="w-full">{{$error}}</p>@endforeach
                        </div>
                    @endif

                </header>
            @endif

            <!-- Page Content -->
            <main>
                <div class="mx-20 px-10 py-6 rounded-md text-gray-800 bg-gray-200 dark:bg-gray-800 dark:text-gray-200 items-center">
                    <section class="flex flex-col gap-4 w-full text-gray-300 rounded-md">
                        {{ $slot }}
                    </section>
                    @if (Str::endsWith(request()->route()->getName(), '.index'))
                        <section class="w-full mt-6">
                            {{ $pagination }}
                        </section>
                    @endif
                </div>
            </main>
        </div>
    </body>
</html>
