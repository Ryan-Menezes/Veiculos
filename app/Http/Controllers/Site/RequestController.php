<?php

namespace App\Http\Controllers\Site;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes\{
    Cart,
    Payment
};
use App\Models\{
	Request as RequestModel,
	Vehicle,
	Discount
};
use Gate;

class RequestController extends Controller
{
    private $requestmodel;
    private $cart;

    public function __construct(RequestModel $requestmodel, Cart $cart){
    	$this->requestmodel = $requestmodel;
    	$this->cart = $cart;
    }

    public function store(Request $request){
    	// Verifica se o carrinho não está vázio
    	if(empty($this->cart->all())):
    		return redirect()->route('site.cart')->withErrors(['É necessário que seu carrinho contenha pelo menos um veículo para finalizar o pedido!']);
    	endif;

    	// Dados do pedido
    	$user = Auth::user();
    	$cart = $this->cart->all();
    	$amount = $this->cart->amount();
    	$discount_price = 0;
    	$discount = Discount::where('code', $request->discount)->first();
    	$vehicles = [];

    	// Verifica se o usuário digitou algum disconto
    	if(!is_null($discount)) $discount_price = $amount * ($discount->percentage / 100);

    	// Cria o pedido
    	$requestNew = $this->requestmodel->create([
    		'user_id'	=> $user->id,
    		'price' 	=> $amount,
    		'discount' 	=> $discount_price,
    		'status'	=> 'PA'
    	]);

    	// Busca os veículos do pedido
    	foreach($cart as $c):
    		for($i = 0; $i < $c['quantity']; $i++):
    			array_push($vehicles, $c['vehicle']->id);
    		endfor;
    	endforeach;

    	// Cadastra os veículos do pedido e limpa o carrinho
    	$requestNew->vehicles()->attach($vehicles);
    	$this->cart->clear();

    	return redirect()->route('site.requests.show', ['requestmodel' => $requestNew]);
    }

    public function show(RequestModel $requestmodel){
    	if(Gate::denies('request-user', $requestmodel)) abort(404);

        $sandbox = config('payment.mode') == 'sandbox' ? true : false;
        $payment = new Payment(config('payment.token.' . config('payment.mode')), config('payment.email'), $sandbox);
        $sessionId = $payment->startSession();

    	return view('site.requests.show', ['request' => $requestmodel, 'sessionId' => $sessionId]);
    }
}
