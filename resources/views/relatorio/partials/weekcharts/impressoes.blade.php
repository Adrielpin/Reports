<script type="text/javascript">
weekImpressoes = new google.visualization.ChartWrapper({
	chartType: 'ColumnChart',
	dataTable: null,
	options: {'legend': 'top', 'height':(($(window).width())/3)},
	containerId: 'week_Impressoes'
});
</script>

<div class='row' id='panel_weekImpression'>

	<div class='row '>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='weekImpressoes.setChartType("BarChart"); weekImpressoes.draw()'><i class="fa fa-bar-chart" style='transform: rotate(-90deg) scaleY(-1);'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekImpressoes.setChartType("ColumnChart"); weekImpressoes.draw()'><i class="fa fa-bar-chart"></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekImpressoes.setChartType("LineChart"); weekImpressoes.draw()'><i class="fa fa-line-chart"></i></button>
			</div>

		</div>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='weekImpressoes.setOption("colors", ["red"]); weekImpressoes.draw()'><i class="fa fa-stop" style='color:red'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekImpressoes.setOption("colors", ["blue"]); weekImpressoes.draw()'><i class="fa fa-stop" style='color:blue'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekImpressoes.setOption("colors", ["orange"]); weekImpressoes.draw()'><i class="fa fa-stop" style='color:orange'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekImpressoes.setOption("colors", ["green"]); weekImpressoes.draw()'><i class="fa fa-stop" style='color:green'></i></button>
			</div>

		</div>

	</div>

	<div class='row'>

		<div id='week_Impressoes' style="heigth: calc(vw100%/3)"></div>

	</div>

</div>