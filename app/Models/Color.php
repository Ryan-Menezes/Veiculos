<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['hexadecimal', 'image'];

    public function vehicle(){
    	return $this->hasOne(Vehicle::class);
    }
}
