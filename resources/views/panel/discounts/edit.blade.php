{!! Form::model($discount, ['method' => 'PUT', 'route' => ['panel.discounts.update', $discount], 'class' => 'form col-md-12 m-0 form-validate load-ajax-form-submit', 'files' => true]) !!}
	<x-form.inputtext title="Código" name="code" placeholder="Código" id="code" class="required" maxlength="20" value="{{ $discount->code }}"/>
	<x-form.inputnumber title="Porcentagem" name="percentage" placeholder="Porcentagem" id="percentage" class="required" min="0" max="100" value="{{ $discount->percentage }}"/>
	<x-form.inputtext title="Data de Expiração" name="expiration_date" placeholder="Data de Expiração" id="expiration_date"  class="datepicker-ui date-mask" value="{{ $discount->expirationDateFormat }}"/>

	<x-form.inputsubmit value="Salvar" class="btn-danger"/>
{!! Form::close() !!}