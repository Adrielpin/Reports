@extends('layouts.app')
@section('title')
Usuarios
@stop

@section('body')

<div class='container'>

	<h1>Usuários</h1>

	<div class='panel'>

	<a href="{{ route('usuarios.create') }}" class='btn btn-primary' role='button'> Novo + </a>

	<div class='panel'>

	<div class='table-responsive'>

		<table class="table table-hover">
			<thead>
				<tr>	
					<th>#</th>
					<th>Nome</th>
					<th>E-mail</th>
					<th>acesso</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($rows as $row)
				<tr>
					<td>{{ $row->id }}</td>
					<td>{{ $row->name }}</td>
					<td>{{ $row->email }}</td>
					<td>{{ $row->type_id }}</td>
					<td>
						<a href="{{ route('usuarios.edit', $row->id) }}">editar</a>
						<a href="{{ route('usuarios.destroy', $row->id) }}">remover</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

	</div>

</div>

@stop