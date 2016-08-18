@extends('layouts.app')
@section('title')
	{{ $user()->name . ' - Perfil' }} 
@stop

@section('body')
<h1>{{ $user->name . ' - Perfil' }}</h1>
{!! Form::open() !!}
<div class="form-group">
    {!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
    {!! Form::text('name',$user->name, array_merge(['class' => 'form-control'])) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'E-mail', ['class' => 'control-label']) !!}
    {!! Form::email('name',$user->email, array_merge(['class' => 'form-control'])) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
    {!! Form::file('name',null, array_merge(['class' => 'form-control'])) !!}
</div>
{!! Form::close() !!}
@stop