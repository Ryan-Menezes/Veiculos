<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Payment;
use App\Models\Request as RequestModel;

class PaymentController extends Controller{
	private $payment;
	private $requestmodel;

	public function __construct(RequestModel $requestmodel){
		$this->payment = new Payment(config('payment.token.sandbox'), config('payment.email'), true);
		$this->requestmodel = $requestmodel;
	}

	public function notification(Request $request){
		$data = $request->all();

		$transaction = $this->payment->notification($data->notificationCode);

		if($transaction){
			// $this->requestmodel->status = '';
			// $this->requestmodel->save();
		}
	}

	public function store(Request $request){
		dd($request->all());
	}
}