<div class="form-group">
	{!! Form::label($name, $title . ':', ['class' => 'form-label']) !!}

	{!! Form::file($name, [
		'class' 	=> 'form-control ' . $class,
		'id' 		=> $id,
		'accept' 	=> $accept
	]) !!}
</div>