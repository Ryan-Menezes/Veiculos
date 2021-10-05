<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{
	User,
	Vehicle,
	Discount,
	Manufacture,
	Request as RequestVeh,
	Role,
	Permission,
	Category
};

class PanelController extends Controller
{
    public function index(){
    	return view('panel.index');
    }
}
