
<div class="form-group">

	{!! Form::label('contas', 'Conta') !!}

	{{ Form::select('contas', $campaigns, $prefer, array('class'=>'select-2')) }}

	<script type="text/javascript">

		if($(window).width() > 798){
			$('.select-2').select2();
		}

	</script>

</div>

<div class="form-group">

	{!! Form::label('tipos', 'Tipo de conta', array('class' => 'control-label')) !!}

	{{Form::select('tipos', array('SEARCH' => 'Search', 'DISPLAY' => 'Display', 'SHOPPING' => 'Shopping', 'GMAIL' => 'Gmail', 'VIDEO' => 'Video', 'MOBILE' => 'Mobile'), null, array('class' => 'form-control')) }}
</div>

<div class="form-group">

	{!! Form::label('periodos', 'Periodo', array('class' => 'control-label')) !!}

	{{Form::select('periodos', array('TODAY'=>'Hoje','YESTERDAY'=>'Ontem','THIS_WEEK_SUN_TODAY'=>'Esta semana (dom- hoje)','THIS_WEEK_MON_TODAY'=>'Esta semana (seg- hoje)','LAST_WEEK'=>'Semana passada (seg - dom)','LAST_WEEK_SUN_SAT'=>'Semana passada (dom - sab)','LAST_BUSINESS_WEEK'=>'Ultima semana útil (seg - sex)','LAST_7_DAYS'=>'Ultimos 7 Dias','LAST_14_DAYS'=>'Ultimos 14 dias','LAST_30_DAYS'=>'Ultimos 30 dias','THIS_MONTH'=>'Mês atual','LAST_MONTH'=>'Mês anterior','THIS_YEAR'=>'Ano atual','LAST_YEAR'=>'Ano anterior', 'Personalizado'=>'Personalizado'), null, array('class' => 'form-control')) }}

</div>

<script type="text/javascript">

	$('#periodos').change(function () {
		if ($(this).val() == "Personalizado") {
			$("#dateModal").modal();
		}
	});

</script>

<div class=" form-group btn-group-vertical" style=' width:100%;'>

	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#campanhasModal">Campanhas</button>
	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#gruposModal">Grupos</button>
	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#palavraModal">Palavras</button>

</div>



<div class="form-group">

	<button type="button" id='gerar' class='btn btn-success' style='width:100%'>Gerar</button>
</div>

<div class="form-group btn-group-vertical" style=' width:100%;'>
	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#metricasModal">metricas</button>
	<button type="button" class="btn btn-info">Projeção</button>
	<button type="button" class="btn btn-info">Desempenho</button>
</div>

<div class="form-group">

	<button type="button" class="btn btn-warning btn-md" style='width:100%' data-toggle="modal" data-target="#linkModal"><span class="glyphicon glyphicon-print"></span> Imprimir </button>

</div>