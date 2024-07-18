<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelBooking extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];
    public function booking(){
        return $this->belongsTo('App\Models\Booking');
    }
    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }
    public static $meal_plan = [
        "Room only" => "Room only",
        "Bed and breakfast" => "Bed and breakfast",
        "Half board" => "Half board",
        "Full board" => "Full board",
        "All inclusive" => "All inclusive",
    ];
}
