<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use AdWordsUser;
use Selector;
use Paging;
use AdWordsConstants;

use Predicate;
use DateRange;
use ReportUtils;
use ReportDefinition;

class RelatorioController extends Controller {

	private function GetAccounts() {

		//sert service
		$user = new AdWordsUser();
		$user->SetClientCustomerId(Auth::user()->costumer_id);
		$managedCustomerService = $user->GetService('ManagedCustomerService', 'v201605');

		// Create selector.
		$selector = new Selector();
		$selector->fields = array('CustomerId',  'Name');
		$selector->paging = new Paging(0, AdWordsConstants::RECOMMENDED_PAGE_SIZE);
		
    	// Make the get request.
		$graph = $managedCustomerService->get($selector);

		if(isset($graph)){

			$accounts = array();
			$childLinks = array();
			$form = array();

			foreach ($graph->entries as $account) {

				$accounts[$account->customerId] = $account->name;

			}

			foreach ($graph->links as $link) {

				$childLinks[$accounts[$link->managerCustomerId]][$link->clientCustomerId] = $accounts[$link->clientCustomerId];

			}
			
			foreach ($childLinks as $key_a => $values) {
				foreach ($values as $key_b => $value) {
					if(array_key_exists($value, $childLinks)){
						unset($childLinks[$key_a][$key_b]);
					}

				}
				
			}

			return $childLinks;
		}

		else {

			redirect('/home');

		}

	}

	public function index(){

		$campaigns = $this->GetAccounts();
		// $campaigns = ['a'=>'b'];

		

		return view('relatorio.index')->with(['campaigns' => $campaigns]);
	}

	public function view(){

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

		$cliques = \Relatorio\Services\AdsArray::dateCliques($returned);

		return $cliques;

	} 
}