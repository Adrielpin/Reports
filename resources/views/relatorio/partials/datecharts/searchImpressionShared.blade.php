<script type="text/javascript">
dateSearchImpression = new google.visualization.ChartWrapper({
	chartType: 'ColumnChart',
	dataTable: null,
	options: {'legend': 'top', 'height':(($(window).width())/3)},
	containerId: 'date_SearchImpression'
});
</script>

<div class='row' id='panel_dateClick'>

	<div class='row '>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='dateSearchImpression.setChartType("BarChart"); dateSearchImpression.draw()'><i class="fa fa-bar-chart" style='transform: rotate(-90deg) scaleY(-1);'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateSearchImpression.setChartType("ColumnChart"); dateSearchImpression.draw()'><i class="fa fa-bar-chart"></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateSearchImpression.setChartType("LineChart"); dateSearchImpression.draw()'><i class="fa fa-line-chart"></i></button>
			</div>

		</div>

		<div class='col-xs-6 col-md-6'>

			<div class="btn-group" style='width:100%'>
				<button type="button" class="btn btn-default btn-xs" onclick='dateSearchImpression.setOption("colors", ["red"]); dateSearchImpression.draw()'><i class="fa fa-stop" style='color:red'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateSearchImpression.setOption("colors", ["blue"]); dateSearchImpression.draw()'><i class="fa fa-stop" style='color:blue'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateSearchImpression.setOption("colors", ["orange"]); dateSearchImpression.draw()'><i class="fa fa-stop" style='color:orange'></i></button>
				<button type="button" class="btn btn-default btn-xs" onclick='dateSearchImpression.setOption("colors", ["green"]); dateSearchImpression.draw()'><i class="fa fa-stop" style='color:green'></i></button>
			</div>

		</div>

	</div>

	<div class='row'>

		<div id='date_SearchImpression' style="heigth: calc(vw100%/3)"></div>

	</div>

</div>