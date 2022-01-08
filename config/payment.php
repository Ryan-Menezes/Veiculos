<?php

return [
	'mode' => 'sandbox',
	'token' => [
		'live' => env('PAYMENT_TOKEN_LIVE', ''),
		'sandbox' => env('PAYMENT_TOKEN_SANDBOX', '')
	],
	'email' => env('PAYMENT_EMAIL', ''),
];