<script type="text/javascript">
hourCustoConversao = new google.visualization.ChartWrapper({
	chartType: 'ColumnChart',
	dataTable: null,
	options: {'legend': 'top', 'height':(($(window).width())/3)},
	containerId: 'hour_CustoConversao'
});
</script>

<div class='row' id='panel_hourConversionCost'>

	<div class='row'>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='hourCustoConversao.setChartType("BarChart"); hourCustoConversao.draw()'><i class="fa fa-bar-chart" style='transform: rotate(-90deg) scaleY(-1);'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourCustoConversao.setChartType("ColumnChart"); hourCustoConversao.draw()'><i class="fa fa-bar-chart"></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourCustoConversao.setChartType("LineChart"); hourCustoConversao.draw()'><i class="fa fa-line-chart"></i></button>
			</div>

		</div>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='hourCustoConversao.setOption("colors", ["red"]); hourCustoConversao.draw()'><i class="fa fa-stop" style='color:red'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourCustoConversao.setOption("colors", ["blue"]); hourCustoConversao.draw()'><i class="fa fa-stop" style='color:blue'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourCustoConversao.setOption("colors", ["orange"]); hourCustoConversao.draw()'><i class="fa fa-stop" style='color:orange'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourCustoConversao.setOption("colors", ["green"]); hourCustoConversao.draw()'><i class="fa fa-stop" style='color:green'></i></button>
			</div>

		</div>

	</div>

	<div class='row'>

		<div id='hour_CustoConversao'></div>

	</div>

</div>

