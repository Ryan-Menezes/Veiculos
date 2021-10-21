<section style="width: 100%; font-family: arial;">
	<div style="overflow: hidden; border-radius: 5px; border: 1px solid #e3e3e3; margin: auto; width: 600px;">
		<div style="padding: 5px; background-color: #DB2D2E; color: white;">
			<h4>{{ $subject }}</h4>
		</div>
		<div style="padding: 10px; color: #323232;">
			<small><strong>{{$name}} | {{ $email }} | {{ date('d/m/Y H:i:s') }}</strong></small>
			<p>{!! $body !!}</p>
		</div>
	</div>
</section>