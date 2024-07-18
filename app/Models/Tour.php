<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tour extends Model
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
    public static $type = [
        "Ticket" => "Ticket",
        "HalfDay" => "HalfDay",
        "FullDay" => "FullDay",
    ];
    public function country(){
        return $this->belongsTo('App\Models\Country');
    }

    public function city(){
        return $this->belongsTo('App\Models\City');
    }
    public function tourbookings(){
        return $this->hasMany(TourBooking::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($tour) {
            foreach ($tour->tourbookings as $tourbooking) {
                $tourbooking->delete();
            }
        });

        static::restoring(function ($tour) {
            $tour->tourbookings()->withTrashed()->restore();
        });
    }
}
