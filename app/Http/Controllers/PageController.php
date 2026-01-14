<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $mentors = User::where('role', 'mentor')
        ->where('is_online', true)
        ->limit(6)
        ->get();

        $courses = Course::latest()->limit(6)->get();

        return view('pages.index', compact('mentors', 'courses'));
    }
}
