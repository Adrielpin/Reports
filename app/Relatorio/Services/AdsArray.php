<?php
namespace Relatorio\Services;

use AdWordsUser;
use Selector;
use Predicate;
use DateRange;
use ReportUtils;
use ReportDefinition;

use Khill\Lavacharts\Lavacharts;


// $parcela_impressao = 'SearchImpressionShare';
		// $parcela_impressao_orcamento = 'SearchBudgetLostImpressionShare';
		// $parcela_impressao_rank = 'SearchRankLostImpressionShare';
		// $fields = array('Date', 'HourOfDay', 'Clicks', 'Impressions', 'Cost', 'AveragePosition', 'Conversions', 'ViewThroughConversions', $parcela_impressao, $parcela_impressao_orcamento, $parcela_impressao_rank, 'VideoViews');
		// $id  = '6284915288';
		// $tipo = 'SEARCH';
		// $startdate = '20160701';
		// $enddate = '20160731';

		// $array = \Relatorio\Services\AdsArray::DateReport($id, $fields, $tipo, $startdate, $enddate);

		// $selected = null;


class AdsArray {

	private function campaigns($id) {

		//set service
		$user = new AdWordsUser();
		$user->SetClientCustomerId($id);
		$campaignService = $user->GetService('CampaignService', 'v201605');

		// create selector
		$selector = new Selector();
		$selector->fields = ['Id','Name'];

		//get service
		$page = $campaignService->get($selector);
		return $page->entries;
	}

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