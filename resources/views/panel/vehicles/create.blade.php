{!! Form::open(['method' => 'POST', 'route' => 'panel.vehicles.store', 'class' => 'form col-md-12 m-0 form-validate load-ajax-form-submit', 'files' => true]) !!}
	<div class="row">
		<div class="col-md-6">
			<x-form.inputtext title="Marca" name="brand" placeholder="Marca" id="brand" class="required"/>
		</div>
		<div class="col-md-6">
			<x-form.inputtext title="Modelo" name="model" placeholder="Modelo" id="model" class="required"/>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<x-form.inputselect title="Ano" name="year" :options="$years" id="year" class="required"/>
		</div>
		<div class="col-md-6">
			<x-form.inputselect title="Portas" name="ports" :options="$ports" id="ports" class="required"/>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<x-form.inputselect title="Fabricante" name="manufacturer_id" :options="$manufacturers" id="manufacturer" class="required"/>
		</div>
		<div class="col-md-6">
			<x-form.inputselect title="Status" name="status" :options="$status" id="status" class="required"/>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6">
			<x-form.inputnumber title="Quilometragem" name="mileage" placeholder="Quilometragem" id="mileage" class="required"/>
		</div>
		<div class="col-md-6">
			<x-form.inputnumber title="Quantidade" name="quantity" placeholder="Quantidade" id="quantity" class="required"/>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<x-form.inputtext title="Preço" name="price" placeholder="Preço" id="price" class="required"/>
		</div>
		<div class="col-md-6">
			<x-form.inputtext title="Data de Lançamento" name="release_date" placeholder="Data de Lançamento" id="release_date" class="datepicker-ui"/>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6">
			<x-form.inputtext title="Promoção" name="promotion" placeholder="Promoção" id="promotion"/>
		</div>
		<div class="col-md-6">
			<x-form.inputtext title="A promoção vai até" name="promotion_date" placeholder="A promoção vai até" id="promotion_date" class="datepicker-ui"/>
		</div>
	</div>

	<x-form.inputtextarea title="Descrição" name="description" placeholder="Descrição" id="description" class="required"/>

	<x-form.inputsubmit value="Salvar" class="btn-danger"/>
{!! Form::close() !!}

<script type="text/javascript">
	$('.form-validate').validate({
		errorElement: 'span',
		messages: {
			required: 'Este campo é obrigatório'
		}
	})
</script>