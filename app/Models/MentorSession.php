<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentorSession extends Model
{
    protected $fillable = [
        'mentor_id','student_id','lesson_id',
        'payment_id','type','status','price',
        'starts_at','ended_at'
    ];

    public function mentor() { return $this->belongsTo(User::class, 'mentor_id'); }
    public function student() { return $this->belongsTo(User::class, 'student_id'); }
    public function call() { return $this->hasOne(Call::class); }
    public function lesson() { return $this->belongsTo(Lesson::class); }
    public function payment() { return $this->belongsTo(Payment::class); }
}
