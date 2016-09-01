<!DOCTYPE html>
<html lang='pt-BR'>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

	<title> @yield('title') </title>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.0/css/bootstrap-select.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.0/js/bootstrap-select.min.js"></script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/i18n/pt-BR.js"></script>

	<script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>

	<style type="text/css">

	body{
		padding-top: 70px;
	}
	</style>

</head>

<body>

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigationbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('home') }}">Analyzee</a>
			</div>

			<div class="collapse navbar-collapse" id="navigationbar">


				@if (Auth::guest())
				<ul class="nav navbar-nav navbar-right">

					<!-- Authentication Links -->

					<li><a href="{{ url('/login') }}">Login</a></li>
					
				</ul>

				@else
				<ul class="nav navbar-nav">
					<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"> Agencias <span class="caret"></span></a>

						<ul class="dropdown-menu">
							<li><a href="{!! route('agencias.index') !!}"> Todas </a></li>
							<li><a href="{!! route('agencias.create') !!}" > cadastrar </a></li>
						</ul>

					</li>
					<li><a href="{!! route('clientes.index') !!}">Clientes</a></li>
					<li><a href="{!! route('relatorio.index') !!}">Relatorio</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>

						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('/perfil/'. Auth::id()) }}"> Perfil </a></li>
							<li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
						</ul>
					</li>
				</ul>
				@endif
			</div>
		</div>

	</nav>

	<div class='container-fluid'>

		<div class="flash-message">
			@foreach (['danger', 'warning', 'success', 'info'] as $msg)
			@if(Session::has('alert-' . $msg))

			<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
			@endif
			@endforeach
		</div>

		@yield('body')
	</div>

</div>

</body>
</html>