@extends('templates.site')

@section('title', 'Pedido - ' . $request->id)

@section('content')
<section class="modalLoading" style="display: none;">
    <div class="loader"></div>
</section>

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
            <div class="col-md-12 mt-5 p-4 border" id="paymentMethods">
                <div class="row">
                    <div class="col-md-4" id="credit-card-method">
                        <p class="mb-3"><strong>Cartão de Crédito</strong></p>
                    </div>
                    <div class="col-md-4" id="online-debit-method">
                         <p class="mb-3"><strong>Débito Online</strong></p>
                    </div>
                    <div class="col-md-4" id="bolet-method">
                         <p class="mb-3"><strong>Boleto</strong></p>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-5">
                <form action="{{ route('payment.store', $request->id) }}" method="POST" class="row p-4 border form-validate" id="formPayment">
                    @csrf
                    <input type="hidden" name="sessionId" id="sessionId" value="{{ $sessionId }}">
                    <input type="hidden" name="amountPrice" id="amountPrice" value="{{ $request->price }}">
                    <input type="hidden" name="cardToken" id="cardToken">
                    <input type="hidden" name="senderHash" id="senderHash">

                    <div class="col-md-4">
                        <x-form.inputselect id="typePayment" title="Tipo de Pagamento" name="type" :options="['Cartão de Crédito', 'Débito Online', 'Boleto']" class="w-100 notniceselect"/>
                    </div>

                    <div class="col-md-4" style="display: none;">
                        <x-form.inputselect id="bank" title="Banco" name="bank" :options="[]" class="w-100 notniceselect debit"/>
                    </div>

                    <div class="col-md-4">
                        <x-form.inputtext title="Nome do Dono do Cartão" name="name" placeholder="Nome do Dono do Cartão" class="card required"/>
                    </div>

                    <div class="col-md-4">
                        <x-form.inputtext title="CPF do Dono do Cartão" name="cpf" placeholder="CPF do Dono do Cartão" class=" cpf-mask card"/>
                    </div>

                    <div class="col-md-4">
                        <x-form.inputtext title="Telefone" name="phone" placeholder="Telefone" class="card required phone-mask"/>
                    </div>

                    <div class="col-md-4">
                        <x-form.inputtext title="Número do Cartão" name="cardNumber" id="cardNumber" placeholder="Número do Cartão" class="card required cardnumber-mask"/>
                    </div>

                    <div class="col-md-4">
                        <x-form.inputtext title="CVV" name="cvv" placeholder="CVV" class="card required" maxlength="3"/>
                    </div>

                    <div class="col-md-4">
                        <x-form.inputnumber title="Mês de Validade" name="month" placeholder="Mês de Validade" min="1" max="12" class="card required"/>
                    </div>

                    <div class="col-md-4">
                        <x-form.inputnumber title="Ano de Validade" name="year" placeholder="Ano de Validade" min="{{ date('Y') }}" max="{{ 9999 }}" class="card required"/>
                    </div>

                    <div class="col-md-4">
                        <x-form.inputselect title="Parcelas" name="installments" id="installments" :options="[]" class="w-100 card notniceselect"/>
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

@section('scripts')
    @if(config('payment.mode') == 'sandbox')
    <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    @else
    <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    @endif

    <script type="text/javascript" src="{{ asset('assets/js/site/payment.js') }}"></script>
@endsection