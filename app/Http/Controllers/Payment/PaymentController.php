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
		$this->payment = new Payment(config('payment.token.live'), config('payment.email'));
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

					if(!empty($this->payment->errors())){
						return json_encode([
							'result' => false,
							'message' => 'Não fopi possível efetuar o pagamento, Ocorreu um erro no processo!'
						]);
					}

					$requestmodel->status = 'PE';
					$requestmodel->save();

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
							'message' => 'Não foi possível efetuar o pagamento, Ocorreu um erro no processo!'
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