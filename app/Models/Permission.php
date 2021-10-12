<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Permission extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'description'];

    // VALIDATES

    public function validateCreate(array $data){
        $roles = [
            'name'          => ['required', 'string', 'max:100', 'unique:permissions'],
            'description'   => ['required', 'string']
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
            'name'          => ['required', 'string', Rule::unique('permissions')->ignore($this->id)],
            'description'   => ['required', 'string']
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

    // RELATIONS

    public function roles(){
    	return $this->belongsToMany(Role::class, 'role_permissions');
    }
}
