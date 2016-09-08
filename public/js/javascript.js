$(document).ready( function (){

});

$('#contas, #tipos').change(function(event){
	url = '/relatorio/campaings';
	data = {'conta':event.val()};

	2
	// $.get(url, data).success(function(return){
	// 	$('[nane="camapanhas"]').empty().append(return);
	// }).failure();
});