<script type="text/javascript">
weekTaxaConversao = new google.visualization.ChartWrapper({
	chartType: 'ColumnChart',
	dataTable: null,
	options: {'legend': 'top', 'height':(($(window).width())/3)},
	containerId: 'week_TaxaConversao'
});
</script>

<div class='row' id='panel_weekConversionHate'>

	<div class='row'>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='weekTaxaConversao.setChartType("BarChart"); weekTaxaConversao.draw()'><i class="fa fa-bar-chart" style='transform: rotate(-90deg) scaleY(-1);'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekTaxaConversao.setChartType("ColumnChart"); weekTaxaConversao.draw()'><i class="fa fa-bar-chart"></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekTaxaConversao.setChartType("LineChart"); weekTaxaConversao.draw()'><i class="fa fa-line-chart"></i></button>
			</div>

		</div>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='weekTaxaConversao.setOption("colors", ["red"]); weekTaxaConversao.draw()'><i class="fa fa-stop" style='color:red'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekTaxaConversao.setOption("colors", ["blue"]); weekTaxaConversao.draw()'><i class="fa fa-stop" style='color:blue'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekTaxaConversao.setOption("colors", ["orange"]); weekTaxaConversao.draw()'><i class="fa fa-stop" style='color:orange'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='weekTaxaConversao.setOption("colors", ["green"]); weekTaxaConversao.draw()'><i class="fa fa-stop" style='color:green'></i></button>
			</div>

		</div>

	</div>

	<div class='row'>

		<div id='week_TaxaConversao'></div>

	</div>

</div>