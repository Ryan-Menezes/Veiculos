<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;
    public $columns = ['ID', 'Imagem', 'Marca', 'Modelo', 'Ano', 'Criado em', 'Atualizado em', 'Ações'];
    protected $fillable = ['manufacturer_id', 'brand', 'slug', 'model', 'year', 'ports', 'price', 'promotion', 'mileage', 'quantity', 'release_date', 'promotion_date', 'status', 'description'];

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

    public function colors(){
    	return $this->belongsToMany(Color::class);
    }

    public function manufacturer(){
    	return $this->belongsTo(Manufacturer::class);
    }

    public function categories(){
    	return $this->belongsToMany(Category::class);
    }
}
