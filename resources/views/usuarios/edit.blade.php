@extends('layouts.app')
@section('title')
Editar de usuarios
@stop

@section('body')

<div class='container'>

	<div class='row'>

		<h1>editar usuarios</h1>

		<div 'panel-warnig'>
			<p> Dados basicos para senha vá em login recuperar senha </p>
		</div>

	</div>


	{{ Form::open(array('route' => array('usuarios.update', $row->id), 'method' => 'POST', 'role' => 'form', 'class'=>'form-group')) }}

	<div class="form-group">

		{!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
		{!! Form::text('name',$row->name, array_merge(['class' => 'form-control'])) !!}

	</div>

	<div class="form-group">

		{!! Form::label('email', 'E-mail', ['class' => 'control-label']) !!}
		{!! Form::text('email',$row->email, array_merge(['class' => 'form-control'])) !!}

	</div>

	<div class="form-group">

		{!! Form::label('conta', 'Conta', ['class' => 'control-label']) !!}
		{!! Form::text('conta',$row->costumer_id, array_merge(['class' => 'form-control'])) !!}

	</div>

	{{ Form::submit('Salvar', array('class' => 'btn btn-primary' )) }}

</div>

@stop