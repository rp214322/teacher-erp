<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $dates = [ 'deleted_at' ] ;
    public function sluggable(): array
    {
        return [ 
            'slug'=> [ 
                'source'=> 'name'
             ] 
         ] ;
    }
    public function subjects(){
        return $this->hasMany(Subject::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            foreach ($product->subjects as $subject) {
                $subject->delete();
            }
        });

        static::restoring(function ($product) {
            $product->subjects()->withTrashed()->restore();
        });
    }
}
