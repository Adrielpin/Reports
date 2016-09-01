@extends('layouts.app')
@section('title')
Cadastro de usuarios
@stop

@section('body')

<div class='container'>

	<div class='row'>

		<h1>Cadastro de usuarios</h1>

	</div>


	{{ Form::open(array('route' => 'usuarios.store', 'method' => 'POST', 'role' => 'form', 'class'=>'form-group')) }}

	<div class="form-group">

		{!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
		{!! Form::text('name',null, array_merge(['class' => 'form-control'])) !!}

	</div>

	<div class="form-group">

		{!! Form::label('email', 'E-mail', ['class' => 'control-label']) !!}
		{!! Form::text('email',null, array_merge(['class' => 'form-control'])) !!}

	</div>

	<div class="form-group">

		{!! Form::label('conta', 'Conta', ['class' => 'control-label']) !!}
		{!! Form::text('conta',null, array_merge(['class' => 'form-control'])) !!}

	</div>

	<div class="form-group">

		{!! Form::label('tipos', 'Nivel', array('class' => 'control-label')) !!}
		{{ Form::select('tipos', $tipos, null, array('class' => 'form-control')) }}

	</div>

	<div class="form-group has-warning">

		{!! Form::label('senha', 'Senha', array('class' => 'control-label')) !!}
		{{ Form::password('senha', array('class' => 'form-control')) }}

	</div>

	{{ Form::submit('Salvar', array('class' => 'btn btn-primary' )) }}
</div>

@stop