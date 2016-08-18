@extends('layouts.app')

@section('title')
Relatório
@stop

@section('body')

@include('relatorio.partials.form')

<script type="text/javascript">

$("#gerar").click(function (){
	drawChartCliques(null)
	drawChartImpressoes(null)
	drawChartCtr(null)
	$('#graficos').show();
});

google.charts.load('current', {'packages':['corechart']});

$(window).resize(function(){
	var height = (($(window).width())/3);
	cliques.setOption('height', height);
	cliques.draw();

	impressoes.setOption('height', height);
	impressoes.draw();
	
	ctr.setOption('height', height);
	ctr.draw();

});


</script>

<div role="main" class='col-md-8'>

	<div class='row'>

		<div class=" form-group btn-group btn-group-xs" style='width:100%'>
			<button type="button" class="btn btn-default btn-xs" value='BarChart' onclick='drawChartCliques(this.value)'>Barra</button>
			<button type="button" class="btn btn-default btn-xs" value='ColumnChart' onclick='drawChartCliques(this.value)'>Coluna</button>
			<button type="button" class="btn btn-default btn-xs" value='LineChart' onclick='drawChartCliques(this.value)'>Linha</button>
		</div>

		<div id='cliques' style='heigth:525px'></div>

		<script type="text/javascript">

			function drawChartCliques(value) {

				(value == null) ? value='ColumnChart' : value;

				cliques = new google.visualization.ChartWrapper({
					chartType: value,
					dataTable: <?php print $clicks; ?>,
					options: {'legend': 'top', 'height':(($(window).width())/3)},
					containerId: 'cliques'
				});

				cliques.draw();

			}

		</script>

	</div>


	<div class='row'>
		<div class=" form-group btn-group btn-group-xs">
			<button type="button" class="btn btn-default btn-xs" value='BarChart' onclick='drawChartImpressoes(this.value)'>Barra</button>
			<button type="button" class="btn btn-default btn-xs" value='ColumnChart' onclick='drawChartImpressoes(this.value)'>Coluna</button>
			<button type="button" class="btn btn-default btn-xs" value='LineChart' onclick='drawChartImpressoes(this.value)'>Linha</button>
		</div>

		<div id='Impressoes' style='heigth:525px'></div>

		<script type="text/javascript">

		function drawChartImpressoes(value) {

			(value == null) ? value='ColumnChart' : value;

			impressoes = new google.visualization.ChartWrapper({
				chartType: value,
				dataTable: <?php print $impressions; ?>,
				options: {'legend': 'top', 'height':(($(window).width())/3)},
				containerId: 'Impressoes'
			});

			impressoes.draw();
		}

		</script>

	</div>

	<div class='row'>

		<div class=" form-group btn-group btn-group-xs">

			<button type="button" class="btn btn-default btn-xs" value='BarChart' onclick='drawChartCtr(this.value)'>Barra</button>
			<button type="button" class="btn btn-default btn-xs" value='ColumnChart' onclick='drawChartCtr(this.value)'>Coluna</button>
			<button type="button" class="btn btn-default btn-xs" value='LineChart' onclick='drawChartCtr(this.value)'>Linha</button>

		</div>

		<div id='ctr' style='heigth:525px'></div>

		<script type="text/javascript">

			function drawChartCtr(value) {

			(value == null) ? value='ColumnChart' : value;

			ctr = new google.visualization.ChartWrapper({
				chartType: value,
				dataTable: <?php print $ctr; ?>,
				options: {'legend': 'top', 'height':(($(window).width())/3)},
				containerId: 'ctr'
			});

			ctr.draw();
			}

		</script>

	</div>

</div>

<div class='col-md-1' fixed>
	<nav class="row" id="myScrollspy">
		<ul class="nav nav-pills nav-stacked">
			<li class="active"><a href="#cliques">Cliques</a></li>
			<li><a href="#Impressoes">Impressoes</a></li>
			<li><a href="#ctr">Ctr</a></li>
		</ul>
	</nav>

</div>


@stop