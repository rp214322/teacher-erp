<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
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
    public function agent(){
        return $this->belongsTo('App\Models\Agent');
    }
    public static $currency = [
        "INR" => "INR",
        "USD" => "USD",
        "GBP" => "GBP",
        "EUR" => "EUR",
        "CHF" => "CHF",
    ];
    public function hotelbookings(){
        return $this->hasMany(HotelBooking::class);
    }
    public function tourbookings(){
        return $this->hasMany(TourBooking::class);
    }
    public function miscbookings(){
        return $this->hasMany(MiscBooking::class);
    }
    public function remarks(){
        return $this->hasMany(Remark::class);
    }
    public function miscbookingcostings(){
        return $this->hasMany(MiscBookingCosting::class);
    }
    // public function transferbookings(){
    //     return $this->hasMany(TransferBooking::class);
    // }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($booking) {
            foreach ($booking->hotelbookings as $hotelbooking) {
                $hotelbooking->delete();
            }
            foreach ($booking->tourbookings as $tourbooking) {
                $tourbooking->delete();
            }
            foreach ($booking->miscbookings as $miscbooking) {
                $miscbooking->delete();
            }
            foreach ($booking->remarks as $remark) {
                $remark->delete();
            }
            foreach ($booking->remarks as $remark) {
                $remark->delete();
            }
            foreach ($booking->miscbookingcostings as $miscbookingcosting) {
                $miscbookingcosting->delete();
            }
            // foreach ($booking->transferbookings as $transferbooking) {
            //     $transferbooking->delete();
            // }
        });
        static::restoring(function ($booking) {
            $booking->hotelbookings()->withTrashed()->restore();
            $booking->tourbookings()->withTrashed()->restore();
            $booking->miscbookings()->withTrashed()->restore();
            $booking->remarks()->withTrashed()->restore();
            $booking->remmiscbookingcostingsarks()->withTrashed()->restore();
            // $booking->transferbookings()->withTrashed()->restore();
        });
    }
}
