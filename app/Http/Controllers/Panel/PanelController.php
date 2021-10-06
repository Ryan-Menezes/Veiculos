<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{
	User,
	Vehicle,
	Discount,
	Manufacturer,
	Request as RequestVeh,
	Role,
	Permission,
	Category
};

class PanelController extends Controller
{
    public function index(){
    	$data = [
    		'amountUsers' 			=> User::count(),
    		'amountVehicles' 		=> Vehicle::count(),
    		'amountManufacturers' 	=> Manufacturer::count(),
    		'amountDiscounts' 		=> Discount::count(),
    		'amountRequests' 		=> RequestVeh::count(),
    		'amountRoles' 			=> Role::count(),
    		'amountPermissions' 	=> Permission::count(),
    		'amountCategories' 		=> Category::count()
    	];

    	return view('panel.index', $data);
    }
}
