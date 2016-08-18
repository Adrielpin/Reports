<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use AdWordsUser;
use Selector;

class RelatorioController extends Controller 
{
	private function campaigns() {

		//set service
		$user = new AdWordsUser();
		$user->SetClientCustomerId('6284915288');
		$campaignService = $user->GetService('CampaignService', 'v201605');

		// create selector
		$selector = new Selector();
		$selector->fields = ['Id','Name'];

		//get service
		$page = $campaignService->get($selector);
		return $page->entries;
	}

	private function GetAccounts() {

		//sert service
		$user = new AdWordsUser();
		$user->SetClientCustomerId(Auth::user()->costumer_id);
		$managedCustomerService = $user->GetService('ManagedCustomerService', 'v201605');

		$selector = new Selector();
		$selector->fields = array('CustomerId',  'Name', 'CanManageClients');
		$graph = $managedCustomerService->get($selector);
		$graph = $graph->entries;
		$accounts = array();

		foreach($graph as $c){
			$accounts[$c->customerId] = $c->name;
		}

		return $accounts;
	} 

	public function index(){

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
		// $campaigns = $this->GetAccounts();
		$clicks = array(array('Data','Cliques'),
			array(date('M d, Y',strtotime('2016-07-01')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-02')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-03')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-04')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-05')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-06')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-07')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-08')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-09')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-10')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-11')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-12')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-13')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-14')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-15')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-16')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-17')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-18')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-19')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-20')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-21')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-22')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-23')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-24')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-25')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-26')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-27')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-28')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-29')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-30')),rand(10,100)),
			array(date('M d, Y',strtotime('2016-07-31')),rand(10,100)));

$clicks = json_encode($clicks);

$impressions = array(array('Data','Impressoes'),
	array(date('M d, Y',strtotime('2016-07-01')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-02')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-03')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-04')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-05')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-06')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-07')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-08')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-09')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-10')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-11')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-12')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-13')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-14')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-15')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-16')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-17')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-18')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-19')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-20')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-21')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-22')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-23')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-24')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-25')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-26')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-27')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-28')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-29')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-30')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-31')),rand(10,100)));

$impressions = json_encode($impressions);

$ctr = array(array('Data','ctr'),
	array(date('M d, Y',strtotime('2016-07-01')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-02')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-03')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-04')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-05')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-06')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-07')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-08')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-09')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-10')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-11')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-12')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-13')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-14')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-15')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-16')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-17')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-18')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-19')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-20')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-21')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-22')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-23')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-24')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-25')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-26')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-27')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-28')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-29')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-30')),rand(10,100)),
	array(date('M d, Y',strtotime('2016-07-31')),rand(10,100)));

$ctr = json_encode($ctr);

return view('relatorio.index')->with(['campaigns' => ['1'=>'Adriel','2'=>'Jorge'], 'clicks'=>$clicks, 'impressions'=>$impressions,'ctr'=>$ctr]);
}
}