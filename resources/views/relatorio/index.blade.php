@extends('layouts.app')

@section('title')
Relatório
@stop

@section('body')

@include('relatorio.partials.form')


<div class="col-xs-12 col-md-9" id='report' style='float: right;'>

	<div class='container-fluid'>

		<div class='class-*-12'>

			{{-- Graficos de anuncios por data --}}
			{{-- condições data inteira, mês e ano --}}

			@include('relatorio.partials.datecharts.cliques')

			@include('relatorio.partials.datecharts.impressoes')

			@include('relatorio.partials.datecharts.cpc')

			@include('relatorio.partials.datecharts.investimento')

			@include('relatorio.partials.datecharts.ctr')

			@include('relatorio.partials.datecharts.posicao')

			@include('relatorio.partials.datecharts.conversao')

			@include('relatorio.partials.datecharts.custo_conversao')

			@include('relatorio.partials.datecharts.taxa_conversao')

		</div>

	</div>

</div>

<!--Load the AJAX API-->

<script type="text/javascript">

$(window).resize(function(){

	height = (($(window).width())/3);

	dateCliques.setOption('height', height);
	dateCliques.draw();

	dateImpressoes.setOption('height', height);
	dateImpressoes.draw();

	dateCpc.setOption('height', height);
	dateCpc.draw();

	dateInvestiemnto.setOption('height', height);
	dateInvestiemnto.draw();

	dateCtr.setOption('height', height);
	dateCtr.draw();

	datePosicao.setOption('height', height); 
	datePosicao.draw();

	dateConversao.setOption('height', height);
	dateConversao.draw();

	dateCustoConversao.setOption('height', height);
	dateCustoConversao.draw();

	dateTaxaConversao.setOption('height', height);
	dateTaxaConversao.draw();

	

});

$("#gerar").click(function (){
	// alert("here");
	Go();
});

$(document).ready(function (){
	Go();
})

function Go(){

	var url = '/relatorio/report';
	var id = $('#contas').val();
	var tipo = $('#tipos').val();

	$.get(url, {'id':id, 'type': tipo}, function (response){
		(typeof dateCliques != 'undefined') ? (dateCliques.setDataTable(response[0]), dateCliques.draw()) : dateCliques = null;
		(typeof dateImpressoes != 'undefined') ? (dateImpressoes.setDataTable(response[1]), dateImpressoes.draw()) : dateImpressoes = null;
		(typeof dateCpc != 'undefined') ? (dateCpc.setDataTable(response[2]), dateCpc.draw()) : dateCpc = null;
		(typeof dateInvestimento != 'undefined') ? (dateInvestimento.setDataTable(response[3]), dateInvestimento.draw()) : dateInvestimento = null;
		(typeof dateCtr != 'undefined') ? (dateCtr.setDataTable(response[4]), dateCtr.draw()) : dateCtr = null;
		(typeof datePosicao != 'undefined') ? (datePosicao.setDataTable(response[5]), datePosicao.draw()) : datePosicao = null;
		(typeof dateConversao != 'undefined') ? (dateConversao.setDataTable(response[6]), dateConversao.draw()) : dateConversao = null;
		(typeof dateCustoConversao != 'undefined') ? (dateCustoConversao.setDataTable(response[7]), dateCustoConversao.draw()) : dateCustoConversao = null;
		(typeof dateTaxaConversao != 'undefined') ? (dateTaxaConversao.setDataTable(response[8]), dateTaxaConversao.draw()) : dateTaxaConversao = null;

	}).done(function (){
		alert('Concluido');

	}).fail(function() {
		alert( "Erro ao obter dados" );
	});


}
</script>

@stop