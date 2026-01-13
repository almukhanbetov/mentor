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

<body class="bg-slate-950 text-zinc-200">
    <div class="flex h-screen overflow-hidden">

        {{-- SIDEBAR --}}
        <aside class="w-72 bg-slate-900 border-r border-slate-800 sticky top-0 h-screen overflow-y-auto">
            @include('includes.aside')
        </aside>

        {{-- MAIN --}}
        <main class="flex-1 overflow-y-auto">
            @include('includes.header')

            <div class="max-w-7xl mx-auto px-8 py-10">
                @yield('content')
            </div>
        </main>

    </div>
</body>

</html>
