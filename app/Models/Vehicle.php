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

    protected $table = 'vehicles';
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
            'ports'             => ['required', 'numeric', 'min:1'],
            'price'             => ['required', 'numeric'],
            'promotion'         => ['nullable', 'numeric'],
            'mileage'           => ['required', 'numeric', 'min:1'],
            'quantity'          => ['required', 'numeric', 'min:1'],
            'release_date'      => ['nullable', 'date'],
            'promotion_date'    => ['nullable', 'date'],
            'status'            => ['required', Rule::in(['D', 'I'])],
            'description'       => ['required', 'string'],
            'images'            => ['required'/*, 'mimes:jpeg,jpg,gif,bmp,png'*/],
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
            'ports'             => ['required', 'numeric', 'min:1'],
            'price'             => ['required', 'numeric'],
            'promotion'         => ['nullable', 'numeric'],
            'mileage'           => ['required', 'numeric', 'min:1'],
            'quantity'          => ['required', 'numeric', 'min:1'],
            'release_date'      => ['nullable', 'date'],
            'promotion_date'    => ['nullable', 'date'],
            'status'            => ['required', Rule::in(['D', 'I'])],
            'description'       => ['required', 'string'],
            // 'images'            => ['mimes:jpeg,jpg,gif,bmp,png'],
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
                    ->orderBy('id', 'DESC')
                    ->offset($offset)
                    ->limit($limit)
                    ->get();
    }

    public function scopeVerify($query){
        return $query
                    ->where('status', 'D')
                    ->whereNull('release_date');
    }

    public function scopeFilter($query, int $limit, array $data = []){
        $search = $data['search'] ?? null;
        $year = $data['year'] ?? null;
        $brand = $data['brand'] ?? null; 
        $model = $data['model'] ?? null; 
        $mileage = $data['mileage'] ?? null;
        $ports = $data['ports'] ?? null;
        $manufacturer = $data['manufacturer'] ?? null;
        $category = $data['category'] ?? null;
        $price = isset($data['price']) ? str_ireplace(['[', ']', 'R', '$', ' '], '', $data['price']) : '-';
        $min = explode('-', $price)[0];
        $max = explode('-', $price)[1];
        $table = $this->table;

        $query->select(["{$table}.*"]);

        // YEAR FILTER
        if(!empty($year) || strlen($year) > 0):
            $query->where("{$table}.year", $year);
        elseif(!empty($search) || strlen($search) > 0):
            $query->orWhere("{$table}.year", 'LIKE', "%{$search}%");
        endif;

        // BRAND FILTER
        if(!empty($brand) || strlen($brand) > 0):
            $query->where("{$table}.brand", $brand);
        elseif(!empty($search) || strlen($search) > 0):
            $query->orWhere("{$table}.brand", 'LIKE', "%{$search}%");
        endif;

        // MODEL FILTER
        if(!empty($model) || strlen($model) > 0):
            $query->where("{$table}.model", $brand);
        elseif(!empty($search) || strlen($search) > 0):
            $query->orWhere("{$table}.model", 'LIKE', "%{$search}%");
        endif;

        // MILEAGE FILTER
        if(!empty($mileage) || strlen($mileage) > 0):
            $query->where("{$table}.mileage", $mileage);
        elseif(!empty($search) || strlen($search) > 0):
            $query->orWhere("{$table}.mileage", 'LIKE', "%{$search}%");
        endif;

        // PORTS FILTER
        if(!empty($ports) || strlen($ports) > 0):
            $query->where("{$table}.ports", $ports);
        elseif(!empty($search) || strlen($search) > 0):
            $query->orWhere("{$table}.ports", 'LIKE', "%{$search}%");
        endif;

        // MANUFACTURER FILTER
        if(!empty($manufacturer) || strlen($manufacturer) > 0):
            $query
                ->join('manufacturers', 'manufacturers.id', '=', "{$table}.manufacturer_id")
                ->where('manufacturers.id', $manufacturer);
        elseif(!empty($search) || strlen($search) > 0):
            $query
                ->join('manufacturers', 'manufacturers.id', '=', "{$table}.manufacturer_id")
                ->orWhere('manufacturers.name', 'LIKE', "%{$search}%");
        endif;

        // CATEGORY FILTER
        if(!empty($category) || strlen($category) > 0):
            $query
                ->join('vehicle_categories', 'vehicle_categories.vehicle_id', '=', "{$table}.id")
                ->where('vehicle_categories.category_id', $category);
        // elseif(!empty($search) || strlen($search) > 0):
        //     $query
        //         ->join('vehicle_categories', 'vehicle_categories.vehicle_id', '=', "{$table}.id")
        //         ->join('categories', 'categories.id', '=', "vehicle_categories.category_id")
        //         ->orWhere('categories.name', 'LIKE', "%{$search}%");
        endif;

        // PRICE FILTER
        if(!empty($price) || strlen($price) > 0):
            $query->whereBetween('price', [$min, $max]);
        endif;

        // SEARCH
        if(!empty($search) || strlen($search) > 0):
            $query->orWhere('description', 'LIKE', "%{$search}%");
        endif;

        return $query
                    ->verify()
                    ->orderBy('id', 'DESC')
                    ->paginate($limit);
    }

    public function scopeFirstImage($query){
        return $this
                    ->images()
                    ->first()
                    ->image;
    }

    public function scopeQtdeRequest($query, $id){
        return $this
                    ->requests
                    ->find($id)
                    ->vehicles()
                    ->where('vehicle_id', $this->id)
                    ->count('*');
    }

    // ATTRIBUTES

    public function getDescriptionFormatAttribute(){
        return str_ireplace("\n", '<br>', $this->description);
    }

    public function getPriceFormatAttribute(){
        if(empty($this->price)) return number_format(0, 2, ',', '.');

        return number_format($this->price, 2, ',', '.');
    }

    public function getPromotionFormatAttribute(){
        if(empty($this->promotion)) return number_format(0, 2, ',', '.');

        return number_format($this->promotion, 2, ',', '.');
    }

    public function getReleaseDateFormatAttribute(){
        if(empty($this->release_date)) return null;

        return date('d/m/Y H:i:s', strtotime($this->release_date));
    }

    public function getPromotionDateFormatAttribute(){
        if(empty($this->promotion_date)) return null;

        return date('d/m/Y H:i:s', strtotime($this->promotion_date));
    }

    public function getCreatedAtFormatAttribute(){
        if(empty($this->created_at)) return null;

        return date('d/m/Y H:i:s', strtotime($this->created_at));
    }

    public function getUpdatedAtFormatAttribute(){
        if(empty($this->updated_at)) return null;

        return date('d/m/Y H:i:s', strtotime($this->updated_at));
    }

    // RELATIONS

    public function images(){
    	return $this->hasMany(Image::class);
    }

    public function manufacturer(){
    	return $this->belongsTo(Manufacturer::class);
    }

    public function requests(){
        return $this->belongsToMany(Request::class, 'request_vehicles');
    }

    public function categories(){
    	return $this->belongsToMany(Category::class, 'vehicle_categories');
    }
}
