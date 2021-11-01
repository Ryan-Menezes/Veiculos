<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Request extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = ['user_id', 'price', 'discount', 'status'];
    public $columns = ['ID', 'Preço(R$)', 'Desconto(R$)', 'Status', 'Criado em', 'Atualizado em', 'Ações'];
    public $statusCol = [
        'PA' => 'AGUARDANDO PAGAMENTO',
        'PE' => 'PENDENTE',
        'AC' => 'ACEITO',
        'RE' => 'RECUSADO',
        'CA' => 'CANCELADO',
        'CO' => 'CONCLUIDO'
    ];

    // VALIDATES

    public function validateUpdate(array $data){
        $roles = [
            'status' => ['required', Rule::in(['PA', 'PE', 'AC', 'RE', 'CO', 'CA'])]
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

    public function scopeSearch($query, $search, $offset, $limit, $id = null){
        if(!is_null($query)):
            $query->where('user_id', $id);
        endif;

        return $query
                    ->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('price', 'LIKE', "%{$search}%")
                    ->orWhere('discount', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%")
                    ->orWhere('created_at', 'LIKE', "%{$search}%")
                    ->orWhere('updated_at', 'LIKE', "%{$search}%")
                    ->orderBy('id', 'DESC')
                    ->offset($offset)
                    ->limit($limit)
                    ->get();
    }

    // ATTRIBUTES

    public function getStatusFormatAttribute(){
        if(!array_key_exists($this->status, $this->statusCol)) return null;

        return $this->statusCol[$this->status];
    }

    public function getPriceFormatAttribute(){
        if(empty($this->price)) return number_format(0, 2, ',', '.');

        return number_format($this->price, 2, ',', '.');
    }

    public function getDiscountFormatAttribute(){
        if(empty($this->discount)) return number_format(0, 2, ',', '.');;

        return number_format($this->discount, 2, ',', '.');
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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function vehicles(){
        return $this->belongsToMany(Vehicle::class, 'request_vehicles');
    }
}
