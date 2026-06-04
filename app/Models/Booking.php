<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mentee_id',
        'mentor_id',
        'mentoring_class_id',
        'booking_date',
        'status',
        'notes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'booking_date' => 'datetime',
        ];
    }

    /**
     * Get the mentee (user) that made the booking.
     */
    public function mentee()
    {
        return $this->belongsTo(User::class, 'mentee_id');
    }

    /**
     * Relasi ke Mentor (User yang mengajar)
     */
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    /**
     * Get the mentor (user) for this booking.
     */
    public function mentoringClass()
    {
        return $this->belongsTo(MentoringClass::class, 'mentoring_class_id');
    }

    /**
     * Get the course for this booking.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
