<?php
namespace App\Classes;

use App\Models\Request as RequestModel;
use App\Models\User;
use Exception;

class Payment{
	private $url;
	private $post;
	private $header;
	private $data;
	private $token;
	private $email;
	private $sandbox;
	private $errors;

	public function __construct(string $token, string $email, bool $sandbox = false){
		$this->post = false;
		$this->header = null;
		$this->data = [];
		$this->token = $token;
		$this->email = $email;
		$this->sandbox = $sandbox;
		$this->errors = [];
	}

	private function curl(){
		try{
			$curl = curl_init($this->url);

			if($this->header)
				curl_setopt($curl, CURLOPT_HTTPHEADER, $this->header);

			if($this->post){
				curl_setopt($curl, CURLOPT_POST, $this->post);

				if(!empty($this->data))
					curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($this->data));
			}
			
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			$response = curl_exec($curl);
			curl_close($curl);

			return $response;
		}catch(Exception $error){
			$this->errors[] = $error;
		}

		return null;
	}

	public function errors() : array{
		return $this->errors;
	}

	public function startSession() : ?string{
		$this->post = true;
		$this->url = "https://ws.pagseguro.uol.com.br/v2/sessions?email={$this->email}&token={$this->token}";

		if($this->sandbox)
			$this->url = "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions?email={$this->email}&token={$this->token}";

		$this->header = ['Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1'];

		try{
			$response = $this->curl();
			
			if($response != 'Unauthorized')
				return simplexml_load_string($response)->id;

			throw new Exception($response);
		}catch(Exception $error){
			$this->errors[] = $error;
		}

		return null;
	}

	private function checkout(RequestModel $request){
		$index = 1;
		foreach($request->vehicles()->distinct('vehicles.id')->get() as $vehicle){
			$this->data["itemId{$index}"] = $vehicle->id;
			$this->data["itemDescription{$index}"] = "{$vehicle->brand} | {$vehicle->model} | {$vehicle->year}";
			$this->data["itemAmount{$index}"] = $vehicle->price;
			$this->data["itemQuantity{$index}"] = $vehicle->qtdeRequest($request->id);
			$index++;
		}

		$this->post = true;
		$this->url = "https://ws.pagseguro.uol.com.br/v2/transactions?email={$this->email}&token={$this->token}";

		if($this->sandbox)
			$this->url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions?email={$this->email}&token={$this->token}";

		$this->header = ['Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1'];

		try{
			$response = $this->curl();

			if($response != 'Unauthorized'){
				$xml = simplexml_load_string($response);

				if($xml->error)
					throw new Exception($xml->error->message);

				return $xml;
			}
			
			throw new Exception($response);
		}catch(Exception $error){
			$this->errors[] = $error;
		}

		return null;
	}

	public function bolet(User $user, RequestModel $request, string $senderHash){
		$this->data = [
			'paymentMode' 				=> 'default',
			'paymentMethod' 			=> 'boleto',
			'receiverEmail' 			=> config('app.email'),
			'currency' 					=> 'BRL',
			'extraAmount' 				=> '0.00',
			'notificationURL' 			=> route('payment.notification'),
			'reference' 				=> $request->id,
			'senderName' 				=> $user->name,
			'senderCPF' 				=> $user->cpf,
			'senderAreaCode'			=> mb_substr($user->phone, 0, 2),
			'senderPhone' 				=> mb_substr($user->phone, 2),
			'senderEmail' 				=> $user->email,
			'senderHash' 				=> $senderHash,
			'shippingAddressRequired' 	=> false
		];

		return $this->checkout($request);
	}

	public function debit(User $user, RequestModel $request, string $senderHash){
		$this->data = [
			'paymentMode' 				=> 'default',
			'paymentMethod' 			=> 'boleto',
			'bankName'					=> 'itau',
			'receiverEmail' 			=> config('app.email'),
			'currency' 					=> 'BRL',
			'extraAmount' 				=> '0.00',
			'notificationURL' 			=> route('payment.notification'),
			'reference' 				=> $request->id,
			'senderName' 				=> $user->name,
			'senderCPF' 				=> $user->cpf,
			'senderAreaCode'			=> mb_substr($user->phone, 0, 2),
			'senderPhone' 				=> mb_substr($user->phone, 2),
			'senderEmail' 				=> $user->email,
			'senderHash' 				=> $senderHash,
			'shippingAddressRequired' 	=> false
		];

		return $this->checkout($request);
	}

	public function credit(User $user, RequestModel $request, string $senderHash, string $cardToken, int $installmentQuantity, float $installmentValue, int $noInterestInstallmentQuantity, string $creditCardHolderName, string $creditCardHolderCPF, string $creditCardHolderBirthDate, string $creditCardHolderAreaCode, string $creditCardHolderPhone){
		$this->data = [
			'paymentMode' 						=> 'default',
			'paymentMethod' 					=> 'boleto',
			'receiverEmail' 					=> config('app.email'),
			'currency' 							=> 'BRL',
			'extraAmount' 						=> '0.00',
			'notificationURL' 					=> route('payment.notification'),
			'reference' 						=> $request->id,
			'senderName' 						=> $user->name,
			'senderCPF' 						=> $user->cpf,
			'senderAreaCode'					=> mb_substr($user->phone, 0, 2),
			'senderPhone' 						=> mb_substr($user->phone, 2),
			'senderEmail' 						=> $user->email,
			'senderHash' 						=> $senderHash,
			'shippingAddressRequired' 			=> false,
			'creditCardToken' 					=> $cardToken,
			'installmentQuantity'				=> $installmentQuantity,
			'installmentValue' 					=> $installmentValue,
			'noInterestInstallmentQuantity' 	=> $noInterestInstallmentQuantity,
			'creditCardHolderName' 				=> $creditCardHolderName,
			'creditCardHolderCPF' 				=> $creditCardHolderCPF,
			'creditCardHolderBirthDate' 		=> $creditCardHolderBirthDate,
			'creditCardHolderAreaCode' 			=> $creditCardHolderAreaCode,
			'creditCardHolderPhone'				=> $creditCardHolderPhone
		];

		return $this->checkout($request);
	}

	public function cancel($transactionCode) : bool{
		$this->post = true;
		$this->data = [
			'transactionCode' => $transactionCode
		];

		$this->url = "https://ws.pagseguro.uol.com.br/v2/transactions/cancels?email={$this->email}&token={$this->token}";

		if($this->sandbox)
			$this->url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/cancels?email={$this->email}&token={$this->token}";

		$this->header = ['Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1'];

		try{
			$response = $this->curl();

			if($response != 'Unauthorized'){
				$xml = simplexml_load_string($response);

				if($xml->error)
					throw new Exception($xml->error->message);

				return true;
			}
			
			throw new Exception($response);
		}catch(Exception $error){
			$this->errors[] = $error;
		}

		return false;
	}

	public function refund($transactionCode, float $transactionValue) : bool{
		$this->post = true;
		$this->data = [
			'transactionCode' => $transactionCode,
			'transactionValue' => $transactionValue
		];

		$this->url = "https://ws.pagseguro.uol.com.br/v2/transactions/refunds?email={$this->email}&token={$this->token}";

		if($this->sandbox)
			$this->url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/refunds?email={$this->email}&token={$this->token}";

		$this->header = ['Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1'];

		try{
			$response = $this->curl();

			if($response != 'Unauthorized'){
				$xml = simplexml_load_string($response);

				if($xml->error)
					throw new Exception($xml->error->message);

				return true;
			}
			
			throw new Exception($response);
		}catch(Exception $error){
			$this->errors[] = $error;
		}

		return false;
	}

	public function notification($notificationCode) : ?StdClass{
		$this->post = false;
		$this->data = [];

		$this->url = "https://ws.pagseguro.uol.com.br/v3/transactions/notifications/{$notificationCode}?email={$this->email}&token={$this->token}";

		if($this->sandbox)
			$this->url = "https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/{$notificationCode}?email={$this->email}&token={$this->token}";

		$this->header = ['Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1'];

		try{
			$response = $this->curl();

			if($response != 'Unauthorized'){
				$xml = simplexml_load_string($response);

				if(!$xml->code)
					throw new Exception('Consulta Inválida!');

				return $xml;
			}
			
			throw new Exception($response);
		}catch(Exception $error){
			$this->errors[] = $error;
		}

		return null;
	}
}