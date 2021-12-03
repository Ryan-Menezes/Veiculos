@extends('templates.site')

@section('title', 'Veículos')

@section('content')
<!-- Breadcrumb End -->
<div class="breadcrumb-option set-bg" data-setbg="{{ asset('assets/images/site/breadcrumb-bg.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h1>Veículos</h1>
                    <div class="breadcrumb__links">
                        <a href="{{ route('site') }}" title="Página Inicial"><i class="fa fa-home"></i> Início</a>
                        <span>Veículos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Begin -->

<!-- Car Section Begin -->
<section class="car spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="car__sidebar">
                    <div class="car__search">
                        <h2>Pesquisa</h2>
                        <form action="javascript:void(0)">
                            <input type="text" placeholder="Perquisar..." name="search" form="form-filter">
                            <button type="submit" form="form-filter"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="car__filter">
                        <h2>Filtro</h2>
                        <form action="{{ route('site.vehicles.search') }}" method="POST" id="form-filter">
                            @csrf
                            <select name="year">
                                <option value="" data-display="Ano">Todos</option>
                                @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                            <select name="brand">
                                <option value="" data-display="Marca">Todos</option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand }}">{{ $brand }}</option>
                                @endforeach
                            </select>
                            <select name="model">
                                <option value="" data-display="Modelo">Todos</option>
                                @foreach($models as $model)
                                <option value="{{ $model }}">{{ $model }}</option>
                                @endforeach
                            </select>
                            <select name="mileage">
                                <option value="" data-display="Quilometragem">Todos</option>
                                @foreach($mileages as $mileage)
                                <option value="{{ $mileage }}">{{ $mileage }}</option>
                                @endforeach
                            </select>
                            <select name="manufacturer">
                                <option value="" data-display="Fabricante">Todos</option>
                                @foreach($manufacturers as $manufacturer)
                                <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                                @endforeach
                            </select>
                            <select name="ports">
                                <option value="" data-display="Portas">Todas</option>
                                @foreach($ports as $port)
                                <option value="{{ $port }}">{{ $port }}</option>
                                @endforeach
                            </select>
                            <select name="category">
                                <option value="" data-display="Categoria">Todos</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="filter-price">
                                <p>Preço:</p>
                                <div class="price-range-wrap">
                                    <div class="filter-price-range"></div>
                                    <div class="range-slider">
                                        <div class="price-input">
                                            <input type="text" id="filterAmount" name="price">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="car__filter__btn">
                                <button type="submit" class="site-btn">Filtrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    @foreach($vehicles as $vehicle)
                    <div class="col-lg-4 col-md-4">
                        <div class="car__item">
                            <div class="car__item__pic__slider owl-carousel">
                                @foreach($vehicle->images as $image)
                                    <img src="{{ asset('storage/' . $image->image) }}" title="{{ $vehicle->brand | $vehicle->model }}" alt="{{ $vehicle->brand | $vehicle->model }}">
                                    @if($loop->index > 2)
                                        @break
                                    @endif
                                @endforeach
                            </div>
                            <div class="car__item__text">
                                <div class="car__item__text__inner">
                                    <div class="label-date">{{ $vehicle->year }}</div>
                                    <h3><a href="{{ route('site.vehicles.show', $vehicle->slug) }}" title="{{ $vehicle->brand | $vehicle->model }}">{{ $vehicle->brand }}</a></h3>
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
                                    
                                    @if($vehicle->promotion)
                                    <h4 class="pl-5 ml-4">R$ {{ $vehicle->promotionFormat }}</h4>
                                    @else
                                    <h4 class="pl-5 ml-4">R$ {{ $vehicle->priceFormat }}</h4>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @if($vehicles->hasPages())
                <nav aria-label="Page navigation example">
                    <div class="pagination__option">
                        <a href="{{ $vehicles->nextPageUrl() }}" title="Página Anterior"><span class="arrow_carrot-2left"></span></a>
                        @for($i = 1; $i <= $vehicles->lastPage(); $i++)
                            @if($vehicles->currentPage() == $i)
                            <a href="javascript:void(0)" class="active" title="Página {{ $i }}">{{ $i }}</a>
                            @else
                            <a href="{{ $vehicles->url($i) }}" title="Página {{ $i }}">{{ $i }}</a>
                            @endif
                        @endfor
                        <a href="{{ $vehicles->previousPageUrl() }}" title="Próxima Página"><span class="arrow_carrot-2right"></span></a>
                    </div>
                </nav>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- Car Section End -->
@endsection