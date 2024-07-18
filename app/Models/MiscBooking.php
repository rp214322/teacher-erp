<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MiscBooking extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];
    public function booking(){
        return $this->belongsTo('App\Models\Booking');
    }
    public function country(){
        return $this->belongsTo('App\Models\Country');
    }
    public function city(){
        return $this->belongsTo('App\Models\City');
    }
    public function miscbookingcostings(){
        return $this->hasMany(MiscBookingCosting::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($miscbooking) {
            foreach ($miscbooking->miscbookingcostings as $miscbookingcosting) {
                $miscbookingcosting->delete();
            }
        });
        static::restoring(function ($miscbooking) {
            $miscbooking->remmiscbookingcostingsarks()->withTrashed()->restore();
        });
    }
}
