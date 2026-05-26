<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the mentors that teach this course.
     */
    public function mentors()
    {
        return $this->belongsToMany(User::class, 'mentor_courses', 'course_id', 'mentor_id');
    }

    /**
     * Get the bookings for this course.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
