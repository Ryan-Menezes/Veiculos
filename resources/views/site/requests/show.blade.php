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
                            @if($vehicle->promotion)
                            <td>{{ $vehicle->promotionFormat }}</td>
                            @else
                            <td>{{ $vehicle->priceFormat }}</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($request->status === 'PA')
            <div class="col-md-12 mt-5">
                <form action="#" method="POST" class="row p-4 border form-validate">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4">
                        <x-form.inputselect title="Tipo de Pagamento" name="type" :options="['Cartão de Crédito', 'Débito Online', 'Boleto']" class="w-100"/>
                    </div>

                    <div class="col-md-4">
                        <x-form.inputtext title="CPF do Dono do Cartão" name="cpf" placeholder="CPF do Dono do Cartão" class="required cpf-mask"/>
                    </div>

                    <div class="col-md-4">
                        <x-form.inputtext title="Número do Cartão" name="cardNumber" placeholder="Número do Cartão" class="required cardnumber-mask"/>
                    </div>

                    <div class="col-md-4">
                        <x-form.inputtext title="CVV" name="cvv" placeholder="CVV" class="required" maxlength="3"/>
                    </div>

                    <div class="col-md-4">
                        <x-form.inputnumber title="Mês de Validade" name="month" placeholder="Mês de Validade" min="1" max="12" class="required"/>
                    </div>

                    <div class="col-md-4">
                        <x-form.inputnumber title="Ano de Validade" name="year" placeholder="Ano de Validade" min="{{ date('Y') }}" max="{{ 9999 }}" class="required"/>
                    </div>

                    <div class="col-md-12">
                        <x-form.inputselect title="Parcelas" name="instaltment" :options="['Selecione uma Parcela']" class="w-100"/>
                    </div>

                    <div class="col-md-12 mt-4 pos-end">
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