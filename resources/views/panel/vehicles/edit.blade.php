{!! Form::model($vehicle, ['method' => 'PUT', 'route' => ['panel.vehicles.update', $vehicle], 'class' => 'form col-md-12 m-0 form-validate load-ajax-form-submit', 'files' => true]) !!}
	<div class="row">
		<div class="col-md-6">
			<x-form.inputtext title="Marca" name="brand" placeholder="Marca" id="brand" value="{{ $vehicle->brand }}" class="required" maxlength="100"/>
		</div>
		<div class="col-md-6">
			<x-form.inputtext title="Modelo" name="model" placeholder="Modelo" id="model" value="{{ $vehicle->model }}" class="required" maxlength="100"/>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<x-form.inputselect title="Ano" name="year" :options="$years" id="year" value="{{ $vehicle->year }}" class="required"/>
		</div>
		<div class="col-md-6">
			<x-form.inputselect title="Portas" name="ports" :options="$ports" id="ports" value="{{ $vehicle->ports }}" class="required"/>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<x-form.inputselect title="Fabricante" name="manufacturer_id" :options="$manufacturers"  value="{{ $vehicle->manufacturer_id }}" id="manufacturer" class="required"/>
		</div>
		<div class="col-md-6">
			<x-form.inputselect title="Status" name="status" :options="$status" id="status" value="{{ $vehicle->status }}" class="required"/>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6">
			<x-form.inputnumber title="Quilometragem" name="mileage" placeholder="Quilometragem" id="mileage" value="{{ $vehicle->mileage }}" class="required" min="1"/>
		</div>
		<div class="col-md-6">
			<x-form.inputnumber title="Quantidade" name="quantity" placeholder="Quantidade" id="quantity" value="{{ $vehicle->quantity }}" class="required" min="1"/>
		</div>
	</div>

	<x-form.inputselect title="Categorias" name="categories[]" :options="$categories" id="categories" size="5" multiple="true" class="required"/>

	<div class="row">
		<div class="col-md-6">
			<x-form.inputtext title="Preço" name="price" placeholder="Preço" id="price" value="{{ $vehicle->price }}" class="required"/>
		</div>
		<div class="col-md-6">
			<x-form.inputtext title="Data de Lançamento" name="release_date" placeholder="Data de Lançamento" id="release_date" value="{{ $vehicle->releaseDateFormat }}" class="datepicker-ui date-mask"/>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6">
			<x-form.inputtext title="Promoção" name="promotion" placeholder="Promoção" id="promotion" value="{{ $vehicle->promotion }}"/>
		</div>
		<div class="col-md-6">
			<x-form.inputtext title="A promoção vai até" name="promotion_date" placeholder="A promoção vai até" id="promotion_date" value="{{ $vehicle->promotionDateFormat }}" class="datepicker-ui date-mask"/>
		</div>
	</div>

	<x-form.inputtextarea title="Descrição" name="description" placeholder="Descrição" id="description" value="{{ $vehicle->description }}" class="required"/>

	<div class="row">
		@foreach($vehicle->images as $image)
		<div class="col-md-4 mb-1" id="vehicles-image-{{ $image->id }}">
			<img style="width: 100%;" src="{{ asset('storage/' . $image->image) }}" alt="{{ $vehicle->brand }} | {{ $vehicle->model }}" title="{{ $vehicle->brand }} | {{ $vehicle->model }}">

			<button type="button" class="btn btn-sm btn-danger mt-1 btn-remove-image" data-id="{{ $image->id }}"><i class="fas fa-trash-alt"></i></button>
		</div>
		@endforeach
	</div>

	<input type="hidden" name="vehicles_remove" id="vehicles_remove">

	<div class="row container-images">
		<div class="col-md-6 file-image">
			<x-form.inputfile title="Imagem 1" name="images[]" accept="image/*" id="image1" class="input-image"/>
		</div>
	</div>

	<div class="mb-5">
		<button style="min-width: 100%;" type="button" class="btn btn-sm btn-dark btn-add"><i class="fas fa-plus"></i> Adicionar Imagem</button>
	</div>

	<x-form.inputsubmit value="Salvar" class="btn-danger"/>
{!! Form::close() !!}

<script type="text/javascript" src="{{ asset('assets/js/panel/vehicle-form.js') }}"></script>