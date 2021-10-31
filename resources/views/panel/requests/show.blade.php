<div style="min-width: 100%;">
	<h3>Pedido {{ $requestmodel->id }}</h3>
	<table class="table table-hover">
		<thead>
			<tr>
				<th><small>Preço(R$)</small></th>
				<th><small>Desconto(R$)</small></th>
				<th><small>Status</small></th>
				<th><small>Criado em</small></th>
				<th><small>Atualizado em</small></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><small>{{ $requestmodel->priceFormat }}</small></td>
				<td><small>{{ $requestmodel->discountFormat }}</small></td>
				<td><small>{{ $requestmodel->statusFormat }}</small></td>
				<td><small>{{ $requestmodel->createdAtFormat }}</small></td>
				<td><small>{{ $requestmodel->updatedAtFormat }}</small></td>
			</tr>
		</tbody>
	</table>

	<h3>Usuário</h3>
	<table class="table table-hover">
		<thead>
			<tr>
				<th><small>ID</small></th>
				<th><small>Imagem</small></th>
				<th><small>Nome</small></th>
				<th><small>E-Mail</small></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><small>{{ $requestmodel->user->id }}</small></td>
				<td><img class="image rounded border image-table" src="{{ asset($requestmodel->user->imageFormat) }}"></td>
				<td><small>{{ $requestmodel->user->name }}</small></td>
				<td><small>{{ $requestmodel->user->email }}</small></td>
			</tr>
		</tbody>
	</table>

	<h3>Veículo(s)</h3>
	<table class="table table-hover">
		<thead>
			<tr>
				<th><small>ID</small></th>
				<th><small>Imagem</small></th>
				<th><small>Qtde</small></th>
				<th><small>Marca</small></th>
				<th><small>Modelo</small></th>
				<th><small>Quilometragem</small></th>
				<th><small>Preço(R$)</small></th>
			</tr>
		</thead>
		<tbody>
			@foreach($requestmodel->vehicles()->distinct('vehicles.id')->get() as $vehicle)
			<tr>
				<td><small>{{ $vehicle->id }}</small></td>
				<td><img class="image rounded border image-table" src="{{ asset('storage/' . $vehicle->firstImage()) }}"></td>
				<td><small>{{ $vehicle->qtdeRequest($requestmodel->id) }}</small></td>
				<td><small>{{ $vehicle->brand }}</small></td>
				<td><small>{{ $vehicle->model }}</small></td>
				<td><small>{{ $vehicle->mileage }}</small></td>
				<td><small>{{ $vehicle->priceFormat }}</small></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>