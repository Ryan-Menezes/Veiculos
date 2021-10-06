<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$prefixes = ['view', 'create', 'edit', 'delete'];
    	$models = ['users', 'vehicles', 'categories', 'discounts', 'requests', 'manufacturers', 'roles', 'permissions'];

    	foreach($prefixes as $prefix):
    		foreach($models as $model):
		        Permission::create([
		        	'name' => $prefix . '.' . $model,
		        	'description' => $prefix . ' ' . $model
		        ]);
		    endforeach;
    	endforeach;
    }
}
