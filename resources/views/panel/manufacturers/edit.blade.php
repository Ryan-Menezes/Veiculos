{!! Form::model($manufacturer, ['method' => 'PUT', 'route' => ['panel.manufacturers.update', $manufacturer], 'class' => 'form col-md-12 m-0 form-validate load-ajax-form-submit', 'files' => true]) !!}
	<x-form.inputfile title="Imagem" name="image" accept="image/*" id="image"/>
	<x-form.inputtext title="Nome" name="name" placeholder="Nome" id="name" value="{{ $manufacturer->name }}" class="required" maxlength="100"/>

	<x-form.inputsubmit value="Salvar" class="btn-danger"/>
{!! Form::close() !!}
