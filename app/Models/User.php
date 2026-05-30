<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'google_id', 'bio', 'portfolio_link', 'mentor_status', 'is_blocked'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the bookings where user is a mentee.
     */
    public function bookingsAsMentee()
    {
        return $this->hasMany(Booking::class, 'mentee_id');
    }

    /**
     * Get the bookings where user is a mentor.
     */
    public function bookingsAsMentor()
    {
        return $this->hasMany(Booking::class, 'mentor_id');
    }

    /**
     * Get the courses that the mentor teaches.
     * Only applicable for users with role 'mentor'.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'mentor_courses', 'mentor_id', 'course_id');
    }

    /**
     * Get the mentoring classes that the mentor offers.
     * Only applicable for users with role 'mentor'.
     */
    public function mentoringClasses()
    {
        return $this->hasMany(MentoringClass::class, 'mentor_id');
    }

    public function portfolios()
    {
        return $this->hasMany(MentorPortfolio::class);
    }
}
