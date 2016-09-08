<!-- Modal palavras-->
<div class="modal fade" id="dateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">periodo personalisado</h4>

      </div>

      <div class="modal-body">
        ...
      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Aplicar</button>

      </div>

    </div>

  </div>

</div>

<!-- Modal campanhas-->
<div class="modal fade" id="campanhasModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Selecionar campanhas</h4>

      </div>

      <div class="modal-body">
      	{!! Form::label('campanhas', 'Campanhas', array('class' => 'control-label')) !!}
        {{Form::select('campanhas', ['1'=>'camapanha 1', '2'=>'nome bem grandao pra ve como fica na aba de camapanha 2', '3'=>'ipsum lorem', '4'=>'Ma oeemmmm'], null, array('class' => 'selectpicker', 'data-live-search'=>'true', 'multiple data-actions-box'=>'true')) }}
      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-primary" data-dismiss="modal">Aplicar</button>

      </div>

    </div>

  </div>

</div>

<!-- Modal grupos-->
<div class="modal fade" id="gruposModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Selecionar grupos</h4>

      </div>

      <div class="modal-body">
        ...
      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Aplicar</button>

      </div>

    </div>

  </div>

</div>

<!-- Modal palavras-->
<div class="modal fade" id="palavraModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
        <h4 class="modal-title" id="myModalLabel">Selecionar palavra</h4>

      </div>

      <div class="modal-body">
        ...
      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Aplicar</button>

      </div>

    </div>

  </div>

</div>

<!-- Modal Metricas-->
<div class="modal fade" id="metricasModal" tabindex="-1" role="dialog" aria-labelledby="modalMetricas">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel">Metricas</h4>

      </div>

      <div class="modal-body">

        <div class='col-md-4'>

          <div class="form-group">

            {!! Form::label('dateClick', 'Clique', ['class' => 'control-label']) !!}
            {!! Form::checkbox('dateClick',null, array_merge(['class' => 'form-control'])) !!}

          </div>

          <div class="form-group">

            {!! Form::label('dateImpression', 'Impressoes', ['class' => 'control-label']) !!}
            {!! Form::checkbox('dateIpression',null, array_merge(['class' => 'form-control'])) !!}

          </div>

          <div class="form-group">

            {!! Form::label('dateCtr', 'Ctr', ['class' => 'control-label']) !!}
            {!! Form::checkbox('dateCtr',null, array_merge(['class' => 'form-control'])) !!}

          </div>

        </div>

        <div class='col-md-4'>

          <div class="form-group">

            {!! Form::label('weekClick', 'Clique', ['class' => 'control-label']) !!}
            {!! Form::checkbox('weekClick',null, array_merge(['class' => 'form-control'])) !!}

          </div>

          <div class="form-group">

            {!! Form::label('weekImpression', 'Impressoes', ['class' => 'control-label']) !!}
            {!! Form::checkbox('weekIpression',null, array_merge(['class' => 'form-control'])) !!}

          </div>

          <div class="form-group">

            {!! Form::label('weekCtr', 'Ctr', ['class' => 'control-label']) !!}
            {!! Form::checkbox('weekCtr',null, array_merge(['class' => 'form-control'])) !!}

          </div>

        </div>

        <div class='col-md-4'>

          <div class="form-group">

            {!! Form::label('hourClick', 'Clique', ['class' => 'control-label']) !!}
            {!! Form::checkbox('hourClick',null, array_merge(['class' => 'form-control'])) !!}

          </div>

          <div class="form-group">

            {!! Form::label('hourImpression', 'Impressoes', ['class' => 'control-label']) !!}
            {!! Form::checkbox('hourIpression',null, array_merge(['class' => 'form-control'])) !!}

          </div>

          <div class="form-group">

            {!! Form::label('hourCtr', 'Ctr', ['class' => 'control-label']) !!}
            {!! Form::checkbox('hourCtr',null, array_merge(['class' => 'form-control'])) !!}

          </div>

        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Aplicar</button>

      </div>

    </div>

  </div>

</div>

<!-- Modal Link-->
<div class="modal fade" id="linkModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Link de compartilhamento</h4>

      </div>

      <div class="modal-body">
        {!! Form::label('link', 'Link', ['class' => 'control-label']) !!}
        {!! Form::text('link',null, array_merge(['class' => 'form-control'])) !!}
      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Aplicar</button>

      </div>

    </div>

  </div>

</div>