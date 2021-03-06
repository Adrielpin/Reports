<script type="text/javascript">
dateInvestimento = new google.visualization.ChartWrapper({
	chartType: 'ColumnChart',
	dataTable: null,
	options: {'legend': 'top', 'height':(($(window).width())/3)},
	containerId: 'date_Investimento'
});
</script>

<div class='row' id='panel_dateCost'>

	<div class='row'>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='dateInvestimento.setChartType("BarChart"); dateInvestimento.draw()'><i class="fa fa-bar-chart" style='transform: rotate(-90deg) scaleY(-1);'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateInvestimento.setChartType("ColumnChart"); dateInvestimento.draw()'><i class="fa fa-bar-chart"></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateInvestimento.setChartType("LineChart"); dateInvestimento.draw()'><i class="fa fa-line-chart"></i></button>
			</div>

		</div>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='dateInvestimento.setOption("colors", ["red"]); dateInvestimento.draw()'><i class="fa fa-stop" style='color:red'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateInvestimento.setOption("colors", ["blue"]); dateInvestimento.draw()'><i class="fa fa-stop" style='color:blue'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateInvestimento.setOption("colors", ["orange"]); dateInvestimento.draw()'><i class="fa fa-stop" style='color:orange'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateInvestimento.setOption("colors", ["green"]); dateInvestimento.draw()'><i class="fa fa-stop" style='color:green'></i></button>
			</div>

		</div>

	</div>

	<div class='row'>

		<div id='date_Investimento'></div>

	</div>

</div>