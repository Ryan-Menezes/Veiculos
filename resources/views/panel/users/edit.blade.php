{!! Form::model($user, ['method' => 'PUT', 'route' => ['panel.users.update', $user->id], 'class' => 'form col-md-12 m-0 form-validate load-ajax-form-submit']) !!}
	<x-form.inputfile title="Imagem" name="image" accept="image/*" id="image"/>
	<x-form.inputtext title="Nome" name="name" value="{{ $user->name }}" placeholder="Nome" id="name" class="required"/>
	<x-form.inputemail title="E-Mail" name="email" value="{{ $user->email }}" placeholder="E-Mail" id="email" class="required email"/>
	<x-form.inputselect title="Função" name="role" value="{{ $user->roles()->first()->id }}" :options="$roles->pluck('name', 'id')" id="role" class="required"/>
	<x-form.inputsubmit value="Salvar" class="btn-danger"/>
{!! Form::close() !!}

<script type="text/javascript">
	$('.form-validate').validate({
		errorElement: 'span',
		messages: {
			required: 'Este campo é obrigatório',
			email: 'Por favor entre com um email válido'
		}
	})
</script>