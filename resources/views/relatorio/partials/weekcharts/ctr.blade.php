<script type="text/javascript">
weekCtr = new google.visualization.ChartWrapper({
	chartType: 'ColumnChart',
	dataTable: null,
	options: {'legend': 'top', 'height':(($(window).width())/3)},
	containerId: 'week_Ctr'
});
</script>

<div class='row' id='panel_weekCtr'>

	<div class='row '>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='weekCtr.setChartType("BarChart"); weekCtr.draw()'><i class="fa fa-bar-chart" style='transform: rotate(-90deg) scaleY(-1);'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekCtr.setChartType("ColumnChart"); weekCtr.draw()'><i class="fa fa-bar-chart"></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekCtr.setChartType("LineChart"); weekCtr.draw()'><i class="fa fa-line-chart"></i></button>
			</div>

		</div>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='weekCtr.setOption("colors", ["red"]); weekCtr.draw()'><i class="fa fa-stop" style='color:red'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekCtr.setOption("colors", ["blue"]); weekCtr.draw()'><i class="fa fa-stop" style='color:blue'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekCtr.setOption("colors", ["orange"]); weekCtr.draw()'><i class="fa fa-stop" style='color:orange'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekCtr.setOption("colors", ["green"]); weekCtr.draw()'><i class="fa fa-stop" style='color:green'></i></button>
			</div>

		</div>

	</div>

	<div class='row'>

		<div id='week_Ctr' style="heigth: calc(vw100%/3)"></div>

	</div>

</div>