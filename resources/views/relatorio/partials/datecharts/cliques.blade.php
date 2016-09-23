<script type="text/javascript">
	dateCliques = new google.visualization.ChartWrapper({
		chartType: 'ColumnChart',
		dataTable: null,
		options: {'legend': 'top', 'height':(($(window).width())/3)},
		containerId: 'date_Cliques'
	});
</script>

<div class='row' id='panel_dateClick'>

	<div class='row '>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='dateCliques.setChartType("BarChart"); dateCliques.draw()'><i class="fa fa-bar-chart" style='transform: rotate(-90deg) scaleY(-1);'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateCliques.setChartType("ColumnChart"); dateCliques.draw()'><i class="fa fa-bar-chart"></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateCliques.setChartType("LineChart"); dateCliques.draw()'><i class="fa fa-line-chart"></i></button>
			</div>

		</div>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='dateCliques.setOption("colors", ["red"]); dateCliques.draw()'><i class="fa fa-stop" style='color:red'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateCliques.setOption("colors", ["blue"]); dateCliques.draw()'><i class="fa fa-stop" style='color:blue'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateCliques.setOption("colors", ["orange"]); dateCliques.draw()'><i class="fa fa-stop" style='color:orange'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateCliques.setOption("colors", ["green"]); dateCliques.draw()'><i class="fa fa-stop" style='color:green'></i></button>
			</div>

		</div>

	</div>

	<div class='row'>

		<div id='date_Cliques' style="heigth: calc(vw100%/3)"></div>

	</div>

</div>