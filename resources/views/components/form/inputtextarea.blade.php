<div class="form-group">
	{!! Form::label($name, $title . ':', ['class' => 'form-label']) !!}

	{!! Form::textarea($name, $value, [
		'placeholder' 	=> $placeholder,
		'class' 		=> 'form-control ' . $class,
		'id' 			=> $id
	]) !!}
</div>