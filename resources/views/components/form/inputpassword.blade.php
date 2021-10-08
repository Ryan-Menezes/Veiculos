<div class="form-group">
	{!! Form::label($name, $title . ':', ['class' => 'form-label']) !!}

	{!! Form::password($name, [
		'placeholder' 	=> $placeholder,
		'class' 		=> 'form-control ' . $class,
		'id' 			=> $id
	]) !!}
</div>