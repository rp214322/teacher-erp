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
}
