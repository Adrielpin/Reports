<?php

namespace Relatorio;

use Auth;
use AdWordsUser;
use Selector;
use AdWordsConstants;

class Contas {

	static public function GetAccounts() {

		//sert service
		$user = new AdWordsUser();
		$user->SetClientCustomerId(Auth::user()->costumer_id);
		$managedCustomerService = $user->GetService('ManagedCustomerService', 'v201605');

		// Create selector.
		$selector = new Selector();
		$selector->fields = array('CustomerId',  'Name');
		
    	// Make the get request.
		$graph = $managedCustomerService->get($selector);

		$accounts = array();
		$childLinks = array();
		$form = array();

		foreach ($graph->entries as $account) {

			$accounts[$account->customerId] = $account->name;

		}

		if(isset($graph->links)){
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

		else{

			return $accounts;

		}	

	}

	static public function GetIds() {

		//sert service
		$user = new AdWordsUser();
		$user->SetClientCustomerId(Auth::user()->costumer_id);
		$managedCustomerService = $user->GetService('ManagedCustomerService', 'v201605');

		// Create selector.
		$selector = new Selector();
		$selector->fields = array('CustomerId',  'Name');
		
    	// Make the get request.
		$graph = $managedCustomerService->get($selector);

		$accounts = array();
		$childLinks = array();
		$form = array();

		foreach ($graph->entries as $account) {

			array_push($accounts, $account->customerId);

		}

		return $accounts;
		
	}

	static public function GetName($account) {

		//sert service
		$user = new AdWordsUser();
		$user->SetClientCustomerId($account);
		$managedCustomerService = $user->GetService('ManagedCustomerService', 'v201605');

		// Create selector.
		$selector = new Selector();
		$selector->fields = array('CustomerId',  'Name');
		
    	// Make the get request.
		$graph = $managedCustomerService->get($selector);

		$accounts = array();
		$childLinks = array();
		$form = array();

		foreach ($graph->entries as $account) {

			$name = $account->name;

		}

		return $name;

	}

}
