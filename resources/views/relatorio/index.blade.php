@extends('layouts.app')

@section('title')

Relatório

@stop()

@section('body')

<div class='col-xs-12 col-sm-12 col-md-3 col-lg-2 affix'>

    <div class="affix">


	{{ Form::open(array('role' => 'form', 'class'=>'form-group')) }}

	@include('relatorio.partials.form')

	{{ Form::close() }}

	</div>

</div>

<div class="col-xs-12 col-sm-12 col-md-8 col-lg-10" id='report' style='float:right;>

	<div class='container-fluid'>

		<div class='row'>

			<div class="progress" hidden="true">

				<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:1%">1%</div>

			</div>

		</div>

		<div class='row' id='desempenho'>

			<h3>Desempenho</h3>

			{{-- date includes --}}
			@include('relatorio.partials.datecharts.cliques')

			@include('relatorio.partials.datecharts.impressoes')

			@include('relatorio.partials.datecharts.cpc')

			@include('relatorio.partials.datecharts.investimento')

			@include('relatorio.partials.datecharts.ctr')

			@include('relatorio.partials.datecharts.posicao')

			@include('relatorio.partials.datecharts.conversao')

			@include('relatorio.partials.datecharts.custo_conversao')

			@include('relatorio.partials.datecharts.taxa_conversao')

			{{-- @include('relatorio.partials.datecharts.searchImpressionShared') --}}

			{{-- week includes --}}
			@include('relatorio.partials.weekcharts.cliques')

			@include('relatorio.partials.weekcharts.impressoes')

			@include('relatorio.partials.weekcharts.cpc')

			@include('relatorio.partials.weekcharts.investimento')

			@include('relatorio.partials.weekcharts.ctr')

			@include('relatorio.partials.weekcharts.posicao')

			@include('relatorio.partials.weekcharts.conversao')

			@include('relatorio.partials.weekcharts.custo_conversao')

			@include('relatorio.partials.weekcharts.taxa_conversao')

			{{-- hour includes --}}
			@include('relatorio.partials.hourcharts.cliques')

			@include('relatorio.partials.hourcharts.impressoes')

			@include('relatorio.partials.hourcharts.cpc')

			@include('relatorio.partials.hourcharts.investimento')

			@include('relatorio.partials.hourcharts.ctr')

			@include('relatorio.partials.hourcharts.posicao')

			@include('relatorio.partials.hourcharts.conversao')

			@include('relatorio.partials.hourcharts.custo_conversao')

			@include('relatorio.partials.hourcharts.taxa_conversao')

		</div>

		<div class='row' id='projecao'>

			<h3>Projeção de resultados</h3>

		</div>

	</div>

</div>

@include('relatorio.partials.modal')

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

		dateInvestimento.setOption('height', height);
		dateInvestimento.draw();

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

		weekCliques.setOption('height', height);
		weekCliques.draw();

		weekImpressoes.setOption('height', height);
		weekImpressoes.draw();

		weekCpc.setOption('height', height);
		weekCpc.draw();

		weekInvestimento.setOption('height', height);
		weekInvestimento.draw();

		weekCtr.setOption('height', height);
		weekCtr.draw();

		weekPosicao.setOption('height', height); 
		weekPosicao.draw();

		weekConversao.setOption('height', height);
		weekConversao.draw();

		weekCustoConversao.setOption('height', height);
		weekCustoConversao.draw();

		weekTaxaConversao.setOption('height', height);
		weekTaxaConversao.draw();

		hourCliques.setOption('height', height);
		hourCliques.draw();

		hourImpressoes.setOption('height', height);
		hourImpressoes.draw();

		hourCpc.setOption('height', height);
		hourCpc.draw();

		hourInvestimento.setOption('height', height);
		hourInvestimento.draw();

		hourCtr.setOption('height', height);
		hourCtr.draw();

		hourPosicao.setOption('height', height); 
		hourPosicao.draw();

		hourConversao.setOption('height', height);
		hourConversao.draw();

		hourCustoConversao.setOption('height', height);
		hourCustoConversao.draw();

		hourTaxaConversao.setOption('height', height);
		hourTaxaConversao.draw();

	});

	$("#gerar").click(function (){
		Go();
	});

	$(document).ready(function (){

		Go();

	});

	function Go(){

		$('.progress').show();

		var width = Math.floor((Math.random() * 10) + 1);
		var barWidth = setInterval(frame, 100);

		function frame(){
			if(width >= 99){
				clearInterval(barWidth);
			}
			else{
				width = width+Math.floor((Math.random() * 3) + 1);
			}
			$('.progress-bar').width(width + '%');
			$('.progress-bar').html('Coletando dados ' + width + '%');
		}

		var url = '/relatorio/report';
		var id = $('#contas').val();
		var tipo = $('#tipos').val();
		var periodos = $('#periodos').val();

		var result = $.get(url, {'id':id, 'type': tipo, 'periodos': periodos}, function (response){
			
			(typeof dateCliques != 'undefined') ? (dateCliques.setDataTable(response[0]), dateCliques.draw()) : dateCliques = null;
			(typeof dateImpressoes != 'undefined') ? (dateImpressoes.setDataTable(response[1]), dateImpressoes.draw()) : dateImpressoes = null;
			(typeof dateCpc != 'undefined') ? (dateCpc.setDataTable(response[2]), dateCpc.draw()) : dateCpc = null;
			(typeof dateInvestimento != 'undefined') ? (dateInvestimento.setDataTable(response[3]), dateInvestimento.draw()) : dateInvestimento = null;
			(typeof dateCtr != 'undefined') ? (dateCtr.setDataTable(response[4]), dateCtr.draw()) : dateCtr = null;
			(typeof datePosicao != 'undefined') ? (datePosicao.setDataTable(response[5]), datePosicao.draw()) : datePosicao = null;
			(typeof dateConversao != 'undefined') ? (dateConversao.setDataTable(response[6]), dateConversao.draw()) : dateConversao = null;
			(typeof dateCustoConversao != 'undefined') ? (dateCustoConversao.setDataTable(response[7]), dateCustoConversao.draw()) : dateCustoConversao = null;
			(typeof dateTaxaConversao != 'undefined') ? (dateTaxaConversao.setDataTable(response[8]), dateTaxaConversao.draw()) : dateTaxaConversao = null;
			// (typeof dateSearchImpression != 'undefined') ? (dateSearchImpression.setDataTable(response[9]), dateSearchImpression.draw()) : dateSearchImpression = null;

			(typeof weekCliques != 'undefined') ? (weekCliques.setDataTable(response[10]), weekCliques.draw()) : weekCliques = null;
			(typeof weekImpressoes != 'undefined') ? (weekImpressoes.setDataTable(response[11]), weekImpressoes.draw()) : weekImpressoes = null;
			(typeof weekCpc != 'undefined') ? (weekCpc.setDataTable(response[12]), weekCpc.draw()) : weekCpc = null;
			(typeof weekInvestimento != 'undefined') ? (weekInvestimento.setDataTable(response[13]), weekInvestimento.draw()) : weekInvestimento = null;
			(typeof weekCtr != 'undefined') ? (weekCtr.setDataTable(response[14]), weekCtr.draw()) : weekCtr = null;
			(typeof weekPosicao != 'undefined') ? (weekPosicao.setDataTable(response[15]), weekPosicao.draw()) : weekPosicao = null;
			(typeof weekConversao != 'undefined') ? (weekConversao.setDataTable(response[16]), weekConversao.draw()) : weekConversao = null;
			(typeof weekCustoConversao != 'undefined') ? (weekCustoConversao.setDataTable(response[17]), weekCustoConversao.draw()) : weekCustoConversao = null;
			(typeof weekTaxaConversao != 'undefined') ? (weekTaxaConversao.setDataTable(response[18]), weekTaxaConversao.draw()) : weekTaxaConversao = null;

			(typeof hourCliques != 'undefined') ? (hourCliques.setDataTable(response[20]), hourCliques.draw()) : hourCliques = null;
			(typeof hourImpressoes != 'undefined') ? (hourImpressoes.setDataTable(response[21]), hourImpressoes.draw()) : hourImpressoes = null;
			(typeof hourCpc != 'undefined') ? (hourCpc.setDataTable(response[22]), hourCpc.draw()) : hourCpc = null;
			(typeof hourInvestimento != 'undefined') ? (hourInvestimento.setDataTable(response[23]), hourInvestimento.draw()) : hourInvestimento = null;
			(typeof hourCtr != 'undefined') ? (hourCtr.setDataTable(response[24]), hourCtr.draw()) : hourCtr = null;
			(typeof hourPosicao != 'undefined') ? (hourPosicao.setDataTable(response[25]), hourPosicao.draw()) : hourPosicao = null;
			(typeof hourConversao != 'undefined') ? (hourConversao.setDataTable(response[26]), hourConversao.draw()) : hourConversao = null;
			(typeof hourCustoConversao != 'undefined') ? (hourCustoConversao.setDataTable(response[27]), hourCustoConversao.draw()) : hourCustoConversao = null;
			(typeof hourTaxaConversao != 'undefined') ? (hourTaxaConversao.setDataTable(response[28]), hourTaxaConversao.draw()) : hourTaxaConversao = null;

			$('#page-printer').attr('href','/relatorio/view?'+response[30]);
			$('#link').val('{{ url("/relatorio/view") }}?'+response[30]);
			
		});

		result.always(function (){
			width = 100;
			clearInterval(barWidth);
			frame();
		});

		result.done(function () {
			setTimeout(function () {
				$('.progress').hide(2000);
			},1000);
		});

		result.fail(function() {
			$('.progress').hide();
			alert( "Erro ao obter dados" );
		});

	}

	$('#button-desempenho').click(function (){

		$('#projecao').hide();
		$('#desempenho').show();

		dateCliques.draw();
		dateImpressoes.draw();
		dateCpc.draw();
		dateInvestimento.draw();
		dateCtr.draw();
		datePosicao.draw();
		dateConversao.draw();
		dateCustoConversao.draw();
		dateTaxaConversao.draw();
		weekCliques.draw();
		weekImpressoes.draw();
		weekCpc.draw();
		weekInvestimento.draw();
		weekCtr.draw();
		weekPosicao.draw();
		weekConversao.draw();
		weekCustoConversao.draw();
		weekTaxaConversao.draw();
		hourCliques.draw();
		hourImpressoes.draw();
		hourCpc.draw();
		hourInvestimento.draw();
		hourCtr.draw();
		hourPosicao.draw();
		hourConversao.draw();
		hourCustoConversao.draw();
		hourTaxaConversao.draw();
	});

	$('#button-proj').click(function (){
		$('#projecao').show();
		$('#desempenho').hide();
	});

	($('input[name="dateClick"]').is(':checked')) ? $("#panel_dateClick").show() : $("#panel_dateClick").hide();

</script>

@stop()