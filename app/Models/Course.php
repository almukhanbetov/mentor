<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
