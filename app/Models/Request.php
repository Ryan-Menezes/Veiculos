<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = ['color_id', 'vehicle_id', 'user_id', 'price', 'discount', 'status'];

    public function user(){
    	return $this->hasOne(User::class);
    }

    public function vehicle(){
    	return $this->hasOne(Vehicle::class);
    }

    public function color(){
    	return $this->belongsToMany(Color::class);
    }
}
