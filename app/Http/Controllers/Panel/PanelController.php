<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{
	User,
	Vehicle,
	Discount,
	Manufacturer,
    Category,
	Request as RequestModel,
	Role,
	Permission
};

class PanelController extends Controller
{
    public function index(){
    	$data = [
            'title'                 => 'Início',
    		'amountUsers' 			=> User::count(),
            'amountMyRequests'      => RequestModel::where('user_id', Auth::user()->id)->count(),
    		'amountVehicles' 		=> Vehicle::count(),
    		'amountManufacturers' 	=> Manufacturer::count(),
            'amountCategories'      => Category::count(),
    		'amountDiscounts' 		=> Discount::count(),
    		'amountRequests' 		=> RequestModel::count(),
    		'amountRoles' 			=> Role::count(),
    		'amountPermissions' 	=> Permission::count()
    	];

    	return view('panel.index', $data);
    }
}
