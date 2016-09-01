@extends('layouts.app')
@section('title')
Novo agendamento de e-mail
@stop

@section('body')



<script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>
<div class='container'>

	<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div>


	{{ Form::open(array('route' => array('emails.update', $conf->id), 'method' => 'POST', 'role' => 'form', 'class'=>'form-group')) }}

	<div class="form-group">

		{!! Form::label('contas', 'Conta', null) !!}

		{{ Form::select('contas', $contas, $conf->conta, array('class'=>'select-2')) }}

		<script type="text/javascript">
			if($(window).width() > 798){
				$('.select-2').select2({'width':'100%'});
			}
		</script>

	</div>

	<div class="form-group">

		{!! Form::label('tipos', 'Tipo de conta', array('class' => 'control-label')) !!}

		{{Form::select('tipos', array('SEARCH' => 'Search', 'DISPLAY' => 'Display', 'SHOPPING' => 'Shopping', 'GMAIL' => 'Gmail', 'VIDEO' => 'Video', 'MOBILE' => 'Mobile'), $conf->tipo, array('class' => 'form-control')) }}

	</div>

	<div class="form-group">

		{!! Form::label('periodos', 'Periodo', array('class' => 'control-label')) !!}

		{{Form::select('periodos', array('TODAY'=>'Hoje','YESTERDAY'=>'Ontem','LAST_MONTH'=>'Mês Anterior'), $conf->periodo, array('class' => 'form-control')) }}

	</div>

	<div class="form-group">

		{!! Form::label('geo', 'Dimensão geografica', array('class' => 'control-label')) !!}

		{{Form::select('geo', array('P' => 'pais 30+', 'E' => 'Estados 30+', 'C' => 'cidades 30+'), $conf->grafico, array('class' => 'form-control')) }}

	</div>

	<div class="form-group">

		<label for='texto'>Texto</label>
		<textarea name="texto" id="texto" rows="10" cols="80">
			{{ $conf->texto }}
		</textarea>
		<script>
		CKEDITOR.replace( 'texto' );
		</script>

	</div>

	<div class="form-group">
		
		{{ Form::submit('Atualizar', array('class' => 'btn btn-primary' )) }}

	</div>	

	{!! Form::close() !!}

</div>


@stop