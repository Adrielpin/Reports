<script type="text/javascript">
dateImpressoes = new google.visualization.ChartWrapper({
	chartType: 'ColumnChart',
	dataTable: null,
	options: {'legend': 'top', 'height':(($(window).width())/3)},
	containerId: 'date_Impressoes'
});
</script>

<div class='row'>

	<div class='row '>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='dateImpressoes.setChartType("BarChart"); dateImpressoes.draw()'><i class="fa fa-bar-chart" style='transform: rotate(-90deg) scaleY(-1);'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateImpressoes.setChartType("ColumnChart"); dateImpressoes.draw()'><i class="fa fa-bar-chart"></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateImpressoes.setChartType("LineChart"); dateImpressoes.draw()'><i class="fa fa-line-chart"></i></button>
			</div>

		</div>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='dateImpressoes.setOption("colors", ["red"]); dateImpressoes.draw()'><i class="fa fa-stop" style='color:red'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateImpressoes.setOption("colors", ["blue"]); dateImpressoes.draw()'><i class="fa fa-stop" style='color:blue'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateImpressoes.setOption("colors", ["orange"]); dateImpressoes.draw()'><i class="fa fa-stop" style='color:orange'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateImpressoes.setOption("colors", ["green"]); dateImpressoes.draw()'><i class="fa fa-stop" style='color:green'></i></button>
			</div>

		</div>

	</div>

	<div class='row'>

		<div id='date_Impressoes' style="heigth: calc(vw100%/3)"></div>

	</div>

</div>