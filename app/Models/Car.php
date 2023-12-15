<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_location_id',
        'model',
        'year',
        'color',
        'registration_number',
        'description',
        'daily_rate',
    ];

    /**
     * Get the car location that owns the car.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carLocation()
    {
        return $this->belongsTo(CarLocation::class);
    }

    /**
     * Get the bookings for the car.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
    * Get all available cars which are not booked
    *
    * @param $query
    * @param $start_date
    * @param $end_date
    *
    * @return mixed
    */
    public function scopeNotBooked($query, $start_date, $end_date)
    {
        return $query->whereDoesntHave('bookings', function ($query) use ($start_date, $end_date) {
            $query->where('start_date', '<=', $end_date)
                ->where('end_date', '>=', $start_date);
        });
    }

    /**
     * Get all booked cars
     *
     * @param $query
     * @param $start_date
     * @param $end_date
     *
     * @return mixed
     */
    public function scopeBooked($query, $start_date, $end_date)
    {
        return $query->whereHas('bookings', function ($query) use ($start_date, $end_date) {
            $query->where('start_date', '<=', $end_date)
                ->where('end_date', '>=', $start_date);
        });
    }
}
