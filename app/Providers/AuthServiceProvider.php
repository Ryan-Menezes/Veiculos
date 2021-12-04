<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate;
use App\Models\{
    User,
    Role,
    Permission,
    Request
};
use App\Policies\RequestPolicy;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Request::class => RequestPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        if(Schema::hasTable('permissions')){
            $this->registerPolicies($gate);

            $permissions = Permission::with('roles')->get();
            foreach($permissions as $permission):
                $gate->define($permission->name, function(User $user) use($permission){
                    return $user->hasPermission($permission);
                });
            endforeach;
        }
    }
}
