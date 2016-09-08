<div class='col-xs-12 col-md-3'>

	{{ Form::open(array('role' => 'form', 'class'=>'form-group')) }}

	<div class="form-group">

		{!! Form::label('contas', 'Conta') !!}

		{{ Form::select('contas', $campaigns, $prefer, array('class'=>'select-2')) }}

		<script type="text/javascript">

			if($(window).width() > 798){
				$('.select-2').select2({ 'width': '100%' });
			}

		</script>

	</div>

	<div class="form-group">

		{!! Form::label('tipos', 'Tipo de conta', array('class' => 'control-label')) !!}

		{{Form::select('tipos', array('SEARCH' => 'Search', 'DISPLAY' => 'Display', 'SHOPPING' => 'Shopping', 'GMAIL' => 'Gmail', 'VIDEO' => 'Video', 'MOBILE' => 'Mobile'), null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">

		{!! Form::label('periodos', 'Periodo', array('class' => 'control-label')) !!}

		{{Form::select('periodos', array('TODAY'=>'Hoje','YESTERDAY'=>'Ontem','LAST_MONTH'=>'Mês Anterior', 'Personalizado'=>'Personalizado'), null, array('class' => 'form-control')) }}

	</div>

	@include('relatorio.partials.modal')

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

	{{Form::close()}}

	<div class="form-group btn-group-vertical" style=' width:100%;'>
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#metricasModal">metricas</button>
		<button type="button" class="btn btn-info">Projeção</button>
		<button type="button" class="btn btn-info">Desempenho</button>
	</div>

	<div class="form-group">

		<button type="button" class="btn btn-warning btn-md" style='width:100%' data-toggle="modal" data-target="#linkModal"><span class="glyphicon glyphicon-print"></span> Imprimir </button>

	</div>


</div>