<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'slug'];

    public function vehicles(){
    	return $this->belongsToMany(Vehicle::class);
    }
}
