@extends('layouts.app')

@section('title')

{{ $user->name . ' - Perfil' }}

@stop

@section('body')

<div class='container'>

	<div class='panel panel-primary'>

		<div class='panel-heading'>

			<div class='panel-title'>

				<h3>Perfil</h3>

			</div>

		</div>

		<div class='panel-body'>

			<div class="form-group">

				{!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
				{!! Form::text('name', $user->name, ['class' => 'form-control', 'readonly' => 'true']) !!}

			</div>

			<div class="form-group">

				{!! Form::label('name', 'E-mail', ['class' => 'control-label']) !!}
				{!! Form::email('name',$user->email, ['class' => 'form-control', 'readonly' => 'true']) !!}

			</div>

			<a href="{{ route('perfil.senha') }}" class='btn btn-danger' role='button'>Alterar senha</a>
			<a href="{{ route('emails.create') }}" class='btn btn-success' role='button'>Agendar relatório</a>

		</div>

	</div>

	<div class='panel'>

		<table class="table table-condensed">

			<thead>
				<tr>	
					<th>id</th>
					<th>User</th>
					<th>conta</th>
					<th>tipo</th>
					<th>periodo</th>
					<th>dimesão geografica</th>
					<th>ações</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($confis as $conf)
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