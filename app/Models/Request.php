<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Request extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = ['vehicle_id', 'user_id', 'price', 'discount', 'status'];

    // RELATIONS

    public function user(){
    	return $this->hasOne(User::class);
    }

    public function vehicle(){
    	return $this->hasOne(Vehicle::class);
    }
}
