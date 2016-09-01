@extends('layouts.app')
@section('title')
Cadastro de clientes
@stop

@section('body')

<div class='container'>

	<div class='row'>

		<h1>Cadastro de clientes</h1>

	</div>

	<div class="form-group">

		{!! Form::label('analista', 'analista', array('class' => 'control-label')) !!}
		{{ Form::select('analista', $analista, null, array('class' => 'form-control')) }}

	</div>



	{!! Form::close() !!}

</div>

@stop