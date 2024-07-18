<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
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
    public static $type = [
        "Hotel" => "Hotel",
        "Tour" => "Tour",
        "Transfer" => "Transfer",
        "Misc" => "Misc",
        "Restaurant" => "Restaurant",
    ];
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

        static::deleting(function ($supplier) {
            foreach ($supplier->miscbookingcostings as $miscbookingcosting) {
                $miscbookingcosting->delete();
            }
        });
        static::restoring(function ($supplier) {
            $supplier->remmiscbookingcostingsarks()->withTrashed()->restore();
        });
    }
}
