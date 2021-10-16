{!! Form::model($permission, ['method' => 'PUT', 'route' => ['panel.permissions.update', $permission], 'class' => 'form col-md-12 m-0 form-validate load-ajax-form-submit', 'files' => true]) !!}
	<x-form.inputtextarea title="Descrição" name="description" placeholder="Descrição" id="description" class="required" value="{{ $permission->description }}"/>

	<x-form.inputsubmit value="Salvar" class="btn-danger"/>
{!! Form::close() !!}