<?php

/**							
 * rotina com methodos de chamada antigo para construção de disparo de e-mails relatório
 * não aceita valores por MCC
 * Não auterar
 * @author Adriel Pinheiro <adriel.pinheiro@clinks.com.br>
 *
 */

namespace Relatorio\Services;

use AdWordsUser;
use Selector;
use Paging;
use AdWordsConstants;
use Predicate;
use ReportUtils;
use ReportDefinition;

class oldmethods {

	public static function DateReportold ($user, $b, $c, $parcela_impressao, $parcela_impressao_orcamento, $parcela_impressao_rank) {

		$selector = new Selector();
		$selector->fields = array('Date', 'Clicks', 'Impressions', 'Cost', 'AveragePosition', 'Conversions', 'ViewThroughConversions', $parcela_impressao, $parcela_impressao_orcamento, $parcela_impressao_rank);
		$selector->predicates[] = new Predicate('AdvertisingChannelType', 'EQUALS', array($c));

		$reportDefinition = new ReportDefinition();
		$reportDefinition->selector = $selector;
		$reportDefinition->reportName = 'Criteria performance report';
		$reportDefinition->dateRangeType = $b;
		$reportDefinition->reportType = 'CAMPAIGN_PERFORMANCE_REPORT';
		$reportDefinition->downloadFormat = 'CSV';

		$options = array('version' => 'v201605');
		$options['skipReportHeader'] = true;
		$options['skipColumnHeader'] = true;
		$options['skipReportSummary'] = true;
		$options['includeZeroImpressions'] = true;

		$reportUtils = new ReportUtils();
		$returned = $reportUtils->DownloadReport($reportDefinition, null, $user, $options);

		$arr = array();
		$Data = str_getcsv($returned, "\n");

		foreach($Data as &$Row){
			$Row = str_getcsv($Row, ",");
			array_push($arr, $Row);
		}
		asort($arr);

		$cliques = array();
		$impressoes = array();
		$investimento = array();
		$posicao = array();
		$pontos = array();
		$conversao = array();
		$conversao_de_visualizacao = array();
		$parcela = array();

		foreach($arr as &$Row){

			$date = date('d', strtotime($Row[0]));
			array_push($cliques, array($date, $Row[1]));
			array_push($impressoes, array($date, $Row[2]));
			array_push($investimento, array($date, ($Row[3]/1000000)));
			array_push($posicao, array($date, (float)$Row[4]));
			array_push($pontos, array($date, ((int)$Row[2]*(float)$Row[4])));
			array_push($conversao, array($date,(int)str_replace(',','',$Row[5])));
			array_push($conversao_de_visualizacao, array($date, (int)str_replace(',','',$Row[6])));

			if($Row[7] == '< 10%'){
				if($Row[9] == '> 90%'){
					array_push($parcela, array($date, (int)$Row[2], 100-(91+$Row[8])));	
				}
				array_push($parcela, array($date, (int)$Row[2], 100-($Row[8]+$Row[9])));
			}

			else{
				array_push($parcela, array($date, (int)$Row[2], (float)$Row[7]));
			}

		}

		//parcela de impressão;

		$total_de_impressoes = array();
		foreach($parcela as &$a){
			array_push($total_de_impressoes, array($a[0], ($a[2] == 0) ? 0 :round(($a[1]/$a[2])*100, 2)));

		}

		$soma = function ($a, $b){
			isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] : $a[$b[0]] = $b;
			return $a;
		};

		$cliques = array_reduce($cliques, $soma);
		$impressoes = array_reduce($impressoes, $soma);
		$investimento = array_reduce($investimento, $soma);
		$posicao = array_reduce($posicao, $soma);
		$pontos = array_reduce($pontos, $soma);
		$conversao = array_reduce($conversao, $soma);
		$conversao_de_visualizacao = array_reduce($conversao_de_visualizacao, $soma);
		$total_de_impressoes = array_reduce($total_de_impressoes, $soma);

		$posicao_real = array();
		foreach ($pontos as &$p) {
			foreach ($impressoes as &$i) {
				if($i[0] == $p[0]){

					array_push($posicao_real, array($i[0], round((float)($p[1]/$i[1]),1)));
				}
			}
		}

		$cpc = array();
		foreach($investimento as &$a){
			foreach($cliques as &$b){
				if($a[0] == $b[0]){
					array_push($cpc, array($a[0], round($a[1]/$b[1], 2)));
				}
			}	
		}

		$ctr = array();
		foreach($cliques as &$a){
			foreach($impressoes as &$b){
				if($a[0] == $b[0]){
					array_push($ctr, array($a[0], round(($a[1]/$b[1])*100, 2)));
				} 
			}
		}

		$custo_por_conversao = array();
		foreach($investimento as &$a){
			foreach($conversao as &$b){
				if($a[0] == $b[0]){
					array_push($custo_por_conversao, array($a[0], ($b[1] == 0)? 0 : round(($a[1]/$b[1]), 2)));
				} 
			}
		}

		$conversao_total = array();
		foreach($conversao_de_visualizacao as &$a){
			foreach($conversao as &$b){
				if($a[0] == $b[0]){
					array_push($conversao_total, array($a[0], ($a[1]+$b[1])));
				} 
			}
		}

		$custo_por_conversao_total = array();
		foreach($investimento as &$a){
			foreach($conversao_total as &$b){
				if($a[0] == $b[0]){
					array_push($custo_por_conversao_total, array($a[0], ($b[1] ==0 ) ? 0 : round(($a[1]/$b[1]), 2)));
				} 
			}
		}

		$taxa_de_conversao = array();
		foreach($cliques as &$a){
			foreach($conversao as &$b){
				if($a[0] == $b[0]){
					array_push($taxa_de_conversao, array($a[0], round(($b[1]/$a[1])*100, 2)));
				} 
			}
		}

		$taxa_de_conversao_total = array();
		foreach($cliques as &$a){
			foreach($conversao_total as &$b){
				if($a[0] == $b[0]){
					array_push($taxa_de_conversao_total, array($a[0], round(($b[1]/$a[1])*100, 2)));
				} 
			}
		}

		$total_parcela = array();
		$t_impressoes = 0;
		$t_parcela = 0;
		foreach($impressoes as &$a){
			foreach($total_de_impressoes as &$b){
				if($a[0] == $b[0]){
					array_push($total_parcela, array($a[0], ($b[1] == 0 ) ? 0 : round(($a[1]/$b[1])*100, 2)));
					$t_impressoes += $a[1];
					$t_parcela += $b[1];
				} 
			}
		}
		$t_parcela_de_impresao = ($t_impressoes/$t_parcela)*100;

		//este bloco constroi arrays individuais da consulta para graficos
		//author adriel Pinheiro

		$cliques_tabela = array(array('Data', 'Cliques',array('type' => 'string', 'role' =>'annotation')));
		$t_cliques = 0;
		foreach($cliques as &$Row){
			array_push($cliques_tabela, array($Row[0], (int)$Row[1], number_format((int)$Row[1],0,',','.')));
			$t_cliques += $Row[1];
		}


		$impressoes_tabela = array(array('Data', 'Impressões', array('type' => 'string', 'role' =>'annotation')));
		$t_impressoes = 0;
		foreach($impressoes as &$Row){
			array_push($impressoes_tabela, array($Row[0], (int)$Row[1], number_format((int)$Row[1],0,',','.')));
			$t_impressoes += $Row[1];
		}

		$investimento_tabela = array(array('Data', 'Investimento', array('type' => 'string', 'role' =>'annotation')));
		$t_investimento = 0;
		foreach($investimento as &$Row){
			array_push($investimento_tabela, array($Row[0], (float)$Row[1], 'R$ '.number_format((float)$Row[1],2,',','.')));
			$t_investimento += $Row[1];
		}

		$cpc_tabela = array(array('Data', 'CPC', array('type' => 'string', 'role' =>'annotation')));
		$t_cpc = $t_investimento/$t_cliques;
		foreach($cpc as &$Row){
			array_push($cpc_tabela, array($Row[0], (float)$Row[1], 'R$ '.number_format((float)$Row[1],2,',','.')));
		}

		$ctr_tabela = array(array('Data', 'CTR %', array('type' => 'string', 'role' =>'annotation')));
		$t_ctr = ($t_cliques/$t_impressoes)*100;
		foreach($ctr as &$Row){
			array_push($ctr_tabela, array($Row[0], (float)$Row[1], number_format((float)$Row[1],2,',','.').' %'));
		}

		$posicao_tabela = array(array('Data', 'Posição média', array('type' => 'string', 'role' =>'annotation')));
		foreach($posicao_real as &$Row){
			array_push($posicao_tabela, array($Row[0], $Row[1], number_format($Row[1],1,',','.')));
		}


		$t_posicao = 0;
		$t_pontos = 0;
		foreach($pontos as &$Row){
			$t_pontos += $Row[1];
		}

		$t_posicao = $t_pontos/$t_impressoes;

		$conversao_tabela = array(array('Data','Conversões', array('type' => 'string', 'role' =>'annotation')));
		$t_conversao = 0;
		foreach($conversao as $Row){
			array_push($conversao_tabela, array($Row[0], (int)$Row[1], number_format(((int)$Row[1]),0,',','.')));
			$t_conversao += $Row[1];
		}

		$custo_por_conversao_tabela = array(array('Data','Custo por conversão total', array('type' => 'string', 'role' =>'annotation')));
		$t_custo_por_conversao  = $t_investimento/$t_conversao;
		foreach($custo_por_conversao as &$Row){
			array_push($custo_por_conversao_tabela, array($Row[0], (float)$Row[1], 'R$ '.number_format((float)$Row[1],2,',','.')));
		}

		$taxa_de_conversao_tabela = array(array('Data','Taxa de conversão %', array('type' => 'string', 'role' =>'annotation')));
		$t_taxa_de_conversao = ($t_conversao/$t_cliques)*100;
		foreach($taxa_de_conversao as &$Row){
			array_push($taxa_de_conversao_tabela, array($Row[0], (float)$Row[1], number_format((float)$Row[1],2,',','.').' %'));
		}

		$conversao_de_visualizacao_tabela = array(array('Data','Conversões de visualização', array('type' => 'string', 'role' =>'annotation')));
		$t_conversao_visualizacao = 0;
		foreach($conversao_de_visualizacao as &$Row){
			array_push($conversao_de_visualizacao_tabela, array($Row[0], (float)$Row[1], number_format((float)$Row[1],0,',','.')));
			$t_conversao_visualizacao += $Row[1];
		}

		$conversao_total_tabela = array(array('Data','Total de conversões', array('type' => 'string', 'role' =>'annotation')));
		$t_conversao_total = 0;
		foreach($conversao_total as &$Row){
			array_push($conversao_total_tabela, array($Row[0], $Row[1], number_format((float)$Row[1],0,',','.')));
			$t_conversao_total += $Row[1];
		}

		$taxa_de_conversao_total_tabela = array(array('Data','Taxa de conversão total %', array('type' => 'string', 'role' =>'annotation')));
		$t_taxa_de_conversao_total = ($t_conversao_total/$t_cliques)*100;
		foreach($taxa_de_conversao_total as &$Row){
			array_push($taxa_de_conversao_total_tabela, array($Row[0], (float)$Row[1], number_format((float)$Row[1],2,',','.').' %'));
		}

		$custo_por_conversao_total_tabela = array(array('Data','Custo por conversão total', array('type' => 'string', 'role' =>'annotation')));
		$t_custo_por_conversao_total  = $t_investimento/$t_conversao_total;
		foreach($investimento as &$a){
			foreach($conversao_total as &$b){
				if($a[0] == $b[0]){
					$v = ($b[1] == 0 ) ? 0 : round(($a[1]/$b[1]),2);
					array_push($custo_por_conversao_total_tabela, array($a[0], $v, 'R$ '.number_format((float)$v,2,',','.')));
				} 
			}
		}


		//projeção 

		$parcela_de_impresao = array(array('Data','Cobertura de demanda (%)', array('type' => 'string', 'role' =>'annotation')));
		$investimento_x_parcela_date = array(array('Data','Investimento', array('type' => 'string', 'role' =>'annotation'),'Projeção', array('type' => 'string', 'role' =>'annotation')));
		$cliques_x_parcela = array(array('Data','Cliques', array('type' => 'string', 'role' =>'annotation'),'Projeção', array('type' => 'string', 'role' =>'annotation')));
		$impressoes_x_parcela = array(array('Data','Impressões', array('type' => 'string', 'role' =>'annotation'),'Projeção', array('type' => 'string', 'role' =>'annotation')));
		$conversao_x_parcela = array(array('Data','Conversões', array('type' => 'string', 'role' =>'annotation'),'Projeção', array('type' => 'string', 'role' =>'annotation')));
		$conversao_total_x_parcela = array(array('Data','Conversões totais', array('type' => 'string', 'role' =>'annotation'),'Projeção', array('type' => 'string', 'role' =>'annotation')));

		$t_investimento_x_parcela = 0;
		$t_cliques_x_parcela = 0;
		$t_impressoes_x_parcela = 0;
		$t_conversao_x_parcela = 0;
		$t_conversao_total_x_parcela = 0;

		foreach($total_parcela as &$b){
			array_push($parcela_de_impresao, array($b[0], (float)$b[1], number_format((float)$b[1],2,',','.').' %'));

			foreach($investimento as &$a){
				if($a[0] == $b[0]){
					$v = ($b[1] == 0 ) ? 0 : round(($a[1]/$b[1])*100,2);
					array_push($investimento_x_parcela_date, array($a[0], $a[1], 'R$ '.number_format($a[1],2,',','.'), $v, 'R$ '.number_format((float)$v,2,',','.')));
					$t_investimento_x_parcela += $v;
				} 
			}

			foreach($cliques as &$a){
				if($a[0] == $b[0]){
					$v = ($b[1] == 0 ) ? 0 : round(($a[1]/$b[1])*100);
					array_push($cliques_x_parcela, array($a[0], (int)$a[1], number_format($a[1],0,',','.'), (int)$v , number_format($v,0,',','.')));
					$t_cliques_x_parcela += $v;
				} 
			}

			foreach($impressoes as &$a){
				if($a[0] == $b[0]){
					$v = ($b[1] == 0 ) ? 0 : round(($a[1]/$b[1])*100);
					array_push($impressoes_x_parcela, array($a[0], (int)$a[1], number_format($a[1],0,',','.'), (int)$v , number_format($v,0,',','.')));
					$t_impressoes_x_parcela += $v;
				} 
			}

			foreach($conversao as &$a){
				if($a[0] == $b[0]){
					$v = ($b[1] == 0 ) ? 0 : round(($a[1]/$b[1])*100);
					array_push($conversao_x_parcela, array($a[0], (int)$a[1], number_format($a[1],0,',','.'), (int)$v , number_format($v,0,',','.')));
					$t_conversao_x_parcela += $v;
				} 
			}

			foreach($conversao_total as &$a){
				if($a[0] == $b[0]){
					$v = ($b[1] == 0 ) ? 0 : round(($a[1]/$b[1])*100);
					array_push($conversao_total_x_parcela, array($a[0], (int)$a[1], number_format($a[1],0,',','.'), (int)$v , number_format($v,0,',','.')));
					$t_conversao_total_x_parcela += $v;
				} 
			}
		}

		return 

		"var data = google.visualization.arrayToDataTable(".json_encode($cliques_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_cliques')).draw(data, optionsCliquesData);
		document.getElementById('t_cliques').innerHTML='<h5> Total: ".number_format($t_cliques,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($impressoes_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Impressoes')).draw(data, optionsImpressoesData);
		document.getElementById('t_impressoes').innerHTML='<h5> Total: ".number_format($t_impressoes,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($investimento_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Cost')).draw(data, optionsCostData);
		document.getElementById('t_investimento').innerHTML='<h5> Total R$: ".number_format($t_investimento,2,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($cpc_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Cpc')).draw(data, optionsCpcData);
		document.getElementById('t_cpc').innerHTML='<h5> Média R$: ".number_format($t_cpc,2,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($ctr_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Ctr')).draw(data, optionsCtrData);
		document.getElementById('t_ctr').innerHTML='<h5> Média: ".number_format($t_ctr,2,',','.')."%</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($posicao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Posicao')).draw(data, optionsPosisaoData);
		document.getElementById('t_posicao').innerHTML='<h5>Média: ".number_format($t_posicao,1,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($conversao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Conversao')).draw(data, optionsConversaoData);
		document.getElementById('t_conversao').innerHTML='<h5>Total: ".number_format($t_conversao,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($custo_por_conversao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Custo_coversao')).draw(data, optionsConversaoCostData);
		document.getElementById('t_custo_por_conversao').innerHTML='<h5> Média: ".number_format($t_custo_por_conversao,2,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($taxa_de_conversao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_taxa_conversao')).draw(data, optionstaxaConversaoData);
		document.getElementById('t_taxa_conversao').innerHTML='<h5>Média: ".number_format($t_taxa_de_conversao,2,',','.')."%</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($conversao_de_visualizacao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_visualisacao')).draw(data, optionsVisualisacaoData);
		document.getElementById('t_conversao_visualizacao').innerHTML='<h5> Total: ".number_format($t_conversao_visualizacao,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($conversao_total_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_conversao_total')).draw(data, optionsConversaoTotalData);
		document.getElementById('t_conversao_total').innerHTML='<h5> Total: ".number_format($t_conversao_total,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($taxa_de_conversao_total_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_taxa_conversao_total')).draw(data, optionsTaxaConversaoTotalData);
		document.getElementById('t_taxa_conversao_total').innerHTML='<h5> Média: ".number_format($t_taxa_de_conversao_total,2,',','.')."%</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($custo_por_conversao_total_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_custo_conversao_total')).draw(data, optionsCustoConversaoTotalData);
		document.getElementById('t_custo_conversao_total').innerHTML='<h5> Média R$: ".number_format($t_custo_por_conversao_total,2,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($parcela_de_impresao).");
		new google.visualization.BarChart(document.getElementById('chart_parcela_impresao')).draw(data, optionsParcelaImpresaoData);
		document.getElementById('t_parcela_impresao').innerHTML='<h5> Média: ".number_format($t_parcela_de_impresao,2,',','.')."%</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($investimento_x_parcela_date)."); 	
		new google.visualization.BarChart(document.getElementById('chart_progecao')).draw(data, optionsprogecaoData);
		document.getElementById('t_progecao').innerHTML='<h5> Total investimento R$: ".number_format($t_investimento,2,',','.')." - Projeção R$: ".number_format($t_investimento_x_parcela,2,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($cliques_x_parcela).");
		new google.visualization.BarChart(document.getElementById('chart_progecao_cliques')).draw(data, optionsprogecaoCliquesData);
		document.getElementById('t_progecao_cliques').innerHTML='<h5> Total Cliques: ".number_format($t_cliques,0,',','.')."  - Projeção: ".number_format($t_cliques_x_parcela,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($impressoes_x_parcela).");
		new google.visualization.BarChart(document.getElementById('chart_progecao_impressoes')).draw(data, optionsprogecaoImpressoesData);
		document.getElementById('t_progecao_impressoes').innerHTML='<h5>Total impressões: ".number_format($t_impressoes,0,',','.')." - Projeção: ".number_format($t_impressoes_x_parcela,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($conversao_x_parcela).");
		new google.visualization.BarChart(document.getElementById('chart_progecao_conversoes')).draw(data, optionsprogecaoConversoesData);
		document.getElementById('t_progecao_conversoes').innerHTML='<h5>Total conversões: ".number_format($t_conversao,0,',','.')." - Projeção: ".number_format($t_conversao_x_parcela,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($conversao_total_x_parcela).");
		new google.visualization.BarChart(document.getElementById('chart_progecao_conversao_total')).draw(data, optionsprogecaoConversoesData);
		document.getElementById('t_progecao_conversao_total').innerHTML='<h5>Total conversões: ".number_format($t_conversao_total,0,',','.')." - Projeção: ".number_format($t_conversao_total_x_parcela,0,',','.')."</h5>';";

	}

	public static function weekReportold ($user, $b, $c, $parcela_impressao, $parcela_impressao_orcamento, $parcela_impressao_rank) {

		$selector = new Selector();
		$selector->fields = array('DayOfWeek', 'Clicks', 'Impressions', 'Cost', 'AveragePosition', 'Conversions', 'ViewThroughConversions', $parcela_impressao, $parcela_impressao_orcamento, $parcela_impressao_rank);
		$selector->predicates[] = new Predicate('AdvertisingChannelType', 'EQUALS', array($c));

		$reportDefinition = new ReportDefinition();
		$reportDefinition->selector = $selector;
		$reportDefinition->reportName = 'Criteria performance report';
		$reportDefinition->dateRangeType = $b;
		$reportDefinition->reportType = 'CAMPAIGN_PERFORMANCE_REPORT';
		$reportDefinition->downloadFormat = 'CSV';

		$options = array('version' => 'v201605');
		$options['skipReportHeader'] = true;
		$options['skipColumnHeader'] = true;
		$options['skipReportSummary'] = true;
		$options['includeZeroImpressions'] = true;

		$reportUtils = new ReportUtils();
		$returned = $reportUtils->DownloadReport($reportDefinition, null, $user, $options);

		$arr = array();
		$Data = str_getcsv($returned, "\n");

		foreach($Data as &$Row){
			$Row = str_getcsv($Row, ",");
			array_push($arr, $Row);
		}
		asort($arr);

		$cliques = array();
		$impressoes = array();
		$investimento = array();
		$posicao = array();
		$pontos = array();
		$conversao = array();
		$conversao_de_visualizacao = array();
		$parcela = array();

		$weekday = array('Monday'=>0,'Tuesday'=>1,'Wednesday'=>2,'Thursday'=>3,'Friday'=>4,'Saturday'=>5,'Sunday'=>6);

		foreach($arr as &$Row){
			$Row[0] = $weekday[$Row[0]];
		}
		asort ($arr);

		$weekday = array('Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado','Domingo');

		foreach($arr as &$Row){
			$Row[0] = $weekday[$Row[0]];
		}

		foreach($arr as &$Row){
			$date = $Row[0];
			array_push($cliques, array($date, (int)$Row[1]));
			array_push($impressoes, array($date, (int)$Row[2]));
			array_push($investimento, array($date, (float)($Row[3]/1000000)));
			array_push($posicao, array($date,  (float)($Row[4])));
			array_push($pontos, array($date, ((int)$Row[2]*(float)$Row[4])));
			array_push($conversao, array($date,(float)str_replace(',','',$Row[5])));
			array_push($conversao_de_visualizacao, array($date, (float)str_replace(',','',$Row[6])));

			if($Row[7] == '< 10%'){
				if($Row[9] == '> 90%'){
					array_push($parcela, array($date, (int)$Row[2], 100-(91+$Row[8])));	
				}
				array_push($parcela, array($date, (int)$Row[2], 100-($Row[8]+$Row[9])));
			}
			else{
				array_push($parcela, array($date, (int)$Row[2], (float)$Row[7]));
			}
		}

		//parcela de impressão;
		$total_de_impressoes = array();
		foreach($parcela as &$a){
			array_push($total_de_impressoes, array($a[0], ($a[2] == 0 ) ? 0 : round(($a[1]/$a[2])*100)));
		}

		$soma = function ($a, $b){
			isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] : $a[$b[0]] = $b;
			return $a;
		};

		$cliques = array_reduce($cliques, $soma);
		$impressoes = array_reduce($impressoes, $soma);
		$investimento = array_reduce($investimento, $soma);
		$posicao = array_reduce($posicao, $soma);
		$pontos = array_reduce($pontos, $soma);
		$conversao = array_reduce($conversao, $soma);
		$conversao_de_visualizacao = array_reduce($conversao_de_visualizacao, $soma);
		$total_de_impressoes = array_reduce($total_de_impressoes, $soma);

		$posicao_real = array();
		foreach ($pontos as &$p) {
			foreach ($impressoes as &$i) {
				if($i[0] == $p[0]){

					array_push($posicao_real, array($i[0], round((float)($p[1]/$i[1]),1)));
				}
			}
		}

		$cpc = array();
		foreach($investimento as &$a){
			foreach($cliques as &$b){
				if($a[0] == $b[0]){
					array_push($cpc, array($a[0], round($a[1]/$b[1], 2)));
				}
			}	
		}

		$ctr = array();
		foreach($cliques as &$a){
			foreach($impressoes as &$b){
				if($a[0] == $b[0]){
					array_push($ctr, array($a[0], round(($a[1]/$b[1])*100, 2)));
				} 
			}
		}

		$custo_por_conversao = array();
		foreach($investimento as &$a){
			foreach($conversao as &$b){
				if($a[0] == $b[0]){
					array_push($custo_por_conversao, array($a[0], round(($a[1]/$b[1]), 2)));
				} 
			}
		}

		$conversao_total = array();
		foreach($conversao_de_visualizacao as &$a){
			foreach($conversao as &$b){
				if($a[0] == $b[0]){
					array_push($conversao_total, array($a[0], ($a[1]+$b[1])));
				} 
			}
		}

		$custo_por_conversao_total = array();
		foreach($investimento as &$a){
			foreach($conversao_total as &$b){
				if($a[0] == $b[0]){
					array_push($custo_por_conversao_total, array($a[0], round(($a[1]/$b[1]), 2)));
				} 
			}
		}

		$taxa_de_conversao = array();
		foreach($cliques as &$a){
			foreach($conversao as &$b){
				if($a[0] == $b[0]){
					array_push($taxa_de_conversao, array($a[0], round(($b[1]/$a[1])*100, 2)));
				} 
			}
		}

		$taxa_de_conversao_total = array();
		foreach($cliques as &$a){
			foreach($conversao_total as &$b){
				if($a[0] == $b[0]){
					array_push($taxa_de_conversao_total, array($a[0], round(($b[1]/$a[1])*100, 2)));
				} 
			}
		}
		
		$total_parcela_hour = array();
		$t_impressoes = 0;
		$t_parcela = 0;
		foreach($impressoes as &$a){
			foreach($total_de_impressoes as &$b){
				if($a[0] == $b[0]){
					array_push($total_parcela_hour, array($a[0], round(($a[1]/$b[1])*100, 2)));
					$t_impressoes += $a[1];
					$t_parcela += $b[1];
				} 
			}
		}
		$t_parcela_de_impresao = ($t_impressoes/$t_parcela)*100;

		//este bloco controi arrays individuais da consulta para graficos
		//author adriel Pinheiro

		$cliques_tabela = array(array('Data', 'Cliques',array('type' => 'string', 'role' =>'annotation')));
		$t_cliques = 0;
		foreach($cliques as &$Row){
			array_push($cliques_tabela, array($Row[0], (int)$Row[1], number_format((int)$Row[1],0,',','.')));
			$t_cliques += $Row[1];
		}


		$impressoes_tabela = array(array('Data', 'Impressões', array('type' => 'string', 'role' =>'annotation')));
		$t_impressoes = 0;
		foreach($impressoes as &$Row){
			array_push($impressoes_tabela, array($Row[0], (int)$Row[1], number_format((int)$Row[1],0,',','.')));
			$t_impressoes += $Row[1];
		}

		$investimento_tabela = array(array('Data', 'Investimento', array('type' => 'string', 'role' =>'annotation')));
		$t_investimento = 0;
		foreach($investimento as &$Row){
			array_push($investimento_tabela, array($Row[0], (float)$Row[1], 'R$ '.number_format((float)$Row[1],2,',','.')));
			$t_investimento += $Row[1];
		}

		$cpc_tabela = array(array('Data', 'CPC', array('type' => 'string', 'role' =>'annotation')));
		$t_cpc = $t_investimento/$t_cliques;
		foreach($cpc as &$Row){
			array_push($cpc_tabela, array($Row[0], (float)$Row[1], 'R$ '.number_format((float)$Row[1],2,',','.')));
		}

		$ctr_tabela = array(array('Data', 'CTR %', array('type' => 'string', 'role' =>'annotation')));
		$t_ctr = ($t_cliques/$t_impressoes)*100;
		foreach($ctr as &$Row){
			array_push($ctr_tabela, array($Row[0], (float)$Row[1], number_format((float)$Row[1],2,',','.').' %'));
		}

		$posicao_tabela = array(array('Data', 'Posição média', array('type' => 'string', 'role' =>'annotation')));
		foreach($posicao_real as &$Row){
			array_push($posicao_tabela, array($Row[0], $Row[1], number_format($Row[1],1,',','.')));
		}


		$t_posicao = 0;
		$t_pontos = 0;
		foreach($pontos as &$Row){
			$t_pontos += $Row[1];
		}

		$t_posicao = $t_pontos/$t_impressoes;

		$conversao_tabela = array(array('Data','Conversões', array('type' => 'string', 'role' =>'annotation')));
		$t_conversao = 0;
		foreach($conversao as $Row){
			array_push($conversao_tabela, array($Row[0], (int)$Row[1], number_format(((int)$Row[1]),0,',','.')));
			$t_conversao += $Row[1];
		}

		$custo_por_conversao_tabela = array(array('Data','Custo por conversão total', array('type' => 'string', 'role' =>'annotation')));
		$t_custo_por_conversao  = $t_investimento/$t_conversao;
		foreach($custo_por_conversao as &$Row){
			array_push($custo_por_conversao_tabela, array($Row[0], (float)$Row[1], 'R$ '.number_format((float)$Row[1],2,',','.')));
		}

		$taxa_de_conversao_tabela = array(array('Data','Taxa de conversão %', array('type' => 'string', 'role' =>'annotation')));
		$t_taxa_de_conversao = ($t_conversao/$t_cliques)*100;
		foreach($taxa_de_conversao as &$Row){
			array_push($taxa_de_conversao_tabela, array($Row[0], (float)$Row[1], number_format((float)$Row[1],2,',','.').' %'));
		}

		$conversao_de_visualizacao_tabela = array(array('Data','Conversões de visualização', array('type' => 'string', 'role' =>'annotation')));
		$t_conversao_visualizacao = 0;
		foreach($conversao_de_visualizacao as &$Row){
			array_push($conversao_de_visualizacao_tabela, array($Row[0], (float)$Row[1], number_format((float)$Row[1],0,',','.')));
			$t_conversao_visualizacao += $Row[1];
		}

		$conversao_total_tabela = array(array('Data','Total de conversões', array('type' => 'string', 'role' =>'annotation')));
		$t_conversao_total = 0;
		foreach($conversao_total as &$Row){
			array_push($conversao_total_tabela, array($Row[0], $Row[1], number_format((float)$Row[1],0,',','.')));
			$t_conversao_total += $Row[1];
		}

		$taxa_de_conversao_total_tabela = array(array('Data','Taxa de conversão total %', array('type' => 'string', 'role' =>'annotation')));
		$t_taxa_de_conversao_total = ($t_conversao_total/$t_cliques)*100;
		foreach($taxa_de_conversao_total as &$Row){
			array_push($taxa_de_conversao_total_tabela, array($Row[0], (float)$Row[1], number_format((float)$Row[1],2,',','.').' %'));
		}

		$custo_por_conversao_total_tabela = array(array('Data','Custo por conversão total', array('type' => 'string', 'role' =>'annotation')));
		$t_custo_por_conversao_total  = $t_investimento/$t_conversao_total;
		foreach($investimento as &$a){
			foreach($conversao_total as &$b){
				if($a[0] == $b[0]){
					$v = round(($a[1]/$b[1]),2);
					array_push($custo_por_conversao_total_tabela, array($a[0], $v, 'R$ '.number_format((float)$v,2,',','.')));
				} 
			}
		}

		//projeção 
		$parcela_de_impresao = array(array('Data','Cobertura de demanda (%)', array('type' => 'string', 'role' =>'annotation')));
		$investimento_x_parcela_hour = array(array('Data','Investimento', array('type' => 'string', 'role' =>'annotation'),'Projeção', array('type' => 'string', 'role' =>'annotation')));
		$cliques_x_parcela = array(array('Data','Cliques', array('type' => 'string', 'role' =>'annotation'),'Projeção', array('type' => 'string', 'role' =>'annotation')));
		$impressoes_x_parcela = array(array('Data','Impressões', array('type' => 'string', 'role' =>'annotation'),'Projeção', array('type' => 'string', 'role' =>'annotation')));
		$conversao_x_parcela = array(array('Data','Conversões', array('type' => 'string', 'role' =>'annotation'),'Projeção', array('type' => 'string', 'role' =>'annotation')));
		$conversao_total_x_parcela = array(array('Data','Conversões totais', array('type' => 'string', 'role' =>'annotation'),'Projeção', array('type' => 'string', 'role' =>'annotation')));



		$t_investimento_x_parcela = 0;
		$t_cliques_x_parcela = 0;
		$t_impressoes_x_parcela = 0;
		$t_conversao_x_parcela = 0;
		$t_conversao_total_x_parcela = 0;

		foreach($total_parcela_hour as &$b){
			array_push($parcela_de_impresao, array($b[0], (float)$b[1], number_format((float)$b[1],2,',','.').' %'));

			foreach($investimento as &$a){
				if($a[0] == $b[0]){
					$v = round(($a[1]/$b[1])*100,2);
					array_push($investimento_x_parcela_hour, array($a[0], $a[1], 'R$ '.number_format($a[1],2,',','.'), $v, 'R$ '.number_format((float)$v,2,',','.')));
					$t_investimento_x_parcela += $v;
				} 
			}

			foreach($cliques as &$a){
				if($a[0] == $b[0]){
					$v = round(($a[1]/$b[1])*100);
					array_push($cliques_x_parcela, array($a[0], (int)$a[1], number_format($a[1],0,',','.'), (int)$v , number_format($v,0,',','.')));
					$t_cliques_x_parcela += $v;
				} 
			}

			foreach($impressoes as &$a){
				if($a[0] == $b[0]){
					$v = round(($a[1]/$b[1])*100);
					array_push($impressoes_x_parcela, array($a[0], (int)$a[1], number_format($a[1],0,',','.'), (int)$v , number_format($v,0,',','.')));
					$t_impressoes_x_parcela += $v;
				} 
			}

			foreach($conversao as &$a){
				if($a[0] == $b[0]){
					$v = round(($a[1]/$b[1])*100);
					array_push($conversao_x_parcela, array($a[0], (int)$a[1], number_format($a[1],0,',','.'), (int)$v , number_format($v,0,',','.')));
					$t_conversao_x_parcela += $v;
				} 
			}

			foreach($conversao_total as &$a){
				if($a[0] == $b[0]){
					$v = round(($a[1]/$b[1])*100);
					array_push($conversao_total_x_parcela, array($a[0], (int)$a[1], number_format($a[1],0,',','.'), (int)$v , number_format($v,0,',','.')));
					$t_conversao_total_x_parcela += $v;
				} 
			}
		}

		return 

		"var data = google.visualization.arrayToDataTable(".json_encode($cliques_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_cliques_week')).draw(data, optionsCliquesWeek);
		document.getElementById('t_cliques_week').innerHTML='<h5> Total: ".number_format($t_cliques,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($impressoes_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Impressoes_week')).draw(data, optionsImpressoesWeek);
		document.getElementById('t_impressoes_week').innerHTML='<h5> Total: ".number_format($t_impressoes,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($investimento_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Cost_week')).draw(data, optionsCostWeek);
		document.getElementById('t_investimento_week').innerHTML='<h5> Total R$: ".number_format($t_investimento,2,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($cpc_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Cpc_week')).draw(data, optionsCpcWeek);
		document.getElementById('t_cpc_week').innerHTML='<h5> Média R$: ".number_format($t_cpc,2,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($ctr_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Ctr_week')).draw(data, optionsCtrWeek);
		document.getElementById('t_ctr_week').innerHTML='<h5> Média: ".number_format($t_ctr,2,',','.')."%</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($posicao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Posicao_week')).draw(data, optionsPosisaoWeek);
		document.getElementById('t_posicao_week').innerHTML='<h5>Média: ".number_format($t_posicao,1,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($conversao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Conversao_week')).draw(data, optionsConversaoWeek);
		document.getElementById('t_conversao_week').innerHTML='<h5>Total: ".number_format($t_conversao,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($custo_por_conversao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Custo_coversao_week')).draw(data, optionsConversaoCostWeek);
		document.getElementById('t_custo_por_conversao_week').innerHTML='<h5> Média: ".number_format($t_custo_por_conversao,2,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($taxa_de_conversao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_taxa_conversao_week')).draw(data, optionstaxaConversaoWeek);
		document.getElementById('t_taxa_conversao_week').innerHTML='<h5>Média: ".number_format($t_taxa_de_conversao,2,',','.')."%</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($conversao_de_visualizacao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_visualisacao_week')).draw(data, optionsVisualisacaoWeek);
		document.getElementById('t_conversao_visualizacao_week').innerHTML='<h5> Total: ".number_format($t_conversao_visualizacao,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($conversao_total_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_conversao_total_week')).draw(data, optionsConversaoTotalWeek);
		document.getElementById('t_conversao_total_week').innerHTML='<h5> Total: ".number_format($t_conversao_total,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($taxa_de_conversao_total_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_taxa_conversao_total_week')).draw(data, optionsTaxaConversaoTotalWeek);
		document.getElementById('t_taxa_conversao_total_week').innerHTML='<h5> Média: ".number_format($t_taxa_de_conversao_total,2,',','.')."%</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($custo_por_conversao_total_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_custo_conversao_total_week')).draw(data, optionsCustoConversaoTotalWeek);
		document.getElementById('t_custo_conversao_total_week').innerHTML='<h5> Média R$: ".number_format($t_custo_por_conversao_total,2,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($parcela_de_impresao).");
		new google.visualization.BarChart(document.getElementById('chart_parcela_impresao_week')).draw(data, optionsParcelaImpresaoWeek);
		document.getElementById('t_parcela_impresao_week').innerHTML='<h5> Média: ".number_format($t_parcela_de_impresao,2,',','.')."%</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($investimento_x_parcela_hour)."); 	
		new google.visualization.BarChart(document.getElementById('chart_progecao_week')).draw(data, optionsprogecaoWeek);
		document.getElementById('t_progecao_week').innerHTML='<h5> Total investimento R$: ".number_format($t_investimento,2,',','.')." - Projeção R$: ".number_format($t_investimento_x_parcela,2,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($cliques_x_parcela).");
		new google.visualization.BarChart(document.getElementById('chart_progecao_cliques_week')).draw(data, optionsprogecaoCliquesWeek);
		document.getElementById('t_progecao_cliques_week').innerHTML='<h5> Total Cliques: ".number_format($t_cliques,0,',','.')." - Projeção: ".number_format($t_cliques_x_parcela,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($impressoes_x_parcela).");
		new google.visualization.BarChart(document.getElementById('chart_progecao_impressoes_week')).draw(data, optionsprogecaoImpressoesWeek);
		document.getElementById('t_progecao_impressoes_week').innerHTML='<h5>Total impressões: ".number_format($t_impressoes,0,',','.')." - Projeção: ".number_format($t_impressoes_x_parcela,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($conversao_x_parcela).");
		new google.visualization.BarChart(document.getElementById('chart_progecao_conversoes_week')).draw(data, optionsprogecaoConversoesWeek);
		document.getElementById('t_progecao_conversoes_week').innerHTML='<h5>Total conversões: ".number_format($t_conversao,0,',','.')." - Projeção: ".number_format($t_conversao_x_parcela,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($conversao_total_x_parcela).");
		new google.visualization.BarChart(document.getElementById('chart_progecao_conversao_total_week')).draw(data, optionsprogecaoConversoesWeek);
		document.getElementById('t_progecao_conversao_total_week').innerHTML='<h5>Total conversões: ".number_format($t_conversao_total,0,',','.')." - Projeção: ".number_format($t_conversao_total_x_parcela,0,',','.')."</h5>';";

	}

	public static function hourReportold ($user, $b, $c, $parcela_impressao, $parcela_impressao_orcamento, $parcela_impressao_rank) {

		$selector = new Selector();
		$selector->fields = array('HourOfDay', 'Clicks', 'Impressions', 'Cost', 'AveragePosition', 'Conversions', 'ViewThroughConversions', $parcela_impressao, $parcela_impressao_orcamento, $parcela_impressao_rank);
		$selector->predicates[] = new Predicate('AdvertisingChannelType', 'EQUALS', array($c));

		$reportDefinition = new ReportDefinition();
		$reportDefinition->selector = $selector;
		$reportDefinition->reportName = 'Criteria performance report';
		$reportDefinition->dateRangeType = $b;
		$reportDefinition->reportType = 'CAMPAIGN_PERFORMANCE_REPORT';
		$reportDefinition->downloadFormat = 'CSV';

		$options = array('version' => 'v201605');
		$options['skipReportHeader'] = true;
		$options['skipColumnHeader'] = true;
		$options['skipReportSummary'] = true;

		$filePath =null;

		$reportUtils = new ReportUtils();
		$returned = $reportUtils->DownloadReport($reportDefinition, $filePath, $user, $options);

		$arr = array();
		$Data = str_getcsv($returned, "\n");
		foreach($Data as &$Row){
			$Row = str_getcsv($Row, ",");
			array_push($arr, $Row);
		}

		asort($arr);

		$cliques = array();
		$impressoes = array();
		$investimento = array();
		$posicao = array();
		$pontos = array();
		$conversao = array();
		$conversao_de_visualizacao = array();
		$parcela = array();

		foreach($arr as &$Row){
			$date =(int)$Row[0];
			array_push($cliques, array($date, (int)$Row[1]));
			array_push($impressoes, array($date, (int)$Row[2]));
			array_push($investimento, array($date, (float)($Row[3]/1000000)));
			array_push($posicao, array($date,  (float)($Row[4])));
			array_push($pontos, array($date, ((int)$Row[2]*(float)$Row[4])));
			array_push($conversao, array($date,(float)str_replace(',','',$Row[5])));
			array_push($conversao_de_visualizacao, array($date, (float)str_replace(',','',$Row[6])));

			if($Row[7] == '< 10%'){
				if($Row[9] == '> 90%'){
					array_push($parcela, array($date, (int)$Row[2], 100-(91+$Row[8])));	
				}
				array_push($parcela, array($date, (int)$Row[2], 100-($Row[8]+$Row[9])));
			}
			else{
				array_push($parcela, array($date, (int)$Row[2], (float)$Row[7]));
			}
		}

		//parcela de impressão;
		$total_de_impressoes = array();
		foreach($parcela as &$a){
			array_push($total_de_impressoes, array($a[0], ($a[2] == 0 ) ? 0 : round(($a[1]/$a[2])*100)));
		}

		$soma = function ($a, $b){
			isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] : $a[$b[0]] = $b;
			return $a;
		};

		$cliques = array_reduce($cliques, $soma);
		$impressoes = array_reduce($impressoes, $soma);
		$investimento = array_reduce($investimento, $soma);
		$posicao = array_reduce($posicao, $soma);
		$pontos = array_reduce($pontos, $soma);
		$conversao = array_reduce($conversao, $soma);
		$conversao_de_visualizacao = array_reduce($conversao_de_visualizacao, $soma);
		$total_de_impressoes = array_reduce($total_de_impressoes, $soma);

		$posicao_real = array();
		foreach ($pontos as &$p) {
			foreach ($impressoes as &$i) {
				if($i[0] == $p[0]){

					array_push($posicao_real, array($i[0], round((float)($p[1]/$i[1]),1)));
				}
			}
		}

		$cpc = array();
		foreach($investimento as &$a){
			foreach($cliques as &$b){
				if($a[0] == $b[0]){
					array_push($cpc, array($a[0], round($a[1]/$b[1], 2)));
				}
			}	
		}

		$ctr = array();
		foreach($cliques as &$a){
			foreach($impressoes as &$b){
				if($a[0] == $b[0]){
					array_push($ctr, array($a[0], round(($a[1]/$b[1])*100, 2)));
				} 
			}
		}

		$custo_por_conversao = array();
		foreach($investimento as &$a){
			foreach($conversao as &$b){
				if($a[0] == $b[0]){
					array_push($custo_por_conversao, array($a[0], ($b[1] == 0 ) ? 0 : round(($a[1]/$b[1]), 2)));
				} 
			}
		}

		$conversao_total = array();
		foreach($conversao_de_visualizacao as &$a){
			foreach($conversao as &$b){
				if($a[0] == $b[0]){
					array_push($conversao_total, array($a[0], ($a[1]+$b[1])));
				} 
			}
		}

		$custo_por_conversao_total = array();
		foreach($investimento as &$a){
			foreach($conversao_total as &$b){
				if($a[0] == $b[0]){
					array_push($custo_por_conversao_total, array($a[0], ($b[1] == 0 ) ? 0 : round(($a[1]/$b[1]), 2)));
				} 
			}
		}

		$taxa_de_conversao = array();
		foreach($cliques as &$a){
			foreach($conversao as &$b){
				if($a[0] == $b[0]){
					array_push($taxa_de_conversao, array($a[0], round(($b[1]/$a[1])*100, 2)));
				} 
			}
		}

		$taxa_de_conversao_total = array();
		foreach($cliques as &$a){
			foreach($conversao_total as &$b){
				if($a[0] == $b[0]){
					array_push($taxa_de_conversao_total, array($a[0], round(($b[1]/$a[1])*100, 2)));
				} 
			}
		}
		
		$total_parcela_hour = array();
		$t_impressoes = 0;
		$t_parcela = 0;
		foreach($impressoes as &$a){
			foreach($total_de_impressoes as &$b){
				if($a[0] == $b[0]){
					array_push($total_parcela_hour, array($a[0], round(($a[1]/$b[1])*100, 2)));
					$t_impressoes += $a[1];
					$t_parcela += $b[1];
				} 
			}
		}
		$t_parcela_de_impresao = ($t_impressoes/$t_parcela)*100;

		//este bloco controi arrays individuais da consulta para graficos
		//author adriel Pinheiro

		$cliques_tabela = array(array('Data', 'Cliques',array('type' => 'string', 'role' =>'annotation')));
		$t_cliques = 0;
		foreach($cliques as &$Row){
			array_push($cliques_tabela, array($Row[0], (int)$Row[1], number_format((int)$Row[1],0,',','.')));
			$t_cliques += $Row[1];
		}


		$impressoes_tabela = array(array('Data', 'Impressões', array('type' => 'string', 'role' =>'annotation')));
		$t_impressoes = 0;
		foreach($impressoes as &$Row){
			array_push($impressoes_tabela, array($Row[0], (int)$Row[1], number_format((int)$Row[1],0,',','.')));
			$t_impressoes += $Row[1];
		}

		$investimento_tabela = array(array('Data', 'Investimento', array('type' => 'string', 'role' =>'annotation')));
		$t_investimento = 0;
		foreach($investimento as &$Row){
			array_push($investimento_tabela, array($Row[0], (float)$Row[1], 'R$ '.number_format((float)$Row[1],2,',','.')));
			$t_investimento += $Row[1];
		}

		$cpc_tabela = array(array('Data', 'CPC', array('type' => 'string', 'role' =>'annotation')));
		$t_cpc = $t_investimento/$t_cliques;
		foreach($cpc as &$Row){
			array_push($cpc_tabela, array($Row[0], (float)$Row[1], 'R$ '.number_format((float)$Row[1],2,',','.')));
		}

		$ctr_tabela = array(array('Data', 'CTR %', array('type' => 'string', 'role' =>'annotation')));
		$t_ctr = ($t_cliques/$t_impressoes)*100;
		foreach($ctr as &$Row){
			array_push($ctr_tabela, array($Row[0], (float)$Row[1], number_format((float)$Row[1],2,',','.').' %'));
		}

		$posicao_tabela = array(array('Data', 'Posição média', array('type' => 'string', 'role' =>'annotation')));
		foreach($posicao_real as &$Row){
			array_push($posicao_tabela, array($Row[0], $Row[1], number_format($Row[1],1,',','.')));
		}


		$t_posicao = 0;
		$t_pontos = 0;
		foreach($pontos as &$Row){
			$t_pontos += $Row[1];
		}

		$t_posicao = $t_pontos/$t_impressoes;

		$conversao_tabela = array(array('Data','Conversões', array('type' => 'string', 'role' =>'annotation')));
		$t_conversao = 0;
		foreach($conversao as $Row){
			array_push($conversao_tabela, array($Row[0], (int)$Row[1], number_format(((int)$Row[1]),0,',','.')));
			$t_conversao += $Row[1];
		}

		$custo_por_conversao_tabela = array(array('Data','Custo por conversão total', array('type' => 'string', 'role' =>'annotation')));
		$t_custo_por_conversao  = $t_investimento/$t_conversao;
		foreach($custo_por_conversao as &$Row){
			array_push($custo_por_conversao_tabela, array($Row[0], (float)$Row[1], 'R$ '.number_format((float)$Row[1],2,',','.')));
		}

		$taxa_de_conversao_tabela = array(array('Data','Taxa de conversão %', array('type' => 'string', 'role' =>'annotation')));
		$t_taxa_de_conversao = ($t_conversao/$t_cliques)*100;
		foreach($taxa_de_conversao as &$Row){
			array_push($taxa_de_conversao_tabela, array($Row[0], (float)$Row[1], number_format((float)$Row[1],2,',','.').' %'));
		}

		$conversao_de_visualizacao_tabela = array(array('Data','Conversões de visualização', array('type' => 'string', 'role' =>'annotation')));
		$t_conversao_visualizacao = 0;
		foreach($conversao_de_visualizacao as &$Row){
			array_push($conversao_de_visualizacao_tabela, array($Row[0], (float)$Row[1], number_format((float)$Row[1],0,',','.')));
			$t_conversao_visualizacao += $Row[1];
		}

		$conversao_total_tabela = array(array('Data','Total de conversões', array('type' => 'string', 'role' =>'annotation')));
		$t_conversao_total = 0;
		foreach($conversao_total as &$Row){
			array_push($conversao_total_tabela, array($Row[0], $Row[1], number_format((float)$Row[1],0,',','.')));
			$t_conversao_total += $Row[1];
		}

		$taxa_de_conversao_total_tabela = array(array('Data','Taxa de conversão total %', array('type' => 'string', 'role' =>'annotation')));
		$t_taxa_de_conversao_total = ($t_conversao_total/$t_cliques)*100;
		foreach($taxa_de_conversao_total as &$Row){
			array_push($taxa_de_conversao_total_tabela, array($Row[0], (float)$Row[1], number_format((float)$Row[1],2,',','.').' %'));
		}

		$custo_por_conversao_total_tabela = array(array('Data','Custo por conversão total', array('type' => 'string', 'role' =>'annotation')));
		$t_custo_por_conversao_total  = $t_investimento/$t_conversao_total;
		foreach($investimento as &$a){
			foreach($conversao_total as &$b){
				if($a[0] == $b[0]){
					$v = ($b[1] == 0 ) ? 0 : round(($a[1]/$b[1]),2);
					array_push($custo_por_conversao_total_tabela, array($a[0], $v, 'R$ '.number_format((float)$v,2,',','.')));
				} 
			}
		}

		//projeção 
		$parcela_de_impresao = array(array('Data','Cobertura de demanda (%)', array('type' => 'string', 'role' =>'annotation')));
		$investimento_x_parcela_hour = array(array('Data','Investimento', array('type' => 'string', 'role' =>'annotation'),'Projeção', array('type' => 'string', 'role' =>'annotation')));
		$cliques_x_parcela = array(array('Data','Cliques', array('type' => 'string', 'role' =>'annotation'),'Projeção', array('type' => 'string', 'role' =>'annotation')));
		$impressoes_x_parcela = array(array('Data','Impressões', array('type' => 'string', 'role' =>'annotation'),'Projeção', array('type' => 'string', 'role' =>'annotation')));
		$conversao_x_parcela = array(array('Data','Conversões', array('type' => 'string', 'role' =>'annotation'),'Projeção', array('type' => 'string', 'role' =>'annotation')));
		$conversao_total_x_parcela = array(array('Data','Conversões totais', array('type' => 'string', 'role' =>'annotation'),'Projeção', array('type' => 'string', 'role' =>'annotation')));



		$t_investimento_x_parcela = 0;
		$t_cliques_x_parcela = 0;
		$t_impressoes_x_parcela = 0;
		$t_conversao_x_parcela = 0;
		$t_conversao_total_x_parcela = 0;

		foreach($total_parcela_hour as &$b){
			array_push($parcela_de_impresao, array($b[0], (float)$b[1], number_format((float)$b[1],2,',','.').' %'));

			foreach($investimento as &$a){
				if($a[0] == $b[0]){
					$v = round(($a[1]/$b[1])*100,2);
					array_push($investimento_x_parcela_hour, array($a[0], $a[1], 'R$ '.number_format($a[1],2,',','.'), $v, 'R$ '.number_format((float)$v,2,',','.')));
					$t_investimento_x_parcela += $v;
				} 
			}

			foreach($cliques as &$a){
				if($a[0] == $b[0]){
					$v = round(($a[1]/$b[1])*100);
					array_push($cliques_x_parcela, array($a[0], (int)$a[1], number_format($a[1],0,',','.'), (int)$v , number_format($v,0,',','.')));
					$t_cliques_x_parcela += $v;
				} 
			}

			foreach($impressoes as &$a){
				if($a[0] == $b[0]){
					$v = round(($a[1]/$b[1])*100);
					array_push($impressoes_x_parcela, array($a[0], (int)$a[1], number_format($a[1],0,',','.'), (int)$v , number_format($v,0,',','.')));
					$t_impressoes_x_parcela += $v;
				} 
			}

			foreach($conversao as &$a){
				if($a[0] == $b[0]){
					$v = round(($a[1]/$b[1])*100);
					array_push($conversao_x_parcela, array($a[0], (int)$a[1], number_format($a[1],0,',','.'), (int)$v , number_format($v,0,',','.')));
					$t_conversao_x_parcela += $v;
				} 
			}

			foreach($conversao_total as &$a){
				if($a[0] == $b[0]){
					$v = round(($a[1]/$b[1])*100);
					array_push($conversao_total_x_parcela, array($a[0], (int)$a[1], number_format($a[1],0,',','.'), (int)$v , number_format($v,0,',','.')));
					$t_conversao_total_x_parcela += $v;
				} 
			}
		}

		return 

		"var data = google.visualization.arrayToDataTable(".json_encode($cliques_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_cliques_hour')).draw(data, optionsCliquesHour);
		document.getElementById('t_cliques_hour').innerHTML='<h5> Total: ".number_format($t_cliques,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($impressoes_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Impressoes_hour')).draw(data, optionsImpressoesHour);
		document.getElementById('t_impressoes_hour').innerHTML='<h5> Total: ".number_format($t_impressoes,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($investimento_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Cost_hour')).draw(data, optionsCostHour);
		document.getElementById('t_investimento_hour').innerHTML='<h5> Total R$: ".number_format($t_investimento,2,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($cpc_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Cpc_hour')).draw(data, optionsCpcHour);
		document.getElementById('t_cpc_hour').innerHTML='<h5> Média R$: ".number_format($t_cpc,2,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($ctr_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Ctr_hour')).draw(data, optionsCtrHour);
		document.getElementById('t_ctr_hour').innerHTML='<h5> Média: ".number_format($t_ctr,2,',','.')."%</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($posicao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Posicao_hour')).draw(data, optionsPosisaoHour);
		document.getElementById('t_posicao_hour').innerHTML='<h5>Média: ".number_format($t_posicao,1,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($conversao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Conversao_hour')).draw(data, optionsConversaoHour);
		document.getElementById('t_conversao_hour').innerHTML='<h5>Total: ".number_format($t_conversao,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($custo_por_conversao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Custo_coversao_hour')).draw(data, optionsConversaoCostHour);
		document.getElementById('t_custo_por_conversao_hour').innerHTML='<h5> Média: ".number_format($t_custo_por_conversao,2,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($taxa_de_conversao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_taxa_conversao_hour')).draw(data, optionstaxaConversaoHour);
		document.getElementById('t_taxa_conversao_hour').innerHTML='<h5>Média: ".number_format($t_taxa_de_conversao,2,',','.')."%</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($conversao_de_visualizacao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_visualisacao_hour')).draw(data, optionsVisualisacaoHour);
		document.getElementById('t_conversao_visualizacao_hour').innerHTML='<h5> Total: ".number_format($t_conversao_visualizacao,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($conversao_total_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_conversao_total_hour')).draw(data, optionsConversaoTotalHour);
		document.getElementById('t_conversao_total_hour').innerHTML='<h5> Total: ".number_format($t_conversao_total,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($taxa_de_conversao_total_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_taxa_conversao_total_hour')).draw(data, optionsTaxaConversaoTotalHour);
		document.getElementById('t_taxa_conversao_total_hour').innerHTML='<h5> Média: ".number_format($t_taxa_de_conversao_total,2,',','.')."%</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($custo_por_conversao_total_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_custo_conversao_total_hour')).draw(data, optionsConversaoTotalHour);
		document.getElementById('t_custo_conversao_total_hour').innerHTML='<h5> Média R$: ".number_format($t_custo_por_conversao_total,2,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($parcela_de_impresao).");
		new google.visualization.BarChart(document.getElementById('chart_parcela_impresao_hour')).draw(data, optionsParcelaImpresaoHour);
		document.getElementById('t_parcela_impresao_hour').innerHTML='<h5> Média: ".number_format($t_parcela_de_impresao,2,',','.')."%</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($investimento_x_parcela_hour)."); 	
		new google.visualization.BarChart(document.getElementById('chart_progecao_hour')).draw(data, optionsprogecaoHour);
		document.getElementById('t_progecao_hour').innerHTML='<h5> Total investimento R$: ".number_format($t_investimento,2,',','.')." - Projeção R$: ".number_format($t_investimento_x_parcela,2,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($cliques_x_parcela).");
		new google.visualization.BarChart(document.getElementById('chart_progecao_cliques_hour')).draw(data, optionsprogecaoCliquesHour);
		document.getElementById('t_progecao_cliques_hour').innerHTML='<h5> Total Cliques: ".number_format($t_cliques,0,',','.')." - Projeção: ".number_format($t_cliques_x_parcela,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($impressoes_x_parcela).");
		new google.visualization.BarChart(document.getElementById('chart_progecao_impressoes_hour')).draw(data, optionsprogecaoImpressoesHour);
		document.getElementById('t_progecao_impressoes_hour').innerHTML='<h5>Total impressões: ".number_format($t_impressoes,0,',','.')." - Projeção: ".number_format($t_impressoes_x_parcela,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($conversao_x_parcela).");
		new google.visualization.BarChart(document.getElementById('chart_progecao_conversoes_hour')).draw(data, optionsprogecaoConversoesHour);
		document.getElementById('t_progecao_conversoes_hour').innerHTML='<h5>Total conversões: ".number_format($t_conversao,0,',','.')." - Projeção: ".number_format($t_conversao_x_parcela,0,',','.')."</h5>';

		var data = google.visualization.arrayToDataTable(".json_encode($conversao_total_x_parcela).");
		new google.visualization.BarChart(document.getElementById('chart_progecao_conversao_total_hour')).draw(data, optionsprogecaoConversoesHour);
		document.getElementById('t_progecao_conversao_total_hour').innerHTML='<h5>Total conversões: ".number_format($t_conversao_total,0,',','.')." - Projeção: ".number_format($t_conversao_total_x_parcela,0,',','.')."</h5>';";

	}

	public static function geoReportold ($user, $b, $c, $r) {

		if($r == 'P'){
			$query = array('CountryCriteriaId', 'Clicks', 'Impressions', 'Cost', 'AveragePosition', 'Conversions', 'ViewThroughConversions');
		}
		if ($r == 'E'){
			$query = array('CountryCriteriaId', 'RegionCriteriaId', 'Clicks', 'Impressions', 'Cost', 'AveragePosition', 'Conversions', 'ViewThroughConversions');
		}
		if($r == 'C'){
			$query = array('CountryCriteriaId', 'RegionCriteriaId', 'CityCriteriaId', 'Clicks', 'Impressions', 'Cost', 'AveragePosition', 'Conversions', 'ViewThroughConversions');
		}

		$selector = new Selector();
		$selector->fields = $query;

		$reportDefinition = new ReportDefinition();
		$reportDefinition->selector = $selector;
		$reportDefinition->reportName = 'Criteria performance report #';
		$reportDefinition->dateRangeType = $b;
		$reportDefinition->reportType = 'GEO_PERFORMANCE_REPORT';
		$reportDefinition->downloadFormat = 'CSV';

		$options = array('version' => 'v201605');
		$options['skipReportHeader'] = true;
		$options['skipColumnHeader'] = true;
		$options['skipReportSummary'] = true;

		$reportUtils = new ReportUtils();
		$returned = $reportUtils->DownloadReport($reportDefinition, null, $user, $options);

		$arr = array();
		$Data = str_getcsv($returned, "\n");
		foreach($Data as &$Row){
			$Row = str_getcsv($Row, ",");
			array_push($arr, $Row);
		}

		$find = array();
		$region = array();
		foreach($arr as &$value){
			$value[(count($value)-7)] == ' --' ? $value[(count($value)-7)]= '1' : $value[(count($value)-7)];
			array_push($find, $value[(count($value)-7)]);
			array_push($region, array_slice($value,(count($value)-7)));
		}


		$regions = \Relatorio\Models\Cidade::find($find);
		$names = array();

		foreach($regions as $row){
			$id = $row->id;
			$nome = $row->nome; 
			$names[$id] = str_replace('State of ','',$nome);
		}

		

		$cidades = array();
		$countC=0;
		foreach($region as &$value){
			array_push($cidades, array($value[0],$value[3], $names[$value[0]]));
			$value[0] = $names[(int)$value[0]];
			if($value[0] == 'Não identificado'){
				$countC++;
			}
		}



		$cliques = array();
		$impressoes = array();
		$investimento = array();
		$posicao = array();
		$conversao = array();
		$conversao_de_visualizacao = array();

		foreach($region as &$Row){
			array_push($cliques, array($Row[0], $Row[1]));
			array_push($impressoes, array($Row[0], $Row[2]));
			array_push($investimento, array($Row[0], ($Row[3]/1000000)));
			array_push($posicao, array($Row[0],  $Row[4]));
			array_push($conversao, array($Row[0],(int)str_replace(',','',$Row[5])));
			array_push($conversao_de_visualizacao, array($Row[0], (int)str_replace(',','',$Row[6])));
		}

		$soma = function ($a, $b){
			isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] : $a[$b[0]] = $b;
			return $a;
		};

		$cliques = array_reduce($cliques, $soma);
		$impressoes = array_reduce($impressoes, $soma);
		$investimento = array_reduce($investimento, $soma);
		$posicao = array_reduce($posicao, $soma);
		$conversao = array_reduce($conversao, $soma);
		$conversao_de_visualizacao = array_reduce($conversao_de_visualizacao, $soma);

		foreach ($posicao as &$k) {
			if($k[0] == 'Não identificado'){
				$k[1] = $k[1]/$countC;
			}
		}

		usort($cliques, function($a, $b) { if ($a[1] == $b[1]) {return 0;} return ($a[1] > $b[1]) ? -1 : 1;});
		usort($impressoes, function($a, $b) { if ($a[1] == $b[1]) {return 0;} return ($a[1] > $b[1]) ? -1 : 1;});
		usort($investimento, function($a, $b) { if ($a[1] == $b[1]) {return 0;} return ($a[1] > $b[1]) ? -1 : 1;});
		usort($conversao, function($a, $b) { if ($a[1] == $b[1]) {return 0;} return ($a[1] > $b[1]) ? -1 : 1;});
		usort($conversao_de_visualizacao, function($a, $b) { if ($a[1] == $b[1]) {return 0;} return ($a[1] > $b[1]) ? -1 : 1;});

		$cpc = array();
		$ctr = array();
		$taxa_de_conversao_total = array();
		$taxa_de_conversao = array();
		$custo_por_conversao = array();
		$conversao_total = array();
		$custo_por_conversao_total = array();

		foreach($conversao as &$a){
			foreach($investimento as &$b){
				if($a[0] == $b[0]){
					array_push($custo_por_conversao, array($a[0], ($a[1] == 0) ? 0 :round(($b[1]/$a[1]), 2)));
				} 
			}

			foreach($conversao_de_visualizacao as &$b){
				if($a[0] == $b[0]){
					array_push($conversao_total, array($a[0], ($a[1]+$b[1])));
				} 
			}
		}

		usort($conversao_total, function($a, $b) { if ($a[1] == $b[1]) {return 0;} return ($a[1] > $b[1]) ? -1 : 1;});

		foreach($cliques as &$a){
			foreach($investimento as &$b){
				if($b[0] == $a[0]){
					array_push($cpc, array($a[0], ($a[1] == 0 ) ? 0 : round($b[1]/$a[1], 2)));
				}
			}	

			foreach($impressoes as &$b){
				if($b[0] == $a[0]){
					array_push($ctr, array($a[0], round(((float)$a[1]/(float)$b[1])*100, 2)));
				} 
			}

			foreach($conversao as &$b){
				if($b[0] == $a[0]){
					array_push($taxa_de_conversao, array($a[0], ($a[1] == 0 ) ? 0 : round(($b[1]/$a[1])*100, 2)));
				} 
			}

			foreach($conversao_total as &$b){
				if($b[0] == $a[0]){
					array_push($taxa_de_conversao_total, array($a[0], ($a[1] == 0 ) ? 0 : round(($b[1]/$a[1])*100, 2)));
				} 
			}
		}



		foreach($investimento as &$a){
			foreach($conversao_total as &$b){
				if($a[0] == $b[0]){
					array_push($custo_por_conversao_total, array($a[0], ($a[1] == 0) ? 0 :round(($b[1]/$a[1]), 2)));
				} 
			}
		}

		$cliques_tabela = array(array('Data', 'Cliques',array('type' => 'string', 'role' =>'annotation')));
		$c = 0;
		foreach($cliques as &$Row){
			$c++;
			array_push($cliques_tabela, array($Row[0], (int)$Row[1], number_format((int)$Row[1],0,',','.')));
			if($c == 30){
				break;
			}
		}

		$impressoes_tabela = array(array('Data', 'Impressões', array('type' => 'string', 'role' =>'annotation')));
		$c = 0;
		foreach($impressoes as &$Row){
			$c++;
			array_push($impressoes_tabela, array($Row[0], (int)$Row[1], number_format((int)$Row[1],0,',','.')));
			if($c == 30){
				break;
			}
		}

		$investimento_tabela = array(array('Data', 'Investimento', array('type' => 'string', 'role' =>'annotation')));
		$c = 0;
		foreach($investimento as &$Row){
			$c++;
			array_push($investimento_tabela, array($Row[0], (float)$Row[1], 'R$ '.number_format((float)$Row[1],2,',','.')));
			if($c == 30){
				break;
			}
		}

		$cpc_tabela = array(array('Data', 'CPC', array('type' => 'string', 'role' =>'annotation')));
		$c = 0;
		foreach($cpc as &$Row){
			$c++;
			array_push($cpc_tabela, array($Row[0], (float)$Row[1], 'R$ '.number_format((float)$Row[1],2,',','.')));
			if($c == 30){
				break;
			}
		}

		$ctr_tabela = array(array('Data', 'CTR %', array('type' => 'string', 'role' =>'annotation')));
		$c = 0;
		foreach($ctr as &$Row){
			$c++;
			array_push($ctr_tabela, array($Row[0], (float)$Row[1], number_format((float)$Row[1],2,',','.').' %'));
			if($c == 30){
				break;
			}
		}

		$posicao_tabela = array(array('Data', 'Posição média', array('type' => 'string', 'role' =>'annotation')));
		foreach($impressoes_tabela as &$a){
			foreach($posicao as &$b){
				if($b[0] == $a[0]){
					array_push($posicao_tabela, array($b[0], round((float)$b[1], 1), number_format((float)$b[1],1,',','.')));
				}
			}
		}

		$conversao_tabela = array(array('Data','Conversões', array('type' => 'string', 'role' =>'annotation')));
		$c = 0;
		foreach($conversao as &$Row){
			$c++;
			array_push($conversao_tabela, array($Row[0], (int)$Row[1], number_format(((int)$Row[1]),0,',','.')));
			if($c == 30){
				break;
			}
		}

		$custo_por_conversao_tabela = array(array('Data','Custo por conversão total', array('type' => 'string', 'role' =>'annotation')));
		$c = 0;
		foreach($custo_por_conversao as &$Row){
			$c++;
			array_push($custo_por_conversao_tabela, array($Row[0], (float)$Row[1], 'R$ '.number_format((float)$Row[1],2,',','.')));
			if($c == 30){
				break;
			}
		}

		$taxa_de_conversao_tabela = array(array('Data','Taxa de conversão %', array('type' => 'string', 'role' =>'annotation')));
		$c = 0;
		foreach($taxa_de_conversao as &$Row){
			$c++;
			array_push($taxa_de_conversao_tabela, array($Row[0], (float)$Row[1], number_format((float)$Row[1],2,',','.').' %'));
			if($c == 30){
				break;
			}
		}

		$conversao_de_visualizacao_tabela = array(array('Data','Conversões de visualização', array('type' => 'string', 'role' =>'annotation')));
		$c = 0;
		foreach($conversao_de_visualizacao as &$Row){
			$c++;
			array_push($conversao_de_visualizacao_tabela, array($Row[0], (float)$Row[1], number_format((float)$Row[1],0,',','.')));
			if($c == 30){
				break;
			}
		}

		$conversao_total_tabela = array(array('Data','Total de conversões', array('type' => 'string', 'role' =>'annotation')));
		$c = 0;
		foreach($conversao_total as &$Row){
			$c++;
			array_push($conversao_total_tabela, array($Row[0], $Row[1], number_format((float)$Row[1],0,',','.')));
			if($c == 30){
				break;
			}
		}

		$taxa_de_conversao_total_tabela = array(array('Data','Taxa de conversão total %', array('type' => 'string', 'role' =>'annotation')));
		$c = 0;
		foreach($taxa_de_conversao_total as &$Row){
			$c++;
			array_push($taxa_de_conversao_total_tabela, array($Row[0], (float)$Row[1], number_format((float)$Row[1],2,',','.').' %'));
			if($c == 30){
				break;
			}
		}

		$custo_por_conversao_total_tabela = array(array('Data','Custo por conversão total', array('type' => 'string', 'role' =>'annotation')));
		foreach($investimento_tabela as &$a){
			foreach($conversao_total as &$b){
				if($a[0] == $b[0]){
					$v = ($b[1] == 0) ? 0 :round(($a[1]/$b[1]),2);
					array_push($custo_por_conversao_total_tabela, array($a[0], $v, 'R$ '.number_format((float)$v,2,',','.')));
				} 
			}
		}

		return
		
		"var data = google.visualization.arrayToDataTable(".json_encode($cliques_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_cliques_geo')).draw(data, optionsCliquesGeo);

		var data = google.visualization.arrayToDataTable(".json_encode($impressoes_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Impressoes_geo')).draw(data, optionsImpressoesGeo);

		var data = google.visualization.arrayToDataTable(".json_encode($investimento_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Cost_geo')).draw(data, optionsCostGeo);

		var data = google.visualization.arrayToDataTable(".json_encode($cpc_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Cpc_geo')).draw(data, optionsCpcGeo);

		var data = google.visualization.arrayToDataTable(".json_encode($ctr_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Ctr_geo')).draw(data, optionsCtrGeo);

		var data = google.visualization.arrayToDataTable(".json_encode($posicao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Posicao_geo')).draw(data, optionsPosisaoGeo);

		var data = google.visualization.arrayToDataTable(".json_encode($conversao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Conversao_geo')).draw(data, optionsConversaoGeo);

		var data = google.visualization.arrayToDataTable(".json_encode($custo_por_conversao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_Custo_coversao_geo')).draw(data, optionsConversaoCostGeo);

		var data = google.visualization.arrayToDataTable(".json_encode($taxa_de_conversao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_taxa_conversao_geo')).draw(data, optionstaxaConversaoGeo);

		var data = google.visualization.arrayToDataTable(".json_encode($conversao_de_visualizacao_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_visualisacao_geo')).draw(data, optionsVisualisacaoGeo);

		var data = google.visualization.arrayToDataTable(".json_encode($conversao_total_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_conversao_total_geo')).draw(data, optionsConversaoTotalGeo);

		var data = google.visualization.arrayToDataTable(".json_encode($taxa_de_conversao_total_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_taxa_conversao_total_geo')).draw(data, optionsTaxaConversaoTotalGeo);

		var data = google.visualization.arrayToDataTable(".json_encode($custo_por_conversao_total_tabela).");
		new google.visualization.BarChart(document.getElementById('chart_custo_conversao_total_geo')).draw(data, optionsCustoConversaoTotalGeo);";

	}
	
}