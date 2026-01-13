<?php

namespace App\Providers;

use App\Models\Call;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\LiveCall;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SidebarServiceProvider extends ServiceProvider
{ 
    public function register(): void
    {
        //
    }
   
    public function boot(): void
    {
        View::composer('includes.aside', function ($view) {
            $user = auth()->user();
            $mentorsOnline = User::where('role', 'mentor')
                ->where('is_online', true)
                ->count();
            $todayTrials = Lesson::where('type', 'trial')
                ->whereDate('scheduled_at', now())
                ->count();
            $myLessons = 0;
            $myCalls = 0;
            if ($user) {
                $myLessons = \App\Models\Lesson::whereHas('course.enrollments', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->where('scheduled_at', '>=', now())
                ->count();
                $myCalls = LiveCall::where('student_id', $user->id)->count();
            }
            $view->with([
                'sidebarMentorsOnline' => $mentorsOnline,
                'sidebarTrialLessons' => $todayTrials,
                'sidebarMyLessons' => $myLessons,
                'sidebarCallHistory' => $myCalls
            ]);
        });
    }
}
