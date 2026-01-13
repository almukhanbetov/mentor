@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-6">⚙️ Админ-панель</h1>

    <div class="grid md:grid-cols-3 gap-6">
        {{-- <a href="{{ route('admin.courses.index') }}" class="admin-card">📚 Курсы</a> --}}
        {{-- <a href="{{ route('admin.services.index') }}" class="admin-card">🛠 Услуги</a> --}}
        {{-- <a href="{{ route('admin.mentors.index') }}" class="admin-card">🧑‍🏫 Менторы</a> --}}
    </div>
@endsection
