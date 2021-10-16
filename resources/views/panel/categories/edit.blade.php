{!! Form::model($category, ['method' => 'PUT', 'route' => ['panel.categories.update', $category], 'class' => 'form col-md-12 m-0 form-validate load-ajax-form-submit', 'files' => true]) !!}
	<x-form.inputtext title="Nome" name="name" placeholder="Nome" id="name" value="{{ $category->name }}" class="required" maxlength="100"/>

	<x-form.inputsubmit value="Salvar" class="btn-danger"/>
{!! Form::close() !!}