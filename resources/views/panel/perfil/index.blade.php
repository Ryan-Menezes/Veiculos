@extends('adminlte::page')

@section('title_postfix', $title)

@section('content_header')
	<div class="content-header p-0">
	    <div class="container-fluid p-3 bg-white border rounded">
            <ol class="breadcrumb">
              	<li class="breadcrumb-item"><a href="{{ route('panel') }}">Painel</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('panel.perfil') }}">Perfil</a></li>
            </ol>
	    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('content')
<div class="content m-1 p-0">
    <div class="row">
        <div class="col-md-7">
            {!! Form::model($user, ['method' => 'PUT', 'route' => 'panel.perfil.user.update', 'class' => 'form col-md-12 m-0 form-validate load-ajax-form-submit p-4 bg-white rounded border', 'files' => true]) !!}
              <h4>Dados de Perfil</h4><hr>

              <x-form.inputfile title="Imagem" name="image" accept="image/*" id="image"/>
              <x-form.inputtext title="Nome" name="name" value="{{ $user->name }}" placeholder="Nome" id="name" class="required" maxlength="191"/>

              <div class="row">
                  <div class="col-md-6">
                      <x-form.inputtext title="CPF" name="cpf" value="{{ $user->cpf }}" placeholder="CPF" id="cpf" class="required cpf-mask"/>
                  </div>
                  <div class="col-md-6">
                      <x-form.inputtext title="Telefone" name="phone" value="{{ $user->phone }}" placeholder="Telefone" id="phone" class="required phone-mask"/>
                  </div>
              </div>

              <x-form.inputemail title="E-Mail" name="email" value="{{ $user->email }}" placeholder="E-Mail" id="email" class="required email" maxlength="191"/>
              <x-form.inputsubmit value="Salvar" class="btn-danger"/>
            {!! Form::close() !!}
        </div>
        <div class="col-md-5">
            {!! Form::model($user, ['method' => 'PUT', 'route' => 'panel.perfil.user.update.password', 'class' => 'form col-md-12 m-0 form-validate load-ajax-form-submit clear-form p-4 bg-white rounded border', 'files' => true]) !!}
              <h4>Alterar Senha</h4><hr>

              <x-form.inputpassword title="Senha Atual" name="password" value="{{ $user->name }}" placeholder="Senha Atual" id="password" class="required" maxlength="191"/>
              <x-form.inputpassword title="Novo Senha" name="newpassword" value="{{ $user->name }}" placeholder="Nova Senha" id="newpassword" class="required" maxlength="191"/>
              <x-form.inputpassword title="Repetir Novo Senha" name="rnewpassword" value="{{ $user->name }}" placeholder="Repetir Nova Senha" id="rnewpassword" class="required" maxlength="191"/>
              <x-form.inputsubmit value="Salvar" class="btn-danger"/>
            {!! Form::close() !!}
        </div>
    </div>
</div> 
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/libs/jquery/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/libs/jquery/jquery-ui/jquery-ui.theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/libs/jquery/jquery-ui/jquery-ui.structure.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/panel/style.css') }}">
@stop

@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/libs/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/libs/jquery/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/libs/jquery/jquery-form-validate/dist/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/libs/jquery/jquery.maskedinput-master/dist/jquery.maskedinput.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/config-jquery-mask.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/config-jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/config-ajax.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/panel/main.js') }}"></script>
@stop