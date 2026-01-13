<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class LiveCall extends Model
{
    protected $fillable = [
        'student_id',
        'mentor_id',
        'course_id',
        'lesson_id',
        'payment_id',
        'price_kzt',
        'minutes_purchased',
        'minutes_used',
        'jitsi_room',
        'status',
        'started_at',
        'ended_at'
    ];
    public function getSecondsLeftAttribute()
    {
        if (!$this->started_at || !$this->minutes_purchased) {
            return 0;
        }

        $start = Carbon::parse($this->started_at);
        $end   = $start->copy()->addMinutes($this->minutes_purchased);

        $now = now();

        // если звонок ещё не начался
        if ($now->lt($start)) {
            return $this->minutes_purchased * 60;
        }

        return max(0, ($this->minutes_purchased * 60) - $this->seconds_used);
    }

    public function getIsExpiredAttribute()
    {
        return $this->seconds_left <= 0;
    }

    public function student() { return $this->belongsTo(User::class, 'student_id'); }
    public function mentor() { return $this->belongsTo(User::class, 'mentor_id'); }

    public function payment() { return $this->belongsTo(Payment::class); }
    public function course() { return $this->belongsTo(Course::class); }
    public function lesson() { return $this->belongsTo(Lesson::class); }
}
