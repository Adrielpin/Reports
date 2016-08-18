@extends('layouts.app')

@section('title')

{{ $user->name . ' - Perfil' }}

@stop

@section('body')

<div class='container-fluid'>

	<h1>{{ $user->name . ' - Perfil' }}</h1>

	<div class="form-group">
		{!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
		{!! Form::text('name', $user->name, ['class' => 'form-control', 'readonly' => 'true']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('name', 'E-mail', ['class' => 'control-label']) !!}
		{!! Form::email('name',$user->email, ['class' => 'form-control', 'readonly' => 'true']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('name', 'Senha', ['class' => 'control-label']) !!}
		{!! Form::password('password', ['class' => 'form-control', 'readonly' => 'true']) !!}
	</div>


</div>

@stop