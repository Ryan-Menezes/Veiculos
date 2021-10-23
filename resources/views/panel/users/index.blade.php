@extends('adminlte::page')

@section('title_postfix', $title)

@section('content_header')
	<div class="content-header p-0">
	    <div class="container-fluid p-3 bg-white border rounded">
            <ol class="breadcrumb">
              	<li class="breadcrumb-item"><a href="{{ route('panel') }}">Painel</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('panel.users') }}">Usuários</a></li>
            </ol>
	    </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    {{-- MODALS --}}
    <x-modal.editcreate class="form-edit" title="Editar Usuário"/>
    <x-modal.delete title="Deletar" message="Deseja deletar este usuário?" id="delete"/>

    {{-- TABLE USERS --}}
    @component('components.table.table', [
      'title' => $title, 
      'columns' => $columns, 
      'btnnew' => false, 
      'container' => 'table-users-body',
      'route' => 'panel.users.load'
    ]) @endcomponent
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