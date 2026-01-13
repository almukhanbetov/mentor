<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentorSlot extends Model
{
    protected $fillable = [
        'mentor_id',
        'starts_at',
        'ends_at',
        'price',
        'is_booked'
    ];

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function session()
    {
        return $this->hasOne(MentorSession::class);
    }
}
