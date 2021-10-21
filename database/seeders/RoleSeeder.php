<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    Role,
    Permission
};

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$roles = [ 
            'usage' => [],
            'manager' => [
                'users'         => ['view', 'create', 'edit', 'delete'],
                'vehicles'      => ['view', 'create', 'edit', 'delete'],
                'categories'    => ['view', 'create', 'edit', 'delete'],
                'discounts'     => ['view', 'create', 'edit', 'delete'],
                'requests'      => ['view', 'create', 'edit', 'delete'],
                'manufacturers' => ['view', 'create', 'edit', 'delete']
            ], 
            'administrator' => [
                'users'         => ['view', 'create', 'edit', 'delete'],
                'vehicles'      => ['view', 'create', 'edit', 'delete'],
                'categories'    => ['view', 'create', 'edit', 'delete'],
                'discounts'     => ['view', 'create', 'edit', 'delete'],
                'requests'      => ['view', 'create', 'edit', 'delete'],
                'manufacturers' => ['view', 'create', 'edit', 'delete'],
                'roles'         => ['view', 'create', 'edit', 'delete'],
                'permissions'   => ['view', 'create', 'edit', 'delete']
            ]
        ];

    	foreach($roles as $role => $permissions):
	        $role = Role::create([
	        	'name' => $role,
			    'description' => $role
	        ]);

            if(!is_null($role)):
                foreach($permissions as $table => $verbs):
                    foreach($verbs as $verb):
                        $permission = Permission::where('name', $verb . '.' . $table)->first();

                        if(!is_null($permission)) $role->permissions()->attach($permission->id);
                    endforeach; 
                endforeach;              
            endif;
	    endforeach;
    }
}
