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
              <td align=center>{!! Form::checkbox('weekClick','weekclick', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('weekIpression','weekimpression', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('weekCpc','weekcpc', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('weekInvestimento','weekcost', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('weekCtr','weekctr', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('weekPosicao','weekposition', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('weekConversoes','weekconversions', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('weekCustoConversao','weekconversioncost', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('weekTaxaConversao','weekconversionhate', array_merge(['class' => 'form-control'])) !!}</td>
            </tr>

            <tr>
              <td align=center>Hora</td>
              <td align=center>{!! Form::checkbox('hourClick','hourclick', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('hourIpression','hourimpression', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('hourCpc','hourcpc', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('hourInvestimento','hourcost', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('hourCtr','hourctr', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('hourPosicao','hourposition', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('hourConversoes','hourconversions', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('hourCustoConversao','hourconversioncost', array_merge(['class' => 'form-control'])) !!}</td>
              <td align=center>{!! Form::checkbox('hourTaxaConversao','hourconversionhate', array_merge(['class' => 'form-control'])) !!}</td>
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

        //week

        if($(this).attr("value")=="weekclick"){
          $("#panel_weekClick").toggle();
          weekCliques.draw();
        }

        if($(this).attr("value")=="weekimpression"){
          $("#panel_weekImpression").toggle();
          weekImpressoes.draw();
        }

        if($(this).attr("value")=="weekcpc"){
          $("#panel_weekCpc").toggle();
          weekCpc.draw();
        }

        if($(this).attr("value")=="weekcost"){
          $("#panel_weekCost").toggle();
          weekInvestimento.draw();
        }

        if($(this).attr("value")=="weekctr"){
          $("#panel_weekCtr").toggle();
          weekCtr.draw();
        }

        if($(this).attr("value")=="weekposition"){
          $("#panel_weekPosition").toggle();
          weekPosicao.draw();
        }

        if($(this).attr("value")=="weekconversions"){
          $("#panel_weekConversions").toggle();
          weekConversao.draw();
        }

        if($(this).attr("value")=="weekconversioncost"){
          $("#panel_weekConversionCost").toggle();
          weekCustoConversao.draw();
        }

        if($(this).attr("value")=="weekconversionhate"){
          $("#panel_weekConversionHate").toggle();
          dateTaxaConversao.draw();
        }

        //hour
        if($(this).attr("value")=="hourclick"){
          $("#panel_hourClick").toggle();
          hourCliques.draw();
        }

        if($(this).attr("value")=="hourimpression"){
          $("#panel_hourImpression").toggle();
          hourImpressoes.draw();
        }

        if($(this).attr("value")=="hourcpc"){
          $("#panel_hourCpc").toggle();
          hourCpc.draw();
        }

        if($(this).attr("value")=="hourcost"){
          $("#panel_hourCost").toggle();
          hourInvestimento.draw();
        }

        if($(this).attr("value")=="hourctr"){
          $("#panel_hourCtr").toggle();
          hourCtr.draw();
        }

        if($(this).attr("value")=="hourposition"){
          $("#panel_hourPosition").toggle();
          hourPosicao.draw();
        }

        if($(this).attr("value")=="hourconversions"){
          $("#panel_hourConversions").toggle();
          hourConversao.draw();
        }

        if($(this).attr("value")=="hourconversioncost"){
          $("#panel_hourConversionCost").toggle();
          hourCustoConversao.draw();
        }

        if($(this).attr("value")=="hourconversionhate"){
          $("#panel_hourConversionHate").toggle();
          hourTaxaConversao.draw();
        }

      });

    </script>









