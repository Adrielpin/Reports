<?php
namespace Relatorio\Services;

use AdWordsUser;
use Selector;
use Predicate;
use DateRange;
use ReportUtils;
use ReportDefinition;

use Khill\Lavacharts\Lavacharts;


class AdsArray {

	public static function DateReport($id, $fields, $tipo, $startdate, $enddate) {

		$user = new AdWordsUser();
		$user->SetClientCustomerId($id);
		$user->LoadService('ReportDefinitionService', 'v201605');

		$selector = new Selector();
		$selector->fields = $fields;
		$selector->predicates[] = new Predicate('AdvertisingChannelType', 'EQUALS', array($tipo));
		$selector->dateRange = new DateRange($startdate, $enddate);

		$reportDefinition = new ReportDefinition();
		$reportDefinition->selector = $selector;
		$reportDefinition->reportName = 'Criteria performance report';
		$reportDefinition->dateRangeType = 'CUSTOM_DATE';
		$reportDefinition->reportType = 'CAMPAIGN_PERFORMANCE_REPORT';
		$reportDefinition->downloadFormat = 'XML';

		$options = array('version' => 'v201605');
		$options['skipReportHeader'] = true;
		$options['skipColumnHeader'] = true;
		$options['skipReportSummary'] = true;
		$options['includeZeroImpressions'] = false;

		$reportUtils = new ReportUtils();
		$returned = $reportUtils->DownloadReport($reportDefinition, null, $user, $options);

		$array = json_decode(json_encode((array)simplexml_load_string($returned)),1);
		$array = $array['table']['row'];

		$grafico = new AdsArray();
		$grafico = $grafico->makeDataTable($array);
		return $grafico;

	}

	private function makeDataTable($values) {
		
		$grafico = new AdsArray();
		$grafico = $grafico->graficoClik($values);

		return $grafico;

	}

	private function graficoClik($array) {
		
		$chart = new Lavacharts();

		$graph = $chart->DataTable();

		$graph	->addDateColumn('Day of Month')
		->addNumberColumn('Cliques');

		$values = array();
		foreach ($array as $value) {
			foreach ($value as $val) {
				array_push($values, [$val['day'],$val['clicks']]);
			}
		}

		$values = array_reduce($values, function ($a, $b){isset($a[$b[0]]) ? $a[$b[0]][1] += $b[1] : $a[$b[0]] = $b;return $a;});

		foreach ($values as $val) {
			$graph->addRow([$val[0],$val[1]]);
		}

		$chart->BarChart('Cliques', $graph);
		return $chart;

	}

}