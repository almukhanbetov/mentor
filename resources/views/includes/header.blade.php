  <header class="h-14 bg-slate-900 border-b border-slate-800 flex items-center justify-between px-6">
      <div class="font-semibold">
          @yield('title', 'Платформа обучения')
      </div>
      <div class="flex items-center gap-4">
          @guest
              <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white">
                  Вход
              </a>
              <a href="{{ route('register') }}" class="px-3 py-1 bg-orange-500 text-white rounded text-sm">
                  Регистрация
              </a>
          @endguest
          @auth
              @can('admin-panel')
                  <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-slate-800 text-yellow-400">
                      ⚙️ Админка
                  </a>
              @endcan
              <span class="text-sm text-gray-400">
                  {{ auth()->user()->name }}
              </span>
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="text-sm text-red-400 hover:text-red-300">
                      Выход
                  </button>
              </form>
          @endauth
      </div>
  </header>
