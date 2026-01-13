@extends('layouts.app')
@section('content')
    <section class="grid grid-cols-1 gap-4 md:grid-cols-3">
        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
            <p class="text-xs text-zinc-400">Mentors online now</p>
            <div class="mt-1 flex items-end justify-between">
                <p class="text-2xl font-semibold tracking-tight">3</p>
                <span
                    class="rounded-full bg-emerald-500/15 px-2 py-1 text-xs font-semibold text-emerald-200">Available</span>
            </div>
            <p class="mt-2 text-xs text-zinc-400">Start a 15-min intro call and get a plan.</p>
        </div>
        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
            <p class="text-xs text-zinc-400">Next trial lesson</p>
            <p class="mt-1 text-sm font-semibold">Today • 18:00</p>
            <p class="mt-1 text-xs text-zinc-400">Build Auth API (Laravel 12)</p>
            <button
                class="mt-3 inline-flex w-full items-center justify-center rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm hover:bg-white/10">
                🔴 Join Trial
            </button>
        </div>
        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
            <p class="text-xs text-zinc-400">Your scheduled lessons</p>
            <p class="mt-1 text-sm font-semibold">2 upcoming</p>
            <p class="mt-1 text-xs text-zinc-400">Access is available after payment.</p>
            <button
                class="mt-3 inline-flex w-full items-center justify-center rounded-xl bg-white px-3 py-2 text-sm font-semibold text-zinc-950 hover:bg-zinc-100">
                View Schedule
            </button>
        </div>
    </section>
    <!-- Mentors grid -->
    <section>
        <div class="mb-3 flex items-center justify-between">
            <div>
                <h2 class="text-sm font-semibold">Mentors Online</h2>
                <p class="text-xs text-zinc-400">Click “Start Free Call” to connect instantly.</p>
            </div>

            <div class="flex items-center gap-2">
                <button
                    class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm hover:bg-white/10">
                    Filter
                </button>
                <button
                    class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm hover:bg-white/10">
                    Sort
                </button>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
            <!-- Mentor card -->
            @foreach ($mentors as $mentor)
                <article class="group rounded-2xl border border-white/10 bg-white/5 p-4 hover:bg-white/10 transition">

                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="h-10 w-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold">
                                {{ strtoupper(substr($mentor->name, 0, 1)) }}
                            </div>

                            <div>
                                <p class="text-sm font-semibold">{{ $mentor->name }}</p>
                                <p class="text-xs text-zinc-400">
                                    {{ $mentor->headline ?? 'Laravel • DevOps • SaaS' }}
                                </p>
                            </div>
                        </div>

                        <span
                            class="inline-flex items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-2 py-1 text-xs font-semibold text-emerald-400">
                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                            Live
                        </span>
                    </div>

                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach (explode(',', $mentor->skills ?? 'Laravel,DevOps,SaaS') as $skill)
                            <span
                                class="rounded-full border border-white/10 bg-zinc-950/30 px-2 py-1 text-xs text-zinc-300">
                                {{ trim($skill) }}
                            </span>
                        @endforeach
                    </div>

                    <div class="mt-4 grid grid-cols-2 gap-2">
                        <form method="POST" action="{{ route('live.free', $mentor) }}">
                            @csrf
                            <button
                                class="w-full rounded-xl bg-emerald-500 px-3 py-2 text-xs font-semibold text-zinc-950 hover:bg-emerald-400">
                                Start Free Call
                            </button>
                        </form>

                        <a href="/mentors/{{ $mentor->id }}"
                            class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-xs hover:bg-white/10">
                            Profile
                        </a>
                    </div>

                    <p class="mt-3 text-xs text-zinc-400">
                        {{ $mentor->hosted_calls_count }} calls completed
                    </p>

                </article>
            @endforeach
        </div>
    </section>
    <!-- Trial lessons list -->
    <section class="rounded-2xl border border-white/10 bg-white/5 p-4">
        <div class="flex items-start justify-between gap-3">
            <div>
                <h3 class="text-sm font-semibold">Trial Lessons</h3>
                <p class="text-xs text-zinc-400">Join a group session to experience live coding.</p>
            </div>
            <button
                class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm hover:bg-white/10">
                View all
            </button>
        </div>
        <div class="mt-4 divide-y divide-white/10">
            <div class="flex flex-col gap-3 py-3 md:flex-row md:items-center md:justify-between">
                <div class="flex items-center gap-3">
                    <span
                        class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-red-500/10 text-red-200">🎥</span>
                    <div>
                        <p class="text-sm font-semibold">Build Auth API (Laravel 12)</p>
                        <p class="text-xs text-zinc-400">Today • 18:00 • 60 min • Mentor: Kanat</p>
                    </div>
                </div>
                <button
                    class="inline-flex items-center justify-center rounded-xl bg-emerald-500 px-3 py-2 text-sm font-semibold text-zinc-950 hover:bg-emerald-400">
                    Join
                </button>
            </div>
            <div class="flex flex-col gap-3 py-3 md:flex-row md:items-center md:justify-between">
                <div class="flex items-center gap-3">
                    <span
                        class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-red-500/10 text-red-200">🎥</span>
                    <div>
                        <p class="text-sm font-semibold">Dockerize Laravel + Postgres</p>
                        <p class="text-xs text-zinc-400">Tomorrow • 19:00 • 60 min • Mentor: Nurlan</p>
                    </div>
                </div>
                <button
                    class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm hover:bg-white/10">
                    Reserve
                </button>
            </div>
        </div>
    </section>
@endsection
