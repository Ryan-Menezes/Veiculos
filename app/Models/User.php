<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public $columns = ['ID', 'Imagem', 'Nome', 'E-Mail', 'Criado em', 'Atualizado em', 'Ações'];
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
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

    public function roles(){
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function requests(){
        return $this->hasMany(Request::class);
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
        if(!is_null($this->image)) return asset('assets/images/anonimo.png');

        return asset('assets/images/anonimo.png');
    }

    public function adminlte_desc(){
        return $this->email;
    }
}
