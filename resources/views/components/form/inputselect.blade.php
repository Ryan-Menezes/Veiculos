<div class="form-group">
	{!! Form::label($name, $title . ':', ['class' => 'form-label']) !!}

	{!! Form::select($name, $options, $value, [
		'class' 		=> 'form-control ' . $class,
		'id' 			=> $id,
		'size'			=> $size,
		'multiple'		=> $multiple
	]) !!}
</div>