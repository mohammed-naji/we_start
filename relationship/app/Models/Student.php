<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'my_courses')
        ->withPivot('mark')
        ->withTimestamps()
        ->as('show')
        ;
    }
}
