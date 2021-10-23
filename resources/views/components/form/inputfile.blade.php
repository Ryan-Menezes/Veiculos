<div class="form-group">
	{!! Form::label($id, $title . ':', ['class' => 'form-label']) !!}

	{!! Form::file($name, [
		'class' 		=> 'form-control ' . $class,
		'id' 			=> $id,
		'accept' 		=> $accept
	]) !!}
</div>