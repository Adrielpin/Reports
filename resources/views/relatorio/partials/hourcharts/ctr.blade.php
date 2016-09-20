<script type="text/javascript">
hourCtr = new google.visualization.ChartWrapper({
	chartType: 'ColumnChart',
	dataTable: null,
	options: {'legend': 'top', 'height':(($(window).width())/3)},
	containerId: 'hour_Ctr'
});
</script>

<div class='row' id='panel_hourCtr'>

	<div class='row '>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='hourCtr.setChartType("BarChart"); hourCtr.draw()'><i class="fa fa-bar-chart" style='transform: rotate(-90deg) scaleY(-1);'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourCtr.setChartType("ColumnChart"); hourCtr.draw()'><i class="fa fa-bar-chart"></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourCtr.setChartType("LineChart"); hourCtr.draw()'><i class="fa fa-line-chart"></i></button>
			</div>

		</div>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='hourCtr.setOption("colors", ["red"]); hourCtr.draw()'><i class="fa fa-stop" style='color:red'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourCtr.setOption("colors", ["blue"]); hourCtr.draw()'><i class="fa fa-stop" style='color:blue'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourCtr.setOption("colors", ["orange"]); hourCtr.draw()'><i class="fa fa-stop" style='color:orange'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourCtr.setOption("colors", ["green"]); hourCtr.draw()'><i class="fa fa-stop" style='color:green'></i></button>
			</div>

		</div>

	</div>

	<div class='row'>

		<div id='hour_Ctr' style="heigth: calc(vw100%/3)"></div>

	</div>

</div>