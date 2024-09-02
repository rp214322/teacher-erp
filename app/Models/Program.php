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
    public function users(){
        return $this->hasMany(User::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($program) {
            foreach ($program->subjects as $subject) {
                $subject->delete();
            }
            foreach ($program->users as $user) {
                $user->delete();
            }
        });

        static::restoring(function ($program) {
            $program->users()->withTrashed()->restore();
        });
    }
}
