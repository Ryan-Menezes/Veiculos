<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    public $uploadDir = 'vehicles';
    public $timestamps = true;
    public $columns = ['ID', 'Imagem', 'Marca', 'Modelo', 'Ano', 'Criado em', 'Atualizado em', 'Ações'];
    protected $fillable = ['manufacturer_id', 'brand', 'slug', 'model', 'year', 'ports', 'price', 'promotion', 'mileage', 'quantity', 'release_date', 'promotion_date', 'status', 'description'];

    // VALIDATES

    public function validateCreate(array $data){
        $roles = [
            'brand'             => ['required', 'string', 'max:100'],
            'model'             => ['required', 'max:100'],
            'year'              => ['required', 'numeric'],
            'ports'             => ['required', 'numeric'],
            'price'             => ['required', 'numeric'],
            'promotion'         => ['nullable', 'numeric'],
            'mileage'           => ['required', 'numeric'],
            'quantity'          => ['required', 'numeric'],
            'release_date'      => ['nullable', 'date'],
            'promotion_date'    => ['nullable', 'date'],
            'status'            => ['required', 'in:D,I'],
            'description'       => ['required', 'string'],
            'images'            => ['required', 'mime:image/*'],
            'categories'        => ['required']
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
            'brand'             => ['required', 'string', 'max:100'],
            'model'             => ['required', 'max:100'],
            'year'              => ['required', 'numeric'],
            'ports'             => ['required', 'numeric'],
            'price'             => ['required', 'numeric'],
            'promotion'         => ['nullable', 'numeric'],
            'mileage'           => ['required', 'numeric'],
            'quantity'          => ['required', 'numeric'],
            'release_date'      => ['nullable', 'date'],
            'promotion_date'    => ['nullable', 'date'],
            'status'            => ['required', Rule::in(['D', 'I'])],
            'description'       => ['required', 'string'],
            'images'            => ['mime:image/*'],
            'categories'        => ['required']
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
                    ->orWhere('brand', 'LIKE', "%{$search}%")
                    ->orWhere('model', 'LIKE', "%{$search}%")
                    ->orWhere('year', 'LIKE', "%{$search}%")
                    ->orWhere('price', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('created_at', 'LIKE', "%{$search}%")
                    ->orWhere('updated_at', 'LIKE', "%{$search}%")
                    ->offset($offset)
                    ->limit($limit)
                    ->get();
    }

    // ATTRIBUTES

    public function getCreatedAtFormatAttribute(){
        return date('d/m/Y H:i:s', strtotime($this->created_at));
    }

    public function getUpdatedAtFormatAttribute(){
        return date('d/m/Y H:i:s', strtotime($this->updated_at));
    }

    // RELATIONS

    public function images(){
    	return $this->hasMany(Image::class);
    }

    public function manufacturer(){
    	return $this->belongsTo(Manufacturer::class);
    }

    public function categories(){
    	return $this->belongsToMany(Category::class, 'vehicle_categories');
    }
}
