<script type="text/javascript">

ctr = new google.visualization.ChartWrapper({
	chartType: 'ColumnChart',
	dataTable: null,
	options: {'legend': 'top', 'height':(($(window).width())/3)},
	containerId: 'ctr'
});

</script>

<div class='row'>

	<div class='row'>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='ctr.setChartType("BarChart"); ctr.draw()'><i class="fa fa-bar-chart" style='transform: rotate(-90deg) scaleY(-1);'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='ctr.setChartType("ColumnChart"); ctr.draw()'><i class="fa fa-bar-chart"></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='ctr.setChartType("LineChart"); ctr.draw()'><i class="fa fa-line-chart"></i></button>
			</div>

		</div>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='ctr.setOption("colors", ["red"]); ctr.draw()'><i class="fa fa-stop" style='color:red'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='ctr.setOption("colors", ["blue"]); ctr.draw()'><i class="fa fa-stop" style='color:blue'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='ctr.setOption("colors", ["orange"]); ctr.draw()'><i class="fa fa-stop" style='color:orange'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='ctr.setOption("colors", ["green"]); ctr.draw()'><i class="fa fa-stop" style='color:green'></i></button>
			</div>

		</div>

	</div>

	<div class='row'>

		<div id='ctr'></div>

	</div>

</div>