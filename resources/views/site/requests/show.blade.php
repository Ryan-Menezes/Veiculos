@extends('templates.site')

@section('title', 'Pedido - ' . $request->id)

@section('content')
<!-- Breadcrumb End -->
<div class="breadcrumb-option set-bg" data-setbg="{{ asset('assets/images/site/breadcrumb-bg.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h1>Pedido - {{ $request->id }}</h1>
                    <div class="breadcrumb__links">
                        <a href="{{ route('site') }}" title="Página Inicial"><i class="fa fa-home"></i> Início</a>
                        <a href="javascript:void(0)" title="Pedidos">Pedidos</a>
                        <span>Carrinho</span>
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
            <div class="col-md-12 mb-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Total(R$)</th>
                            <th>Desconto(R$)</th>
                            <th>Status</th>
                            <th>Criado em</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $request->priceFormat }}</td>
                            <td>{{ $request->discountFormat }}</td>
                            <td>{{ $request->statusFormat }}</td>
                            <td>{{ $request->createdAtFormat }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <h2 class="mb-3">Veículos</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Imagem</th>
                            <th>Qtde</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Ano</th>
                            <th>Quilometragem</th>
                            <th>Preço(R$)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($request->vehicles()->distinct('vehicles.id')->get() as $vehicle)
                        <tr>
                            <td><img class="image rounded border image-table" src="{{ asset('storage/' . $vehicle->firstImage()) }}" title="{{ $vehicle->brand | $vehicle->model }}" alt="{{ $vehicle->brand | $vehicle->model }}"></td>
                            <td>{{ $vehicle->qtdeRequest($request->id) }}</td>
                            <td>{{ $vehicle->brand }}</td>
                            <td>{{ $vehicle->model }}</td>
                            <td>{{ $vehicle->year }}</td>
                            <td>{{ $vehicle->mileage }}</td>
                            <td>{{ $vehicle->priceFormat }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($request->status === 'PA')
            <div class="col-md-12">
                <form action="#" method="POST" class="row">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12 pos-end">
                        <button type="submit" class="btn primary-btn text-white ml-1"><i class="fa fa-money"></i> Pagar</button>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
</section>
<!-- Car Section End -->
@endsection