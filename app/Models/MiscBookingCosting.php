<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiscBookingCosting extends Model
{
    use HasFactory;
    protected $table = 'misc_booking_costing';
    public function booking(){
        return $this->belongsTo('App\Models\Booking');
    }
    public function miscbooking(){
        return $this->belongsTo('App\Models\MiscBooking');
    }
    public function supplier(){
        return $this->belongsTo('App\Models\Supplier');
    }
    public static $currency = [
        "INR" => "INR",
        "USD" => "USD",
        "GBP" => "GBP",
        "EUR" => "EUR",
        "CHF" => "CHF",
    ];
}
