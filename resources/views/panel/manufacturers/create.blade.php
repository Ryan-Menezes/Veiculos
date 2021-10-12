{!! Form::open(['method' => 'POST', 'route' => 'panel.manufacturers.store', 'class' => 'form col-md-12 m-0 form-validate load-ajax-form-submit clear-form', 'files' => true]) !!}
	<x-form.inputfile title="Imagem" name="image" accept="image/*" id="image" class="required"/>
	<x-form.inputtext title="Nome" name="name" placeholder="Nome" id="name" class="required"/>

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