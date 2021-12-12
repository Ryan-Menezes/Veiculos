<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public $timestamps = true;
    public $uploadDir = 'users';
    public $columns = ['ID', 'Imagem', 'Nome', 'E-Mail', 'Criado em', 'Atualizado em', 'Ações'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'cpf',
        'phone',
        'password',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // VALIDATES

    public function validateUpdate(array $data){
        $roles = [
            'name'          => ['required', 'string', 'max:191'],
            'cpf'           => ['required', 'min:11', 'max:11', Rule::unique('users')->ignore($this->id)],
            'phone'         => ['required', 'min:10', 'max:10', Rule::unique('users')->ignore($this->id)],
            'email'         => ['required', 'string', 'email', 'max:191', Rule::unique('users')->ignore($this->id)],
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

    public function validateUpdatePassword(array $data){
        $roles = [
            'newpassword'      => ['required', 'min:8']
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
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('created_at', 'LIKE', "%{$search}%")
                    ->orWhere('updated_at', 'LIKE', "%{$search}%")
                    ->orderBy('id', 'DESC')
                    ->offset($offset)
                    ->limit($limit)
                    ->get();
    }

    // ATTRIBUTES

    public function getCreatedAtFormatAttribute(){
        if(empty($this->created_at)) return null;

        return date('d/m/Y H:i:s', strtotime($this->created_at));
    }

    public function getUpdatedAtFormatAttribute(){
        if(empty($this->updated_at)) return null;

        return date('d/m/Y H:i:s', strtotime($this->updated_at));
    }

    public function getImageFormatAttribute(){
        if(!is_null($this->image)) return asset('storage/' . $this->image);

        return asset('assets/images/anonimo.png');
    }

    // RELATIONS

    public function roles(){
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function requests(){
        return $this->belongsToMany(Request::class, 'request_vehicles');
    }

    // ACL

    public function hasPermission(Permission $permission) : bool{
        return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles) : bool{
        if(is_array($roles) || is_object($roles)):
            return (bool) $roles->intersect($this->roles)->count();
        endif;

        return $this->roles->contains('name', $roles);
    }

    // AdminLTE

    public function adminlte_image(){
       return $this->imageFormat;
    }

    public function adminlte_desc(){
        return $this->email;
    }
}
