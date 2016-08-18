@extends('layouts.app')

@section('title')
	cadastro
@stop

@section('body')
<h1>Cadastro de agencia</h1>
{!! Form::open() !!}
<div class="form-group">
    {!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
    {!! Form::text('name',null, array_merge(['class' => 'form-control'])) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
    {!! Form::text('name',null, array_merge(['class' => 'form-control'])) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
    {!! Form::file('name',null, array_merge(['class' => 'form-control'])) !!}
</div>
{!! Form::close() !!}
@stop