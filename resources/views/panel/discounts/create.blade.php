{!! Form::open(['method' => 'POST', 'route' => 'panel.discounts.store', 'class' => 'form col-md-12 m-0 form-validate load-ajax-form-submit clear-form', 'files' => true]) !!}
	<x-form.inputtext title="Código" name="code" placeholder="Código" id="code" class="required" maxlength="20"/>
	<x-form.inputnumber title="Porcentagem" name="percentage" placeholder="Porcentagem" id="percentage" class="required" min="0" max="100"/>
	<x-form.inputtext title="Data de Expiração" name="expiration_date" placeholder="Data de Expiração" id="expiration_date"  class="datepicker-ui date-mask"/>

	<x-form.inputsubmit value="Salvar" class="btn-danger"/>
{!! Form::close() !!}