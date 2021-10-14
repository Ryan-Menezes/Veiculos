<div class="form-group">
	{!! Form::label($name, $title . ':', ['class' => 'form-label']) !!}

	{!! Form::number($name, $value, [
		'placeholder' 	=> $placeholder,
		'class' 		=> 'form-control ' . $class,
		'id' 			=> $id,
		'min'			=> $min,
		'max'			=> $max
	]) !!}
</div>