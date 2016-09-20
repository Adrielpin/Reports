<script type="text/javascript">
hourInvestimento = new google.visualization.ChartWrapper({
	chartType: 'ColumnChart',
	dataTable: null,
	options: {'legend': 'top', 'height':(($(window).width())/3)},
	containerId: 'hour_Investimento'
});
</script>

<div class='row' id='panel_hourCost'>

	<div class='row'>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='hourInvestimento.setChartType("BarChart"); hourInvestimento.draw()'><i class="fa fa-bar-chart" style='transform: rotate(-90deg) scaleY(-1);'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourInvestimento.setChartType("ColumnChart"); hourInvestimento.draw()'><i class="fa fa-bar-chart"></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourInvestimento.setChartType("LineChart"); hourInvestimento.draw()'><i class="fa fa-line-chart"></i></button>
			</div>

		</div>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='hourInvestimento.setOption("colors", ["red"]); hourInvestimento.draw()'><i class="fa fa-stop" style='color:red'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourInvestimento.setOption("colors", ["blue"]); hourInvestimento.draw()'><i class="fa fa-stop" style='color:blue'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourInvestimento.setOption("colors", ["orange"]); hourInvestimento.draw()'><i class="fa fa-stop" style='color:orange'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='hourInvestimento.setOption("colors", ["green"]); hourInvestimento.draw()'><i class="fa fa-stop" style='color:green'></i></button>
			</div>

		</div>

	</div>

	<div class='row'>

		<div id='hour_Investimento'></div>

	</div>

</div>