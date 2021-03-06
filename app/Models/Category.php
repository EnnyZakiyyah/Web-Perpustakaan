<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function katalogs(){
        return $this->hasMany(Katalog::class);
    }

    public function koleksidigitals(){
        return $this->hasMany(Koleksidigital::class);
    }

    public function bibliographies(){
        return $this->hasMany(Bibliography::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
