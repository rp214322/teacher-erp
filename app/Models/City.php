<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
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
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
    public function trains()
    {
        return $this->hasMany(Train::class);
    }
    public function airports()
    {
        return $this->hasMany(Airport::class);
    }
    public function agents()
    {
        return $this->hasMany(Agent::class);
    }
    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }
    public function miscbookings(){
        return $this->hasMany(MiscBooking::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($city) {
            foreach ($city->hotels as $hotel) {
                $hotel->delete();
            }
            foreach ($city->tours as $tour) {
                $tour->delete();
            }
            foreach ($city->trains as $train) {
                $train->delete();
            }
            foreach ($city->airports as $airport) {
                $airport->delete();
            }
            foreach ($city->agents as $agent) {
                $agent->delete();
            }
            foreach ($city->suppliers as $supplier) {
                $supplier->delete();
            }
            foreach ($city->miscbookings as $miscbooking) {
                $miscbooking->delete();
            }
        });

        static::restoring(function ($city) {
            $city->hotels()->withTrashed()->restore();
            $city->tours()->withTrashed()->restore();
            $city->trains()->withTrashed()->restore();
            $city->airports()->withTrashed()->restore();
            $city->miscbookings()->withTrashed()->restore();
        });
    }
}
