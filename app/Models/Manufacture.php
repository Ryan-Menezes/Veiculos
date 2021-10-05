<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'image'];

    public function vehicles(){
    	return $this->hasMany(Vehicle::class);
    }
}
