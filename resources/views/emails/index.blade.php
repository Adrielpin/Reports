@extends('layouts.app')
@section('title')
Agendar email
@stop

@section('body')

<div class='container'>

	<div class='row'>

		<h1 style='font-family:arial !important'>Agendamento de emails</h1>

		<a href="{{ route('emails.create') }}" class='btn btn-primary' role='button'> Novo + </a>

	</div>

	<div class='row'>

		<table class="table table-condensed">
			<thead>
				<tr>	
					<th>#</th>
					<th>user</th>
					<th>conta</th>
					<th>tipo</th>
					<th>periodo</th>
					<th>dimesão geografica</th>
					<th>ações</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($confs as $conf)
					<tr>
						<td>{{ $conf->id }}</td>
						<td>{{ $conf->user_id }}</td>
						<td>{{ $conf->conta }}</td>
						<td>{{ $conf->tipo }}</td>
						<td>{{ $conf->periodo }}</td>
						<td>{{ $conf->grafico }}</td>
						<td>
							<a href="{{ route('emails.edit', $conf->id) }}">editar</a>
							<a href="{{ route('emails.destroy', $conf->id) }}">remover</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

	</div>

</div>

@stop