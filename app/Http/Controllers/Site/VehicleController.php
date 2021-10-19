<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
	Vehicle,
	Category,
	Manufacturer
};

class VehicleController extends Controller
{
	private $vehicle;
	private $amountPage = 20;

	public function __construct(Vehicle $vehicle){
		$this->vehicle = $vehicle;
	}

	public function index(){
		$vehicles = $this->vehicle->paginate($this->amountPage);
		$ports = range(1, 10);
    	$years = array_combine(range(1901, date('Y')), range(1901, date('Y')));
    	$mileages = range(1, $this->vehicle->max('mileage'));
    	$brands = $this->vehicle->distinct('brand')->pluck('brand', 'brand')->all();
    	$models = $this->vehicle->distinct('model')->pluck('model', 'model')->all();
    	$categories = Category::all();
    	$manufacturers = Manufacturer::all();

		return view('site.vehicles.index', compact('vehicles', 'years', 'mileages', 'brands', 'models', 'ports', 'categories', 'manufacturers'));
	}

	public function search(Request $request){
		$filter = $request->except('_token');
		$vehicles = $this->vehicle->filter($this->amountPage, $filter);
		$vehicles->appends($filter);

		$ports = range(1, 10);
    	$years = array_combine(range(1901, date('Y')), range(1901, date('Y')));
    	$mileages = range(1, $this->vehicle->max('mileage'));
    	$brands = $this->vehicle->distinct('brand')->pluck('brand', 'brand')->all();
    	$models = $this->vehicle->distinct('model')->pluck('model', 'model')->all();
    	$categories = Category::all();
    	$manufacturers = Manufacturer::all();

		return view('site.vehicles.index', compact('vehicles', 'years', 'mileages', 'brands', 'models', 'ports', 'categories', 'manufacturers', 'filter'));
	}

    public function show(string $slug){
    	$vehicle = $this->vehicle->where('slug', $slug)->firstOrFail();

    	return view('site.vehicles.show', compact('vehicle'));
    }
}
