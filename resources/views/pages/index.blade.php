@extends('layouts.app')

@section('content')
    <div class="w-full max-w-none px-4 sm:px-6 py-32 mx-auto">

        {{-- HERO --}}
        <div class="relative w-full md:-ml-20
            grid grid-cols-1 md:grid-cols-[4fr_3fr]
            gap-8 items-center">
            <div>
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold leading-tight">
                    Learn Programming & DevOps+2
                </h1>
                <p class="mt-4 text-lg sm:text-xl md:text-2xl text-zinc-400">
                    Мы не учим. Мы доводим проекты до продакшна.
                </p>

                <p class="mt-6 text-zinc-500">
                    Backend, Frontend и DevOps с реальными инженерами.
                    От первой строки кода до домена, CI/CD и production.
                </p>

                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('live.calls') }}"
                        class="bg-orange-500 hover:bg-orange-600 px-6 py-3 rounded-lg text-white font-semibold w-full sm:w-auto text-center">
                         Start Free Live Call
                    </a>

                    <a href="/courses" class="border border-zinc-700 px-6 py-3 rounded-lg hover:bg-zinc-900 w-full sm:w-auto text-center">
                        📚 View Courses
                    </a>
                </div>
            </div>

            <div class="mt-8 md:mt-0
            bg-gradient-to-br from-orange-500/20 to-purple-600/20
            rounded-2xl p-6 sm:p-8 shadow-xl">
                <div class="text-sm text-zinc-400 mb-2">Live Engineering Session</div>
                <div class="text-lg font-semibold">Deploying Laravel SaaS to VPS</div>
                <div class="mt-4 text-zinc-500">
                    Student is connected to a DevOps engineer.
                    Docker, CI/CD, Nginx, SSL, Production.
                </div>
            </div>
        </div>

        {{-- WHAT YOU CAN DO --}}
        <div class="mt-28
           relative md:-ml-20
           grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4
           gap-5 md:gap-6">
            @php
                $features = [
                    ['🎧', 'Free Live Call', '15 минут с инженером бесплатно'],
                    ['🧠', 'Mentorship', 'Платные консультации и разборы'],
                    ['⚙️', 'DevOps', 'Docker, VPS, CI/CD, Production'],
                    ['🎓', 'Courses', 'Проектное обучение'],
                ];
            @endphp

            @foreach ($features as $f)
                <div class="bg-zinc-900 p-6 rounded-xl hover:bg-zinc-800 transition">
                    <div class="text-3xl">{{ $f[0] }}</div>
                    <div class="mt-4 font-semibold text-lg">{{ $f[1] }}</div>
                    <div class="mt-2 text-zinc-400">{{ $f[2] }}</div>
                </div>
            @endforeach
        </div>

        {{-- HOW IT WORKS --}}
        {{-- HOW IT WORKS --}}
        <section class="mb-24">
            <h2 class="text-3xl font-bold mt-8 relative md:-ml-8 text-orange-500">How it works</h2>

            <div class="mt-10
               relative md:-ml-20
               grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4
               gap-5 md:gap-6 text-center">
                <div class="bg-slate-900 rounded-xl p-6 hover:bg-slate-800 transition">
                    <div class="text-orange-500 text-2xl font-bold mb-2">1</div>
                    <h3 class="font-semibold mb-1">Free Call</h3>
                    <p class="text-gray-400 text-sm">Обсуждаем цель, проект и стек</p>
                </div>

                <div class="bg-slate-900 rounded-xl p-6 hover:bg-slate-800 transition">
                    <div class="text-orange-500 text-2xl font-bold mb-2">2</div>
                    <h3 class="font-semibold mb-1">Learning Path</h3>
                    <p class="text-gray-400 text-sm">Подбираем курсы и инженеров</p>
                </div>

                <div class="bg-slate-900 rounded-xl p-6 hover:bg-slate-800 transition">
                    <div class="text-orange-500 text-2xl font-bold mb-2">3</div>
                    <h3 class="font-semibold mb-1">Build</h3>
                    <p class="text-gray-400 text-sm">Ты пишешь код, мы помогаем</p>
                </div>

                <div class="bg-slate-900 rounded-xl p-6 hover:bg-slate-800 transition">
                    <div class="text-orange-500 text-2xl font-bold mb-2">4</div>
                    <h3 class="font-semibold mb-1">Production</h3>
                    <p class="text-gray-400 text-sm">VPS, домен, CI/CD, SSL</p>
                </div>
            </div>
        </section>


        {{-- LIVE ENGINEERS --}}
        <section class="mb-24">
            <h2 class="text-3xl font-bold mb-10">Live Engineers</h2>

            <div class="grid md:grid-cols-3 gap-6">
                @foreach ($mentors as $mentor)
                    <div class="bg-slate-900 rounded-xl p-6 hover:bg-slate-800 transition">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-green-500 rounded-full"></div>
                            <div>
                                <div class="font-semibold">{{ $mentor->name }}</div>
                                <div class="text-xs text-gray-400">{{ $mentor->stack }}</div>
                            </div>
                        </div>

                        <p class="text-gray-400 text-sm mb-4">
                            Live инженер. Работает с тобой над проектом в реальном времени.
                        </p>

                        <a href="{{ route('live.calls') }}"
                            class="inline-block px-4 py-2 bg-green-500 text-black rounded-lg font-semibold">
                            Start Call
                        </a>
                    </div>
                @endforeach
            </div>
        </section>


        {{-- PROJECT BASED COURSES --}}
        <section class="mb-24">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-bold">Project-based Courses</h2>
                    <p class="text-gray-400">
                        Не видео. Реальные проекты, которые ты доводишь до продакшна.
                    </p>
                </div>

                <a href="{{ route('courses.index') }}" class="text-orange-400">
                    Browse all →
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @foreach ($courses as $course)
                    <div class="bg-slate-900 p-6 rounded-xl hover:bg-slate-800 transition">
                        <h3 class="font-semibold mb-2">{{ $course->title }}</h3>
                        <p class="text-gray-400 text-sm mb-4">
                            {{ Str::limit($course->description, 100) }}
                        </p>
                        <a href="{{ route('courses.show', $course) }}" class="text-orange-400">
                            View →
                        </a>
                    </div>
                @endforeach
            </div>
        </section>


        {{-- SERVICES --}}
        <div class="mt-32">
            <h2 class="text-3xl font-bold mb-6">Need it done?</h2>
            <p class="text-zinc-400 mb-6">
                Мы можем не только учить, но и сделать за тебя.
            </p>

            <div class="relative md:-ml-20
               grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3
               gap-5 md:gap-6 text-center">
                <div class="bg-orange-600 p-6 rounded-xl text-2xl">Backend Development</div>
                <div class="bg-orange-600 p-6 rounded-xl text-2xl">DevOps & CI/CD</div>
                <div class="bg-orange-600 p-6 rounded-xl text-2xl">Production Setup</div>
            </div>
        </div>

    </div>
@endsection
