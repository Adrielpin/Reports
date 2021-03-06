<script type="text/javascript">
weekPosicao = new google.visualization.ChartWrapper({
	chartType: 'ColumnChart',
	dataTable: null,
	options: {'legend': 'top', 'height':(($(window).width())/3)},
	containerId: 'week_Posicao'
});
</script>

<div class='row' id='panel_weekPosition'>

	<div class='row'>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='weekPosicao.setChartType("BarChart"); weekPosicao.draw()'><i class="fa fa-bar-chart" style='transform: rotate(-90deg) scaleY(-1);'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekPosicao.setChartType("ColumnChart"); weekPosicao.draw()'><i class="fa fa-bar-chart"></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekPosicao.setChartType("LineChart"); weekPosicao.draw()'><i class="fa fa-line-chart"></i></button>
			</div>

		</div>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='weekPosicao.setOption("colors", ["red"]); weekPosicao.draw()'><i class="fa fa-stop" style='color:red'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekPosicao.setOption("colors", ["blue"]); weekPosicao.draw()'><i class="fa fa-stop" style='color:blue'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekPosicao.setOption("colors", ["orange"]); weekPosicao.draw()'><i class="fa fa-stop" style='color:orange'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekPosicao.setOption("colors", ["green"]); weekPosicao.draw()'><i class="fa fa-stop" style='color:green'></i></button>
			</div>

		</div>

	</div>

	<div class='row'>

		<div id='week_Posicao'></div>

	</div>

</div>