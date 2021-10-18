<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;

class DetailsController extends Controller
{
    public function index(string $slug){
    	$vehicle = Vehicle::where('slug', $slug)->firstOrFail();

    	return view('site.details.index', compact('vehicle'));
    }
}
