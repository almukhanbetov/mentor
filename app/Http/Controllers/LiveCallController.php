<?php
namespace App\Http\Controllers;
use App\Models\LiveCall;
use App\Models\MentorSlot;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LiveCallController extends Controller
{
    /**
     * List of available mentors & slots
     */
    public function index()
    {
        $mentors = User::where('role', 'mentor')
            ->where('is_online', true)
            ->get();

        $slots = MentorSlot::where('starts_at', '>=', now())
            ->where('is_booked', false)
            ->orderBy('starts_at')
            ->with('mentor')
            ->get();

        return view('live-calls.index', compact('mentors', 'slots'));
    }
    /**
     * Free trial call
     */
    public function startFreeCall(User $mentor)
    {
        $call = LiveCall::create([
            'student_id' => auth()->id(),
            'mentor_id' => $mentor->id,
            'status' => 'free',
            'minutes_purchased' => 15,
            'price_kzt' => 0,
            'jitsi_room' => 'free-' . Str::uuid(),
            'started_at' => now(),
        ]);

        return redirect()->route('live.calls.room', $call);
    }
    /**
     * Enter call room
     */
    public function room(LiveCall $call)
    {
        abort_unless(
            auth()->id() === $call->student_id || auth()->id() === $call->mentor_id,
            403
        );
        if (!$call->started_at) {
            $call->update(['started_at' => now()]);
        }
        return view('live-calls.room', compact('call'));
    }
    /**
     * End call
     */
    public function end(LiveCall $call)
    {
        abort_unless(
            auth()->id() === $call->student_id || auth()->id() === $call->mentor_id,
            403
        );
        if ($call->is_expired) {
            $call->update([
                'status' => 'ended',
                'ended_at' => now(),
            ]);

            return redirect('/live-calls')->with('error', 'Call expired');
        }
        // $call->update([
        //     'ended_at' => now(),
        //     'status' => 'ended'
        // ]);
        // return redirect('/live-calls');
        return view('live-calls.room', compact('call'));
    }
    /**
     * Paid lesson join
     */
    public function joinLesson(Lesson $lesson)
    {
        abort_unless(auth()->user()->hasPaidCourse($lesson->course_id), 403);
        $call = LiveCall::create([
            'lesson_id' => $lesson->id,
            'mentor_id' => $lesson->mentor_id,
            'student_id' => auth()->id(),
            'status' => 'paid',
            'minutes_purchased' => 60,
            'price_kzt' => 5000,
            'jitsi_room' => 'lesson-' . Str::uuid(),
            'started_at' => now(),
        ]);
        return redirect()->route('live.calls.room', $call);
    }
    /**
     * Trial calls list
     */
    public function trialLessons()
    {
        $calls = LiveCall::where('student_id', auth()->id())
            ->where('status', 'trial')
            ->orderBy('started_at')
            ->get();

        return view('live-calls.trial', compact('calls'));
    }

    /**
     * Paid calls list
     */
    public function myLessons()
    {
        $calls = LiveCall::where('student_id', auth()->id())
            ->where('status', 'paid')
            ->orderBy('started_at')
            ->get();

        return view('live-calls.my', compact('calls'));
    }
    public function tick(LiveCall $call)
    {
        abort_unless(
            auth()->id() === $call->student_id || auth()->id() === $call->mentor_id,
            403
        );

        if ($call->status === 'ended') {
            return response()->json(['ended' => true]);
        }

        $call->increment('seconds_used');

        if ($call->seconds_left <= 0) {
            $call->update([
                'status' => 'ended',
                'ended_at' => now()
            ]);

            return response()->json(['ended' => true]);
        }

        return response()->json([
            'seconds_left' => $call->seconds_left
        ]);
    }

}
