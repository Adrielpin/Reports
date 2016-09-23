<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Simple Sidebar - Start Bootstrap Template</title>

	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/all.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ url('/css/sidebar.css') }}" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style type="text/css">

        	body{
        		padding-top: 50px;
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
    					<li><a href="{!! route('relatorio.show') !!}">Relatorio</a></li>

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


    	<div id='sistem'>

    		<div id="wrapper">

    			<!-- Sidebar -->
    			<div id="sidebar-wrapper">
    				<ul class="sidebar-nav">
    					<li class="sidebar-brand">
    						<a href="#">
    							filtros
    						</a>
    					</li>
    					<li>
    						<a href="#">Dashboard</a>
    					</li>
    					<li>
    						<a href="#">Shortcuts</a>
    					</li>
    					<li>
    						<a href="#">Overview</a>
    					</li>
    					<li>
    						<a href="#">Events</a>
    					</li>
    					<li>
    						<a href="#">About</a>
    					</li>
    					<li>
    						<a href="#">Services</a>
    					</li>
    					<li>
    						<a href="#">Contact</a>
    					</li>
    				</ul>
    			</div>
    			<!-- /#sidebar-wrapper -->

    			<!-- Page Content -->
    			<div id="page-content-wrapper">
    				<div class="container-fluid">
    					<div class="row">
    						<div class="col-lg-12">
    							<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>

    							<h1>Graficos</h1>

    							<p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
    							<p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>

    							<p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
    							<p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>

    							<p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
    							<p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>

    							<p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
    							<p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>


    							<p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
    							<p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>


    							<p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
    							<p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>


    							<p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
    							<p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>


    							<p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
    							<p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>
    							
    						</div>
    					</div>
    				</div>
    			</div>
    			<!-- /#page-content-wrapper -->

    		</div>

    	</div>
    	<!-- /#wrapper -->

    	<!-- Menu Toggle Script -->
    	<script src="{{ asset('assets/js/all.js') }}"></script>
    	<script>
    		$("#menu-toggle").click(function(e) {
    			e.preventDefault();
    			$("#wrapper").toggleClass("toggled");
    		});
    	</script>

    </body>

    </html>