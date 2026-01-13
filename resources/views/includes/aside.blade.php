<aside class="w-64 bg-slate-900 h-screen flex flex-col p-4 text-zinc-200">
    {{-- Logo --}}
    <div class="flex flex-col items-center mb-6">
        <img src="{{ asset('img/complex.png') }}" class="w-20 h-20 mb-2">
        <div class="text-green-400 font-bold text-lg">Live Mentors</div>
    </div>
    {{-- LIVE PANEL --}}
    <div class="space-y-3 border-b border-slate-700 pb-4">
        <a href="{{ route('live.calls') }}" class="flex justify-between hover:text-green-400">
            <span>🔴 Менторы онлайн</span>
            <span class="bg-green-600 px-2 rounded text-white">{{ $sidebarMentorsOnline }}</span>
        </a>
        <a href="{{ route('live.calls') }}" class="flex justify-between hover:text-green-400">
            <span>✨ Бесплатный звонок</span>
            <span class="text-zinc-400">15 мин</span>
        </a>
        <a href="{{ route('trial.lessons') }}" class="flex justify-between hover:text-green-400">
            <span>🎓 Пробные занятия</span>
            <span class="text-zinc-400">{{ $sidebarTrialLessons }}</span>
        </a>
        <a href="{{ route('my.lessons') }}" class="flex justify-between hover:text-green-400">
            <span>📅 Мои уроки</span>
            <span class="text-zinc-400">{{ $sidebarMyLessons }}</span>
        </a>
        <a href="{{ route('call.history') }}" class="flex justify-between hover:text-green-400">
            <span>📂 История звонков</span>
            <span class="text-zinc-400">{{ $sidebarCallHistory }}</span>
        </a>
    </div>
    {{-- NAVIGATION --}}
    <div class="mt-4 space-y-2">
        <a href="{{ route('pages.index') }}" class="block px-3 py-2 rounded hover:bg-slate-800">🏠 Главная</a>
        <a href="{{ route('courses.index') }}" class="block px-3 py-2 rounded hover:bg-slate-800">📚 Курсы</a>
        <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded hover:bg-slate-800">👤 Профиль</a>
        @if (auth()->user()?->role === 'mentor')
            <a href="/mentor" class="block px-3 py-2 rounded hover:bg-slate-800">🧑‍💻 Кабинет ментора</a>
        @endif
        @if (auth()->user()?->role === 'admin')
            <a href="/admin" class="block px-3 py-2 rounded hover:bg-slate-800 text-yellow-400">⚙️ Админка</a>
        @endif

    </div>

</aside>
