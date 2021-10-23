<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;

class SiteController extends Controller
{
    public function index(){
    	$vehicles = Vehicle::verify()->orderBy('price', 'ASC')->limit(8)->with('images')->get();
    	$years = array_combine(range(1901, date('Y')), range(1901, date('Y')));
    	$mileages = range(1, Vehicle::max('mileage'));
    	$brands = Vehicle::distinct('brand')->pluck('brand', 'brand')->all();
    	$models = Vehicle::distinct('model')->pluck('model', 'model')->all();

    	return view('site.index', compact('vehicles', 'years', 'mileages', 'brands', 'models'));
    }
}
