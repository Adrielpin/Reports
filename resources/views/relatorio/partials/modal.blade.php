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
       	{{Form::select('contas', ['1'=>'camapanha 1', '2'=>'camapanha 2'], null, array('class' => 'selectpicker', 'data-live-search'=>'true', 'multiple'=> 'true')) }}
      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Aplicar</button>

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