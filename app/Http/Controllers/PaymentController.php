<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function addToCart(Course $course) {
        session()->put('cart.course_id', $course->id);
        return redirect('/cart');
    }

    public function cart() {
        $course = Course::find(session('cart.course_id'));
        return view('cart', compact('course'));
    }

    public function checkout() {
        $course = Course::find(session('cart.course_id'));

        $payment = Payment::create([
            'user_id' => Auth::user()->id,
            'course_id' => $course->id,
            'amount' => $course->price,
            'provider' => request('provider'),
            'status' => 'pending'
        ]);

        // here connect Kaspi/Halyk
        $payment->update(['status'=>'paid']);

        Enrollment::create([
            'user_id'=>auth()->id,
            'course_id'=>$course->id,
            'paid_at'=>now()
        ]);

        return redirect('/my-courses');
    }
}
