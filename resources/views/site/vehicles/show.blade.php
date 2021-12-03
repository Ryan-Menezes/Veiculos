@extends('templates.site')

@section('title', $vehicle->brand)

@section('content')
<!-- Breadcrumb End -->
<div class="breadcrumb-option set-bg" data-setbg="{{ asset('assets/images/site/breadcrumb-bg.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h1>{{ $vehicle->brand }}</h1>
                    <div class="breadcrumb__links">
                        <a href="{{ route('site') }}" title="Página Inicial"><i class="fa fa-home"></i> Início</a>
                        <a href="{{ route('site.vehicles') }}" title="Página de Veículos">Veículos</a>
                        <span>{{ $vehicle->brand }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Begin -->

<!-- Car Details Section Begin -->
<section class="car-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="car__details__pic">
                    <div class="car__details__pic__large">
                        <img class="car-big-img" src="{{ asset('storage/' . $vehicle->firstImage()) }}" title="{{ $vehicle->brand | $vehicle->model }}" alt="{{ $vehicle->brand | $vehicle->model }}">
                    </div>
                    <div class="car-thumbs">
                        <div class="car-thumbs-track car__thumb__slider owl-carousel">
                            @foreach($vehicle->images as $image)
                            <div class="ct" data-imgbigurl="{{ asset('storage/' . $image->image) }}"><img src="{{ asset('storage/' . $image->image) }}" title="{{ $vehicle->brand | $vehicle->model }}" alt="{{ $vehicle->brand | $vehicle->model }}"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="car__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" title="Descrição do Veículo">Descrição</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active px-2" id="tabs-1" role="tabpanel">
                            <p>{!! $vehicle->descriptionFormat !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="car__details__sidebar">
                    <div class="car__details__sidebar__model">
                        <ul>
                            <li>Estoque(unidades) <span>{{ $vehicle->quantity }}</span></li>
                            <li>Quilometragem(km) <span>{{ $vehicle->mileage }}</span></li>
                        </ul>
                    </div>
                    <div class="car__details__sidebar__payment">
                        <ul>
                            <li>Modelo <span>{{ $vehicle->model }}</span></li>
                            <li>Portas <span>{{ $vehicle->ports }}</span></li>
                            <li>Ano <span>{{ $vehicle->year }}</span></li>
                            
                            @if($vehicle->promotion)
                            <li>De <span style="text-decoration: line-through;">R${{ $vehicle->priceFormat }}</span></li>
                            <li>Para <span>R${{ $vehicle->promotionFormat }}</span></li>
                            @else
                            <li>Preço <span>R${{ $vehicle->priceFormat }}</span></li>
                            @endif
                        </ul>
                        <div class="loading">
                            <a href="javascript:void(0)" 
                                class="primary-btn sidebar-btn load-ajax-click w-100"
                                data-url="{{ route('site.cart.add', $vehicle) }}"
                                data-method="GET"
                                data-loading="true"
                                data-remove="false"
                                data-messagebox="true"
                                title="Adicionar ao carrinho"
                            ><i class="fa fa-shopping-cart"></i> Adicionar ao Carrinho</a>
                        </div>
                        
                        <a href="{{ route('site.vehicles.buy', $vehicle->slug) }}" class="primary-btn" title="Comprar Veículo"><i class="fa fa-money"></i> Comprar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Car Details Section End -->
@endsection