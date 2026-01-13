<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
     public function index() {
        dd("afsfafa");
        // return view('courses.index', [
        //     'courses' => Course::where('is_active',true)->get()
        // ]);
    }
}
