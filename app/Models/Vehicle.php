<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;
    protected $fillable = ['manufacture_id', 'brand', 'slug', 'model', 'year', 'ports', 'price', 'mileage', 'release_date', 'description'];

    public function colors(){
    	return $this->belongsToMany(Color::class);
    }

    public function manufacture(){
    	return $this->belongsTo(Manufacture::class);
    }

    public function categories(){
    	return $this->belongsToMany(Category::class);
    }
}
