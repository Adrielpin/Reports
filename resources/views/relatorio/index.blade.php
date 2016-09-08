@extends('layouts.app')

@section('title')
Relatório
@stop

@section('body')

@include('relatorio.partials.form')

<style>
#report{
	height: calc(100vh - 70px); 
	overflow-y:scroll;
}

</style>

<script type="text/javascript" src='https://www.google.com/jsapi?autoload={"modules":[{"name":"visualization","version":"1"}]}'></script>


<div class="col-xs-12 col-md-9" id='report'>

	<div class='container-fluid'>

		<div class='class-*-12'>

			{{-- Graficos de anuncios por data --}}
			{{-- condições data inteira, mês e ano --}}

			@if($cliques == 1)
			@include('relatorio.partials.cliques')
			@endif

			@if($impressoes == 1)
			@include('relatorio.partials.impressoes')
			@endif

			@if($ctr == 1)
			@include('relatorio.partials.ctr')
			@endif

		</div>

	</div>

</div>

<!--Load the AJAX API-->

<script type="text/javascript">

$(window).resize(function(){

	height = (($(window).width())/3);
	cliques.setOption('height', height);
	cliques.draw();

	impressoes.setOption('height', height);
	impressoes.draw();

	ctr.setOption('height', height);
	ctr.draw();

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
		
		(typeof cliques != 'undefined') ? (cliques.setDataTable(response[0]), cliques.draw()) : cliques = null;
		(typeof impressoes != 'undefined') ? (impressoes.setDataTable(response[1]), impressoes.draw()) : impressoes = null;
		(typeof ctr != 'undefined') ? (ctr.setDataTable(response[2]), ctr.draw()) : cliques = null;

	}).done(function (){
		
		impressoes.draw();
		ctr.draw();
		alert('Concluido');

	}).fail(function() {
		alert( "Erro ao obter dados" );
	});


}
</script>

@stop