<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use AdWordsUser;
use Selector;
use Paging;
use AdWordsConstants;

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

		return [$clicks, $impressions, $ctr];
	} 
}