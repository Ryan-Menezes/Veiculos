@extends('templates.site')

@section('title', 'Carrinho')

@section('content')
<!-- Breadcrumb End -->
<div class="breadcrumb-option set-bg" data-setbg="{{ asset('assets/images/site/breadcrumb-bg.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h1>Carrinho</h1>
                    <div class="breadcrumb__links">
                        <a href="{{ route('site') }}" title="Página Inicial"><i class="fa fa-home"></i> Início</a>
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
            <div class="col-md-12">
                @if($errors->any())
                    <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p class="p-0 m-0">{{ $error }}</p>
                    @endforeach
                    </div>
                @endif
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
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td><img class="image rounded border image-table" src="{{ asset('storage/' . $product['vehicle']->images()->first()->image) }}" title="{{ $product['vehicle']->brand | $product['vehicle']->model }}" alt="{{ $product['vehicle']->brand | $product['vehicle']->model }}"></td>
                            <td>
                                <form method="POST" action="{{ route('site.cart.edit', $product['vehicle']) }}" class="row">
                                    @csrf
                                    @method('PUT')
                                    <input class="form-control col-md-8" type="number" name="quantity" min="1" max="{{ $product['vehicle']->quantity }}" value="{{ $product['quantity'] }}">
                                    <button type="submit" class="btn btn-sm btn-dark col-md-4"><i class="fa fa-repeat"></i></button>
                                </form>
                            </td>
                            <td>{{ $product['vehicle']->brand }}</td>
                            <td>{{ $product['vehicle']->model }}</td>
                            <td>{{ $product['vehicle']->year }}</td>
                            <td>{{ $product['vehicle']->mileage }}</td>
                            @if($product['vehicle']->promotion)
                            <td>{{ $product['vehicle']->promotionFormat }}</td>
                            @else
                            <td>{{ $product['vehicle']->priceFormat }}</td>
                            @endif
                            <td>
                                <a href="{{ route('site.cart.remove', $product['vehicle']) }}" class="btn btn-sm btn-danger" title="Remover veículo do carrinho"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10"><p class="p-0 m-0 text-center">CARRINHO VÁZIO!</p></td>
                        </tr>
                        @endforelse

                        @if(count($products) > 0)
                        <tr>
                            <td colspan="10"><p class="p-0 text-right"><strong>TOTAL: </strong>R$ {{ $amount }}</p></td>
                        </tr>
                        @endif
                    </tbody>
                </table>

                @if(count($products) > 0)
                <form action="{{ route('site.requests.store') }}" method="POST" class="row">
                    @csrf
                    @method('PUT')
                    <div class="col-md-8">
                        <label class="form-label"><strong>DESCONTO: </strong></label>
                        <input type="text" name="discount" placeholder="Insira um código de desconto(Opcional)" class="form-control p-4" style="max-width: 500px;">
                    </div>
                    <div class="col-md-4 pos-end">
                        <a href="{{ route('site.cart.clear') }}" class="btn primary-btn text-white bg-dark" title="Limpar Carrinho">Limpar Carrinho</a>
                        <button type="submit" class="btn primary-btn text-white ml-1">Finalizar Pedido</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- Car Section End -->
@endsection