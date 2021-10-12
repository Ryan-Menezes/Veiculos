<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Discount extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['code', 'name', 'percentage', 'expiration_date'];

    // VALIDATES

    public function validateCreate(array $data){
        $roles = [
            'code'              => ['required', 'min:6', 'max:6', 'unique:code'],
            'name'              => ['required', 'string', 'max:100', 'unique:discounts'],
            'percentage'        => ['required', 'numeric'],
            'expiration_date'   => ['nullable', 'date']
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
            'code'              => ['required', 'min:6', 'max:6', Rule::unique('discounts')->ignore($this->id)],
            'name'              => ['required', 'string', 'max:100', Rule::unique('discounts')->ignore($this->id)],
            'percentage'        => ['required', 'numeric'],
            'expiration_date'   => ['nullable', 'date']
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
}
