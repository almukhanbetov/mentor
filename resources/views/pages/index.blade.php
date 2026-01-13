@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-20">

    {{-- HERO --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div>
            <h1 class="text-5xl font-bold leading-tight">
                Learn Programming & DevOps
            </h1>
            <p class="mt-4 text-xl text-zinc-400">
                Мы не учим. Мы доводим проекты до продакшна.
            </p>

            <p class="mt-6 text-zinc-500">
                Backend, Frontend и DevOps с реальными инженерами.
                От первой строки кода до домена, CI/CD и production.
            </p>

            <div class="mt-8 flex gap-4">
                <a href="{{ route('live.calls') }}"
                   class="bg-orange-500 hover:bg-orange-600 px-6 py-3 rounded-lg text-black font-semibold">
                    🔥 Start Free Live Call
                </a>

                <a href="/courses"
                   class="border border-zinc-700 px-6 py-3 rounded-lg hover:bg-zinc-900">
                    📚 View Courses
                </a>
            </div>
        </div>

        <div class="bg-gradient-to-br from-orange-500/20 to-purple-600/20 rounded-2xl p-8 shadow-xl">
            <div class="text-sm text-zinc-400 mb-2">Live Engineering Session</div>
            <div class="text-lg font-semibold">Deploying Laravel SaaS to VPS</div>
            <div class="mt-4 text-zinc-500">
                Student is connected to a DevOps engineer.  
                Docker, CI/CD, Nginx, SSL, Production.
            </div>
        </div>
    </div>

    {{-- WHAT YOU CAN DO --}}
    <div class="mt-32 grid grid-cols-1 md:grid-cols-4 gap-6">
        @php
        $features = [
            ['🎧', 'Free Live Call', '15 минут с инженером бесплатно'],
            ['🧠', 'Mentorship', 'Платные консультации и разборы'],
            ['⚙️', 'DevOps', 'Docker, VPS, CI/CD, Production'],
            ['🎓', 'Courses', 'Проектное обучение'],
        ];
        @endphp

        @foreach($features as $f)
            <div class="bg-zinc-900 p-6 rounded-xl hover:bg-zinc-800 transition">
                <div class="text-3xl">{{ $f[0] }}</div>
                <div class="mt-4 font-semibold text-lg">{{ $f[1] }}</div>
                <div class="mt-2 text-zinc-400">{{ $f[2] }}</div>
            </div>
        @endforeach
    </div>

    {{-- HOW IT WORKS --}}
    <div class="mt-32">
        <h2 class="text-3xl font-bold mb-8">How it works</h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-zinc-400">
            <div>
                <div class="text-orange-500 font-bold">1</div>
                <div class="mt-2 font-semibold">Free Call</div>
                <p>Обсуждаем цель, проект и стек</p>
            </div>
            <div>
                <div class="text-orange-500 font-bold">2</div>
                <div class="mt-2 font-semibold">Learning Path</div>
                <p>Курсы и менторы под твою цель</p>
            </div>
            <div>
                <div class="text-orange-500 font-bold">3</div>
                <div class="mt-2 font-semibold">Build</div>
                <p>Ты пишешь код, мы помогаем</p>
            </div>
            <div>
                <div class="text-orange-500 font-bold">4</div>
                <div class="mt-2 font-semibold">Production</div>
                <p>Деплой, домен, CI/CD</p>
            </div>
        </div>
    </div>

    {{-- LIVE MENTORS --}}
    <div class="mt-32">
        <h2 class="text-3xl font-bold mb-6">Live Engineers</h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach($mentors ?? [] as $mentor)
                <div class="bg-zinc-900 p-6 rounded-xl">
                    <div class="font-semibold">{{ $mentor->name }}</div>
                    <div class="text-sm text-zinc-400">{{ $mentor->stack }}</div>

                    <a href="{{ route('live.free', $mentor) }}"
                       class="mt-4 block bg-orange-500 text-black text-center py-2 rounded">
                        Start Free Call
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    {{-- COURSES --}}
    <div class="mt-32">
        <h2 class="text-3xl font-bold mb-6">Project-based Courses</h2>
        <p class="text-zinc-400 mb-6">
            Не видео. Реальные проекты, которые ты доводишь до продакшна.
        </p>

        <a href="/courses" class="text-orange-500">Browse all courses →</a>
    </div>

    {{-- SERVICES --}}
    <div class="mt-32">
        <h2 class="text-3xl font-bold mb-6">Need it done?</h2>
        <p class="text-zinc-400 mb-6">
            Мы можем не только учить, но и сделать за тебя.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-zinc-900 p-6 rounded-xl">Backend Development</div>
            <div class="bg-zinc-900 p-6 rounded-xl">DevOps & CI/CD</div>
            <div class="bg-zinc-900 p-6 rounded-xl">Production Setup</div>
        </div>
    </div>

</div>

@endsection
