<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'description'];

    // VALIDATES

    public function validateCreate(array $data){
        $roles = [
            'name'          => ['required', 'string', 'max:100', 'unique:roles'],
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
            'name'          => ['required', 'string', 'max:100', Rule::unique('roles')->ignore($this->id)],
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

    public function permissions(){
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }
}
