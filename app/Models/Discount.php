<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Discount extends Model
{
    use HasFactory;

    public $table = 'discounts';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = 'code';
    protected $keyType = 'string';
    protected $casts = ['code' => 'string'];
    protected $fillable = ['code', 'percentage', 'expiration_date'];
    public $columns = ['Codigo', 'Porcentagem', 'Data de Expiração', 'Ações'];

    // VALIDATES

    public function validateCreate(array $data){
        $roles = [
            'code'              => ['required', 'max:20', 'unique:discounts'],
            'percentage'        => ['required', 'numeric', 'min:1', 'max:100'],
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
            'code'              => ['required', 'max:20', Rule::unique('discounts')->ignore($this->code, 'code')],
            'percentage'        => ['required', 'numeric', 'min:1', 'max:100'],
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

    // SCOPES

    public function scopeSearch($query, $search, $offset, $limit){
        return $query
                    ->where('code', 'LIKE', "%{$search}%")
                    ->orWhere('percentage', 'LIKE', "%{$search}%")
                    ->orWhere('expiration_date', 'LIKE', "%{$search}%")
                    ->orderBy('code', 'DESC')
                    ->offset($offset)
                    ->limit($limit)
                    ->get();
    }

    // ATTRIBUTES

    public function getExpirationDateFormatAttribute(){
        if(empty($this->expiration_date)) return null;

        return date('d/m/Y H:i:s', strtotime($this->expiration_date));
    }  
}
