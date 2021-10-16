{!! Form::open(['method' => 'POST', 'route' => 'panel.categories.store', 'class' => 'form col-md-12 m-0 form-validate load-ajax-form-submit clear-form', 'files' => true]) !!}
	<x-form.inputtext title="Nome" name="name" placeholder="Nome" id="name" class="required" maxlength="100"/>

	<x-form.inputsubmit value="Salvar" class="btn-danger"/>
{!! Form::close() !!}