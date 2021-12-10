<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Support\Facades\Auth;
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

	public function store(Request $request, RequestModel $requestmodel){
		$data = $request->all();

		if($requestmodel->status != 'PA' && $requestmodel->status != 'RE'){
			return json_encode([
				'result' => false,
				'message' => 'Este pedido já foi pago ou está sendo análisado!'
			]);
		}

		$user = Auth::user();

		if($user){
			switch($data['type']){
				case 0:		//CREDIT
					$cpf = str_ireplace(['.', ' ', '-'], '', $data['cpf']);

					$installments = explode('x', $data['installments']);
					$birth = $data['month'] . '/' . $data['year'];

					$phone = str_ireplace(['(', ')', ' ', '-'], '', $data['phone']);
					$phoneAreaCode = substr($phone, 0, 2);
					$phoneNumber = substr($phone, 2);

					$response = $this->payment->credit($user, $requestmodel, $data['senderHash'], $data['cardToken'], $installments[0], $installments[1], 2, $data['name'], $cpf, $birth, $phoneAreaCode, $phoneNumber);

					return json_encode($this->payment->errors()[0]->getMessage());
					break;
				case 1:		// DEBIT
					break;
				case 2:		// BOLET
					break;
				default:
					return json_encode([
						'result' => false,
						'message' => 'O meio de pagamento selecionado é inválido!'
					]);
			}
		}

		return json_encode([
			'result' => false,
			'message' => 'Você deve estar logado para executar esta operação!'
		]);
	}
}