{!! Form::model($user, ['method' => 'PUT', 'route' => ['panel.users.update', $user->id], 'class' => 'form col-md-12 m-0 form-validate load-ajax-form-submit', 'files' => true]) !!}
	<x-form.inputfile title="Imagem" name="image" accept="image/*" id="image"/>
	<x-form.inputtext title="Nome" name="name" value="{{ $user->name }}" placeholder="Nome" id="name" class="required" maxlength="191"/>
	<x-form.inputemail title="E-Mail" name="email" value="{{ $user->email }}" placeholder="E-Mail" id="email" class="required email" maxlength="191"/>
	<x-form.inputselect title="Função" name="role" value="{{ $user->roles()->first()->id }}" :options="$roles" id="role" class="required"/>
	<x-form.inputsubmit value="Salvar" class="btn-danger"/>
{!! Form::close() !!}