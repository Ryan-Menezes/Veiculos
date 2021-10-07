@extends('adminlte::page')

@section('title_postfix', 'Início')

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
      	{{-- USERS --}}
      	@can('view.users')
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
  	            <div class="inner">
  	                 <h3>{{ $amountUsers }}</h3>

  	             	   <p>Usuários</p>
  	            </div>
              	<div class="icon">
                	   <i class="fas fa-users"></i>
              	</div>
              	<a href="{{ route('panel.users') }}" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endcan

          {{-- VEHICLES --}}
      	@can('view.vehicles')
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $amountVehicles }}</h3>

                 	  <p>Veículos</p>
                </div>
              	<div class="icon">
                	 <i class="fas fa-car"></i>
              	</div>
              	<a href="#" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endcan

          {{-- DISCOUNTS --}}
      	@can('view.discounts')
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $amountDiscounts }}</h3>

                 	  <p>Descontos</p>
                </div>
              	<div class="icon">
                	 <i class="fas fa-percent"></i>
              	</div>
              	<a href="#" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endcan

          {{-- REQUESTS --}}
      	@can('view.requests')
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
                <div class="inner">
                    <h3>{{ $amountRequests }}</h3>

                 	  <p>Pedidos</p>
                </div>
              	<div class="icon">
                	 <i class="fas fa-list-alt"></i>
              	</div>
                <a href="#" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endcan

          {{-- ROLES --}}
      	@can('view.roles')
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $amountRoles }}</h3>

                 	  <p>Funções</p>
                </div>
                <div class="icon">
                  	<i class="fas fa-user-tag"></i>
                </div>
                <a href="#" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endcan

          {{-- USERS --}}
      	@can('view.permissions')
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                  <h3>{{ $amountPermissions }}</h3>

               	  <p>Permissões</p>
              </div>
            	<div class="icon">
              	  <i class="fas fa-lock"></i>
            	</div>
            	<a href="#" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endcan
    </div>
@stop

@section('css')
	  <link rel="stylesheet" href="{{ asset('assets/js/libs/jquery/jquery-ui/jquery-ui.min.css') }}">
	  <link rel="stylesheet" href="{{ asset('assets/js/libs/jquery/jquery-ui/jquery-ui.theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/libs/jquery/jquery-ui/jquery-ui.structure.min.css') }}">
@stop

@section('js')
   	<script type="text/javascript" src="{{ asset('assets/js/libs/jquery/jquery.min.js') }}"></script>
   	<script type="text/javascript" src="{{ asset('assets/js/libs/jquery/jquery-ui/jquery-ui.min.js') }}"></script>

   	<script type="text/javascript" src="{{ asset('assets/js/config-jquery-ui.js') }}"></script>
@stop