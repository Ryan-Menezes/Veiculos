<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Site\ContactFormRequest;
use Illuminate\Http\Request;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function index(){
    	return view('site.contact.index');
    }

    public function send(ContactFormRequest $request){
    	$request->validated();

    	Mail::to(config('mail.from.address'))->send(new ContactMail($request->name, $request->email, $request->subject, $request->message));

		return redirect()->route('site.contact')->with('result', [
			'success' => true,
			'message' => 'Sua mensagem foi enviada com sucesso, Em breve entraremos em contato!'
		]);
    }
}
