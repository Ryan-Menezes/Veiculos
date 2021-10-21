{!! Form::model($role, ['method' => 'PUT', 'route' => ['panel.roles.update', $role], 'class' => 'form col-md-12 m-0 form-validate load-ajax-form-submit', 'files' => true]) !!}
	<x-form.inputtext title="Nome" name="name" placeholder="Nome" id="name" class="required" maxlength="100" value="{{ $role->name }}"/>
	<x-form.inputselect title="Permissões" name="permissions[]" :options="$permissions" id="permissions" size="5" multiple="true"/>
	<x-form.inputtextarea title="Descrição" name="description" placeholder="Descrição" id="description" class="required" value="{{ $role->description }}"/>

	<x-form.inputsubmit value="Salvar" class="btn-danger"/>
{!! Form::close() !!}