{!! Form::model($requestmodel, ['method' => 'PUT', 'route' => ['panel.requests.update', $requestmodel], 'class' => 'form col-md-12 m-0 form-validate load-ajax-form-submit', 'files' => true]) !!}
	<x-form.inputselect title="Status" name="status" :options="$requestmodel->statusCol" id="status" value="{{ $requestmodel->status }}" class="required"/>

	<x-form.inputsubmit value="Salvar" class="btn-danger"/>
{!! Form::close() !!}