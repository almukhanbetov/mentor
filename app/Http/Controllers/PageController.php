<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $courses = Course::latest()
            ->take(6)
            ->get();

        return view('pages.index',compact('courses'));
    }
}
