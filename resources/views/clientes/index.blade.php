@extends('layouts.app')

@section('title')

Clientes

@stop

@section('body')

<div class='container-fluid'>

	<table class='table'>

		<h1>Clientes cadastrados</h1>

		{{ Form::open(array('route' => 'clientes.index', 'method' => 'GET') }}
		<div class="input-group">

			{{ Form::select('analista', $analista, null, array('class' => 'form-control')) }}
			<span class="input-group-btn">
				{{ Form::submit('selecionar', array('class' => 'btn btn-default' )) }}
			</span>

			{{ Form::close() }}
		</div>

		<thead>

			<tr>

				<th> Id </th>
				<th> Nome </th>
				<th> E-mail </th>
				<th> Typo </th>
				<th> Ações </th>

			</tr>

		</thead>

		<tbody>

			@foreach($clientes as $cliente)
			
			<tr>

				<td> {{$cliente->id}}</td>
				<td> {{$cliente->name}}</td>
				<td> {{$cliente->email}}</td>
				<td> {{$cliente->type_id}}</td>
				<td><a href="#" class='btn btn-default'> editar </a><a href="" class='btn btn-default'>Remover</a></td>

			</tr>

			@endforeach()

		</tbody>

	</table>

</div>


@stop
