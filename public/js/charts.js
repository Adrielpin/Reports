function clicks (dados, timestamp) {
	dateCliques = new google.visualization.ChartWrapper({
		chartType: 'ColumnChart',
		dataTable: dados,
		options: {'legend': 'top', 'height':(($(window).width())/3)},
		containerId: 'date_Cliques'
	});
}