<div class="form-group">
	{!! Form::label($name, $title . ':', ['class' => 'form-label']) !!}

	{!! Form::email($name, $value, [
		'placeholder' 	=> $placeholder,
		'class' 		=> 'form-control ' . $class,
		'id' 			=> $id,
		'maxlength'		=> $maxlength
	]) !!}
</div>