<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Manufacturer extends Model
{
    use HasFactory;

    public $uploadDir = 'manufacturers';
    public $timestamps = false;
    public $columns = ['ID', 'Imagem', 'Nome', 'Ações'];
    protected $fillable = ['name', 'image'];

    // VALIDATES

    public function validateCreate(array $data){
        $roles = [
            'name'          => ['required', 'string', 'max:100', 'unique:manufacturers'],
            'image'         => ['required', 'mimes:jpeg,jpg,gif,bmp,png']
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
            'name'          => ['required', 'string', 'max:100', Rule::unique('manufacturers')->ignore($this->id)],
            'image'         => ['mimes:jpeg,jpg,gif,bmp,png']
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

    // SCOPES

    public function scopeSearch($query, $search, $offset, $limit){
        return $query
                    ->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->offset($offset)
                    ->limit($limit)
                    ->get();
    }

    // RELATIONS

    public function vehicles(){
    	return $this->hasMany(Vehicle::class);
    }
}
