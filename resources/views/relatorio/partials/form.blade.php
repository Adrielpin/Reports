<div class='col-md-2 col-xs-12'>

	<div class='row'>

		<nav class="navbar navbar-default">

			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-2">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<a class="navbar-brand hidden-md">Filtros</a>

			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="navbar-collapse-2">

				<ul class="nav navbar-nav">

					{{ Form::open(array('role' => 'form', 'class'=>'form-group')) }}

					<div class="form-group">

						{!! Form::label('contas', 'Conta', array('class' => 'control-label')) !!}

						{{ Form::select('contas', $campaigns, null, array('class' => 'form-control')) }}

						<script type="text/javascript">

						if($(window).width() > 798){
							$('#contas').select2({ width: 'resolve' });
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

						<button class="btn btn-success" type="button" id='gerar' style='width:100%'>Gerar</button>

					</div>

					{{Form::close()}}

					<div class="form-group btn-group-vertical" style=' width:100%;'>

						<button type="button" class="btn btn-info">Projeção</button>
						<button type="button" class="btn btn-info">Desempenho</button>
					</div>

					<div class="form-group">

						<button type="button" class="btn btn-warning btn-md" style='width:100%'><span class="glyphicon glyphicon-print"></span> Imprimir </button>

					</div>

				</ul>

			</div>

		</div><!-- /.navbar-collapse -->

	</nav>


</div>