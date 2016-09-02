@extends('layouts.app')

@section('title')

Clientes

@stop

@section('body')

<div class='container'>

	<h1>Clientes</h1>

	<a href="{{ route('usuarios.create') }}" class='btn btn-primary' role='button'>Adicionar analista/Cliente</a>


	{{ Form::model(null, array('route' => array('clientes.show'), 'method'=>'get')) }}	

	<div class="input-group">

		
		{{ Form::select('analista', $analistas, $selected, array('class' => 'form-control' )) }}

		<span class="input-group-btn">
			{{ Form::submit('selecionar', array('class' => 'btn btn-default' )) }}
		</span>
		
	</div>

	{{ Form::close() }}

	<table class="table table-hover">
		<thead>
			<tr>	
				<th>#</th>
				<th>Nome</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($clientes as $row)
			<tr>
				<td>{{ $row->id }}</td>
				<td>{{ $row->name }}</td>
				<td>
					<a href="{{ route('usuarios.edit', $row->id) }}">editar</a>
					<a href="{{ route('usuarios.destroy', $row->id) }}">remover</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</div>

@stop
