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

  <div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel">Metricas</h4>

      </div>

      <div class="modal-body">

        <table class='table'>
          
          <thead class='thead-primary'>
            
            <tr>
              <th width='9%'>#</th>
              <th width='9%'>Clique</th>
              <th width='9%'>Impressao</th>
              <th width='9%'>Cpc</th>
              <th width='9%'>investimento</th>
              <th width='9%'>Ctr</th>
              <th width='9%'>Posição</th>
              <th width='9%'>Conversões</th>
              <th width='9%'>Custo/Convesão</th>
              <th width='9%'>Taxa/conversão</th>
            </tr>

          </thead>

          <tbody>

            <tr>
              <td>Data</td>
              <td align=center>{!! Form::checkbox('dateClick','dateclick', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('dateIpression','dateimpression', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('dateCpc','datecpc', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('dateInvestimento','datecost', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('dateCtr','datectr', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('datePosicao','dateposition', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('dateConversoes','dateconversions', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('dateCustoConversao','dateconversioncost', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('dateTaxaConversao','dateconversionhate', array_merge(['class' => 'form-control'])) !!}</td>
            </tr>

            <tr>
              <td>Dia da semana</td>
              <td align=center>{!! Form::checkbox('weekClick',1, array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('weekIpression',1, array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('weekCpc',1, array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('weekInvestimento',1, array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('weekCtr',1, array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('weekPosicao',1, array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('weekConversoes',1, array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('weekCustoConversao',1, array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('weekTaxaConversao',1, array_merge(['class' => 'form-control'])) !!}</td>
            </tr>

            <tr>
              <td align=center>Hora</td>
              <td align=center>{!! Form::checkbox('hourClick',1, array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('hourIpression',1, array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('hourCpc',1, array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('hourInvestimento',1, array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('hourCtr',1, array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('hourPosicao',1, array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('hourConversoes',1, array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('hourCustoConversao',1, array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('hourTaxaConversao',1, array_merge(['class' => 'form-control'])) !!}</td>
            </tr>

          </tbody>

        </table>

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


<script type="text/javascript">

     $('input[type="checkbox"]').click(function(){

        if($(this).attr("value")=="dateclick"){
            $("#panel_dateClick").toggle();
            dateCliques.draw();
        }

        if($(this).attr("value")=="dateimpression"){
            $("#panel_dateImpression").toggle();
            dateImpressoes.draw();
        }

        if($(this).attr("value")=="datecpc"){
            $("#panel_dateCpc").toggle();
            dateCpc.draw();
        }

        if($(this).attr("value")=="datecost"){
            $("#panel_dateCost").toggle();
            dateInvestimento.draw();
        }

        if($(this).attr("value")=="datectr"){
            $("#panel_dateCtr").toggle();
            dateCtr.draw();
        }

        if($(this).attr("value")=="dateposition"){
            $("#panel_datePosition").toggle();
            datePosicao.draw();
        }

        if($(this).attr("value")=="dateconversions"){
            $("#panel_dateConversions").toggle();
            dateConversao.draw();
        }

        if($(this).attr("value")=="dateconversioncost"){
            $("#panel_dateConversionCost").toggle();
            dateCustoConversao.draw();
        }

        if($(this).attr("value")=="dateconversionhate"){
            $("#panel_dateConversionHate").toggle();
            dateTaxaConversao.draw();
        }

    });

</script>









