@extends('templates.site')

@section('title', 'Início')

@section('content')
<!-- Hero Section Begin -->
<section class="hero spad set-bg" data-setbg="{{ asset('assets/images/site/hero-bg.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="hero__text">
                    <div class="hero__text__title">
                        <span>ENCONTRE O CARRO DOS SEUS SONHOS</span>
                        <h2>Os melhores veículos para você!</h2>
                    </div>
                    <a href="#" class="primary-btn">Entre em Contato</a>
                    <a href="#" class="primary-btn more-btn">Saiba mais sobre nós</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="hero__tab">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="hero__tab__form">
                                <h2>ENCONTRE O CARRO DOS SEUS SONHOS</h2>
                                <form action="{{ route('site.vehicles.search') }}" method="POST" id="form-filter">
                                    @csrf
                                    <div class="select-list">
                                        <div class="select-list-item">
                                            <p>Ano</p>
                                            <select name="year">
                                                <option value="" data-display="Ano">Todos</option>
                                                @foreach($years as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="select-list-item">
                                            <p>Marca</p>
                                            <select name="brand">
                                                <option value="" data-display="Marca">Todos</option>
                                                @foreach($brands as $brand)
                                                <option value="{{ $brand }}">{{ $brand }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="select-list-item">
                                            <p>Modelo</p>
                                            <select name="model">
                                                <option value="" data-display="Modelo">Todos</option>
                                                @foreach($models as $model)
                                                <option value="{{ $model }}">{{ $model }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="select-list-item">
                                            <p>Quilometragem:</p>
                                            <select name="mileage">
                                                <option value="" data-display="Quilometragem">Todos</option>
                                                @foreach($mileages as $mileage)
                                                <option value="{{ $mileage }}">{{ $mileage }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="car-price">
                                        <p>Faixa de Preço:</p>
                                        <div class="price-range-wrap">
                                            <div class="price-range"></div>
                                            <div class="range-slider">
                                                <div class="price-input">
                                                    <input type="text" id="amount" name="price">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="site-btn">Buscar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Services Section Begin -->
<section class="services spad pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Nossos Serviços</span>
                    <h2>O que oferecemos</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="services__item">
                    <img src="{{ asset('assets/images/site/services/services-2.png') }}" alt="">
                    <h5>Compra de Veículos</h5>
                    <p>Consectetur adipiscing elit incididunt ut labore et dolore magna aliqua. Risus commodo
                        viverra maecenas.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="services__item">
                    <img src="{{ asset('assets/images/site/services/services-3.png') }}" alt="">
                    <h5>Manutenção dos Veículos</h5>
                    <p>Consectetur adipiscing elit incididunt ut labore et dolore magna aliqua. Risus commodo
                        viverra maecenas.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="services__item">
                    <img src="{{ asset('assets/images/site/services/services-4.png') }}" alt="">
                    <h5>Suporte 24 Horas</h5>
                    <p>Consectetur adipiscing elit incididunt ut labore et dolore magna aliqua. Risus commodo
                        viverra maecenas.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->

<!-- Car Section Begin -->
<section class="car spad pt-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Nossos Veículos</span>
                    <h2>Melhores Ofertas de Veículos</h2>
                </div>
            </div>
        </div>
        <div class="row car-filter mt-4">
            @foreach($vehicles as $vehicle)
            <div class="col-lg-3 col-md-4 col-sm-6 mix sale">
                <div class="car__item">
                    <div class="car__item__pic__slider owl-carousel">
                        @foreach($vehicle->images as $image)
                            <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $vehicle->brand }}">
                            @if($loop->index > 2)
                                @break
                            @endif
                        @endforeach
                    </div>
                    <div class="car__item__text">
                        <div class="car__item__text__inner">
                            <div class="label-date">{{ $vehicle->year }}</div>
                            <h5><a href="{{ route('site.vehicles.show', $vehicle->slug) }}">{{ $vehicle->brand }}</a></h5>
                            <ul>
                                <li><span>{{ $vehicle->ports }}</span> porta(s)</li>
                                <li>{{ $vehicle->model }}</li>
                                <li><span>{{ $vehicle->mileage }}</span> km</li>
                            </ul>
                        </div>
                        <div class="car__item__price loading">
                            @if($vehicle->quantity > 0)
                            <span 
                                class="car-option sale load-ajax-click"
                                data-url="{{ route('site.cart.add', $vehicle) }}"
                                data-method="GET"
                                data-loading="true"
                                data-remove="false"
                                data-messagebox="true"
                            ><i class="fa fa-shopping-cart"></i></span>
                            @else
                            <span class="car-option sale">Indisponível</span>
                            @endif
                            <h6>R$ {{ $vehicle->priceFormat }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Car Section End -->

<!-- Cta Begin -->
<div class="cta">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="cta__item set-bg" data-setbg="{{ asset('assets/images/site/cta/cta-1.jpg') }}">
                    <h4>Você quer comprar um carro</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="cta__item set-bg" data-setbg="{{ asset('assets/images/site/cta/cta-2.jpg') }}">
                    <h4>Do You Want To Rent A Car</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cta End -->
@endsection