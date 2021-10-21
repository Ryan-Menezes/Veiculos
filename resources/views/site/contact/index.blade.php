@extends('templates.site')

@section('title', 'Contato')

@section('content')
<!-- Breadcrumb End -->
<div class="breadcrumb-option set-bg" data-setbg="{{ asset('assets/images/site/breadcrumb-bg.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Contato</h2>
                    <div class="breadcrumb__links">
                        <a href="{{ route('site') }}"><i class="fa fa-home"></i> Início</a>
                        <span>Contato</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Begin -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <div class="section-title">
                        <h2>Entre em contato conosco</h2>
                        <p>Informe no formulário suas dúvidas e perguntas e em breve responderemos</p>
                    </div>
                    <ul>
                        <li><span>Weekday</span> 08:00 am to 18:00 pm</li>
                        <li><span>Saturday:</span> 10:00 am to 16:00 pm</li>
                        <li><span>Sunday:</span> Closed</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                @if($errors->any())
                    <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p class="p-0 m-0">{{ $error }}</p>
                    @endforeach
                    </div>
                @endif
                @if(session('result'))
                    <div class="alert alert-{{ (session('result')['success'] ? 'success' : 'danger') }}">
                    {{ session('result')['message'] }}
                    </div>
                @endif
                <div class="contact__form">
                    <form action="{{ route('site.contact.send') }}" method="POST" class="form-validate">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <input type="text" placeholder="Nome" name="name" class="mb-0 required" value="{{ old('name') }}">
                            </div>
                            <div class="col-lg-6 mb-4">
                                <input type="text" placeholder="E-Mail" name="email" class="mb-0 required email" value="{{ old('email') }}">
                            </div>
                        </div>
                        <input type="text" placeholder="Assunto" name="subject" class="mb-0 required" value="{{ old('subject') }}">
                        <textarea placeholder="Sua mensagem" name="message" class="mt-4 m-0 required">{{ old('message') }}</textarea>
                        <button type="submit" class="site-btn mt-4">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->
@endsection