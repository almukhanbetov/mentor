<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'DevOps Academy') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- SEO --}}
    <meta name="description" content="@yield('meta_description', 'Обучение программированию и DevOps')">
    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">
    <script src="https://meet.jit.si/external_api.js"></script>
</head>

<body class="bg-slate-950 text-gray-100 font-inter">
    <div class="min-h-screen flex">
        {{-- LEFTBAR --}}
        @include('includes.aside')
        {{-- MAIN --}}
        <div class="flex-1 flex flex-col">
            {{-- HEADER --}}
            @include('includes.header')
            {{-- CONTENT --}}
            <main class="flex-1 p-6">
                @yield('content')
            </main>

        </div>
    </div>

</body>

</html>
