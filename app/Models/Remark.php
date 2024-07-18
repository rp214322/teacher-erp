<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Remark extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];
    public function booking(){
        return $this->belongsTo('App\Models\Booking');
    }
}
