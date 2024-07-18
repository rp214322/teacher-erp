<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use HasFactory, Sluggable, SoftDeletes;
    protected $dates = ['deleted_at'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function country(){
        return $this->belongsTo('App\Models\Country');
    }

    public function city(){
        return $this->belongsTo('App\Models\City');
    }
    public function bookings(){
        return $this->hasMany(Booking::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($agent) {
            foreach ($agent->bookings as $booking) {
                $booking->delete();
            }
        });
        static::restoring(function ($agent) {
            $agent->bookings()->withTrashed()->restore();
        });
    }
}
