<?php

namespace App\Http\Controllers;

// laravel Classes
use Illuminate\Http\Request;
use App\Http\Requests;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

// AdWords Classes
use AdWordsUser;
use Selector;
use Paging;
use AdWordsConstants;
use Predicate;
use DateRange;
use ReportUtils;
use ReportDefinition;

use Relatorio\Services\AdsArray;
use Relatorio\Services\oldmethods;

class RelatorioController extends Controller {

	public function index(){

		$accounts = \Relatorio\Services\Contas::GetAccounts();
		return view('relatorio.index')->with(['prefer'=>'6284915288','campaigns' => $accounts,'cliques'=>1, 'impressoes'=>1, 'ctr'=>1]);
	}

	public function report(){

		$id  = '6284915288';
		$tipo = 'SEARCH';

		$parcela_impressao = 'SearchImpressionShare';
		$parcela_impressao_orcamento = 'SearchBudgetLostImpressionShare';
		$parcela_impressao_rank = 'SearchRankLostImpressionShare';
		$fields = array('Date', 'HourOfDay', 'Clicks', 'Impressions', 'Cost', 'AveragePosition', 'Conversions', 'ViewThroughConversions', $parcela_impressao, $parcela_impressao_orcamento, $parcela_impressao_rank, 'VideoViews');

		$user = new AdWordsUser();
		$user->SetClientCustomerId($id);
		$user->LoadService('ReportDefinitionService', 'v201605');

		$selector = new Selector();
		$selector->fields = $fields;
		$selector->predicates[] = new Predicate('AdvertisingChannelType', 'EQUALS', array($tipo));
		$selector->dateRange = new DateRange('20160601', '20160630');

		$reportDefinition = new ReportDefinition();
		$reportDefinition->selector = $selector;
		$reportDefinition->reportName = 'Criteria performance report';
		$reportDefinition->dateRangeType = 'CUSTOM_DATE';
		$reportDefinition->reportType = 'CAMPAIGN_PERFORMANCE_REPORT';
		$reportDefinition->downloadFormat = 'XML';

		$options = array('version' => 'v201605', 'skipReportHeader' => true, 'skipColumnHeader' => true, 'skipReportSummary' => true , 'includeZeroImpressions' => false);

		$reportUtils = new ReportUtils();
		$returned = $reportUtils->DownloadReport($reportDefinition, null, $user, $options);

		$adsArrays = new AdsArray();
		$cliques = $adsArrays->dateCliques($returned);
		$impressoes = $adsArrays->dateImpressions($returned);
		$ctr = $adsArrays->dateCtr($returned);

		$Arrays = array($cliques, $impressoes, $ctr);

		return $Arrays;

	}

	public function view(Request $request) {

		$token = Crypt::decrypt($request->input('token'));
		$a = Crypt::decrypt($request->input('a'));
		$b = Crypt::decrypt($request->input('b'));
		$c = Crypt::decrypt($request->input('c'));
		$r = 'E';

		if($c == 'SEARCH' || $c == 'SHOPPING'){
			$parcela_impressao = 'SearchImpressionShare';
			$parcela_impressao_orcamento = 'SearchBudgetLostImpressionShare';
			$parcela_impressao_rank = 'SearchRankLostImpressionShare';
		}

		else {
			$parcela_impressao = 'ContentImpressionShare';
			$parcela_impressao_orcamento = 'ContentBudgetLostImpressionShare';
			$parcela_impressao_rank = 'ContentRankLostImpressionShare';
		}

		$user = new AdWordsUser();
		$user->SetClientCustomerId($a);
		$user->LoadService('ReportDefinitionService', 'v201605');

		$methodo = new oldmethods();
		$data = $methodo->DateReportold($user, $b, $c, $parcela_impressao, $parcela_impressao_orcamento, $parcela_impressao_rank);
		$week = $methodo->weekReportold($user, $b, $c, $parcela_impressao, $parcela_impressao_orcamento, $parcela_impressao_rank);
		$hour = $methodo->hourReportold($user, $b, $c, $parcela_impressao, $parcela_impressao_orcamento, $parcela_impressao_rank);
		$geo = $methodo->geoReportold($user, $b, $c, $r);

		if($token >= strtotime('today')){
			return view('emails.relatorio')->with(['data'=>$data, 'week'=>$week, 'hour'=>$hour, 'geo'=>$geo, 'tipo' => $c]);
		}
		else{
			return view('index');
		}
	}
}