<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory,Sluggable,SoftDeletes;
    protected $dates = ['deleted_at'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public static $category = [
        "1Star" => "1Star",
        "2Star" => "2Star",
        "3Star" => "3Star",
        "4Star" => "4Star",
        "5Star" => "5Star",
        "6Star" => "6Star",
        "7Star" => "7Star",
        "8Star" => "8Star",
    ];
    public function country(){
        return $this->belongsTo('App\Models\Country');
    }

    public function city(){
        return $this->belongsTo('App\Models\City');
    }
    public function hotelbookings(){
        return $this->hasMany(HotelBooking::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($hotel) {
            foreach ($hotel->hotelbookings as $hotelbooking) {
                $hotelbooking->delete();
            }
        });
        static::restoring(function ($hotel) {
            $hotel->hotelbookings()->withTrashed()->restore();
        });
    }
}
