<?php
namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
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

    public function cities()
    {
        return $this->hasMany(City::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($country) {
            foreach ($country->cities as $city) {
                $city->delete();
            }
        });

        static::restoring(function ($country) {
            $country->cities()->withTrashed()->restore();
        });
    }
}
