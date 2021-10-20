<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes\Cart;
use App\Models\Vehicle;

class CartController extends Controller
{
	private $cart;

	public function __construct(Cart $cart){
		$this->cart = $cart;
	}

    public function index(){
    	$products = $this->cart->all();
    	$amount = number_format($this->cart->amount(), 2, ',', '.');
    	
    	return view('site.cart.index', compact('products', 'amount'));
    }

    public function add(Vehicle $vehicle){
    	$this->cart->add($vehicle);

    	return json_encode([
    		'success' => true,
    		'message' => 'Veículo adicionado ao carrinho com sucesso!'
    	]);
    }

    public function edit(Request $request, Vehicle $vehicle){
    	$request->validate([
    		'quantity' => 'required|numeric|min:0|max:' . $vehicle->quantity
    	]);

    	$this->cart->set($vehicle, $request->quantity, $vehicle->price);

    	return redirect()->back();
    }

    public function remove(Vehicle $vehicle){
    	$this->cart->remove($vehicle->id);

    	return redirect()->back();
    }

    public function clear(){
    	$this->cart->clear();

    	return redirect()->back();
    }
}
