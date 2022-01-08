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
	private $status = [
		1 => 'PA',
		2 => 'PA',
		3 => 'AC',
		4 => 'AC',
		5 => 'PA',
		6 => 'CA',
		7 => 'CA'
	];

	public function __construct(RequestModel $requestmodel){
		$sandbox = config('payment.mode') == 'sandbox' ? true : false;

		$this->payment = new Payment(config('payment.token.' . config('payment.mode')), config('payment.email'), $sandbox);
		$this->requestmodel = $requestmodel;
	}

	public function notification(Request $request){
		$data = $request->all();

		$transaction = (object)$this->payment->notification($data['notificationCode']);

		if($transaction){
			$requestmodel  = $this->requestmodel->find($transaction->reference);

			$status = $transaction->status;
					
			if(isset($this->status[$status])){
				$requestmodel->status = $this->status[$status];
				$requestmodel->save();
			}
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

					if(!empty($this->payment->errors())){
						return json_encode([
							'result' => false,
							'message' => 'Não foi possível efetuar o pagamento, Ocorreu um erro no processo!'
						]);
					};

					$status = ((array)$response->status)[0];
					
					if(isset($this->status[$status])){
						$requestmodel->status = $this->status[$status];
						$requestmodel->save();
					}
					
					return json_encode([
						'result' => true,
						'message' => 'Pagamento efetuado com sucesso!',
						'response' => $response
					]);
					break;
				case 1:		// DEBIT
					$response = $this->payment->debit($user, $requestmodel, $data['senderHash'], $data['bank']);

					if(!empty($this->payment->errors())){
						return json_encode([
							'result' => false,
							'message' => 'Não foi possível efetuar o pagamento, Ocorreu um erro no processo!'
						]);
					}

					return json_encode([
						'result' => true,
						'message' => '<a href="' . $response->paymentLink . '" title="Pagar Online" target="_blank">Clique aqui finalizar o pagamento</a> por débito online',
						'response' => $response
					]);
					break;
				case 2:		// BOLET
					$response = $this->payment->bolet($user, $requestmodel, $data['senderHash']);

					if(!empty($this->payment->errors())){
						return json_encode([
							'result' => false,
							'message' => 'Não foi possível gerar o seu boleto, Ocorreu um erro no processo!'
						]);
					}

					return json_encode([
						'result' => true,
						'message' => 'Boleto gerado com sucesso, <a href="' . $response->paymentLink . '" title="Imprimir Boleto" target="_blank">Clique aqui para imprimir o seu boleto!</a>',
						'response' => $response
					]);
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