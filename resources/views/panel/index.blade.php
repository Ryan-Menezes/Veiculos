@extends('adminlte::page')

@section('title_postfix', $title)

@section('content_header')
	<div class="content-header p-0">
	    <div class="container-fluid p-3 bg-white border rounded">
            <ol class="breadcrumb">
              	<li class="breadcrumb-item"><a href="{{ route('panel') }}">Painel</a></li>
            </ol>
	    </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="row">
        {{-- MY REQUESTS --}}
        <x-panel.card title="Meus Pedidos" content="{{ $amountMyRequests }}" route="panel.myrequests" icon="fas fa-list-alt" class="bg-orange"/>

      	{{-- USERS --}}
        <x-panel.card title="Usuários" content="{{ $amountUsers }}" route="panel.users" can="view.users" icon="fas fa-users" class="bg-info"/>

        {{-- VEHICLES --}}
        <x-panel.card title="Veículos" content="{{ $amountVehicles }}" route="panel.vehicles" can="view.vehicles" icon="fas fa-car" class="bg-danger"/>

        {{-- MANUFACTURERS --}}
        <x-panel.card title="Fabricantes" content="{{ $amountManufacturers }}" route="panel.manufacturers" can="view.manufacturers" icon="fas fa-industry" class="bg-pink"/>

        {{-- CATEGORIES --}}
        <x-panel.card title="Categorias" content="{{ $amountCategories }}" route="panel.categories" can="view.categories" icon="fas fa-tags" class="bg-purple"/>

        {{-- DISCOUNTS --}}
        <x-panel.card title="Descontos" content="{{ $amountDiscounts }}" route="panel.discounts" can="view.discounts" icon="fas fa-percent" class="bg-warning"/>

        {{-- REQUESTS --}}
        <x-panel.card title="Pedidos" content="{{ $amountRequests }}" route="panel.requests" can="view.requests" icon="fas fa-list-alt" class="bg-dark"/>

        {{-- ROLES --}}
        <x-panel.card title="Funções" content="{{ $amountRoles }}" route="panel.roles" can="view.roles" icon="fas fa-user-tag" class="bg-success"/>

        {{-- PERMISSIONS --}}
        <x-panel.card title="Permissões" content="{{ $amountPermissions }}" route="panel.permissions" can="view.permissions" icon="fas fa-lock" class="bg-primary"/>
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