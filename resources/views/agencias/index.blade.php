@extends('layouts.app')

@section('title')
Agencias
@stop

@section('body')

<h1>Lista de agencias</h1>

<table class='table table-bordered'>

	<thead>

		<tr>
			<th> Id </th>
			<th> Nome</th>

		</tr>

	</thead>

	<tbody>

		@foreach($agencias as $agencia)
		<tr>
			<td> {{$agencia->id_Agencias}}</td>
			<td> {{$agencia->nome}}</td>
		</tr>
		@endforeach()

	</tbody>

</table>
@stop

