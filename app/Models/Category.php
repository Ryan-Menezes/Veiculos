<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'slug'];

    // VALIDATES

    public function validateCreate(array $data){
        $roles = [
            'name' => ['required', 'string', 'max:100', 'unique:categories']
        ];

        $validator = Validator::make($data, $roles);
        if($validator->fails()):
            $result = ['success' => false, 'message' => ''];

            foreach($validator->errors()->all() as $error):
                $result['message'] .= "<p class='p-0 m-0'>{$error}</p>";           
            endforeach;

            return json_encode($result);
        endif;

        return null;
    }

    public function validateUpdate(array $data){
        $roles = [
            'name' => ['required', 'string', 'max:100', Rule::unique('categories')->ignore($this->id)]
        ];

        $validator = Validator::make($data, $roles);
        if($validator->fails()):
            $result = ['success' => false, 'message' => ''];

            foreach($validator->errors()->all() as $error):
                $result['message'] .= "<p class='p-0 m-0'>{$error}</p>";           
            endforeach;

            return json_encode($result);
        endif;

        return null;
    }

    // RELARIONS

    public function vehicles(){
    	return $this->belongsToMany(Vehicle::class);
    }
}
