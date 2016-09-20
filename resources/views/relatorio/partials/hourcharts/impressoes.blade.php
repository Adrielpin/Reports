<script type="text/javascript">
hourImpressoes = new google.visualization.ChartWrapper({
	chartType: 'ColumnChart',
	dataTable: null,
	options: {'legend': 'top', 'height':(($(window).width())/3)},
	containerId: 'hour_Impressoes'
});
</script>

<div class='row' id='panel_hourImpression'>

	<div class='row '>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='hourImpressoes.setChartType("BarChart"); hourImpressoes.draw()'><i class="fa fa-bar-chart" style='transform: rotate(-90deg) scaleY(-1);'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourImpressoes.setChartType("ColumnChart"); hourImpressoes.draw()'><i class="fa fa-bar-chart"></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourImpressoes.setChartType("LineChart"); hourImpressoes.draw()'><i class="fa fa-line-chart"></i></button>
			</div>

		</div>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='hourImpressoes.setOption("colors", ["red"]); hourImpressoes.draw()'><i class="fa fa-stop" style='color:red'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourImpressoes.setOption("colors", ["blue"]); hourImpressoes.draw()'><i class="fa fa-stop" style='color:blue'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourImpressoes.setOption("colors", ["orange"]); hourImpressoes.draw()'><i class="fa fa-stop" style='color:orange'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourImpressoes.setOption("colors", ["green"]); hourImpressoes.draw()'><i class="fa fa-stop" style='color:green'></i></button>
			</div>

		</div>

	</div>

	<div class='row'>

		<div id='hour_Impressoes' style="heigth: calc(vw100%/3)"></div>

	</div>

</div>