<?php

namespace Relatorio\Services;

use Auth;
use AdWordsUser;
use Selector;
use Paging;
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
		$selector->paging = new Paging(0, AdWordsConstants::RECOMMENDED_PAGE_SIZE);
		
    	// Make the get request.
		$graph = $managedCustomerService->get($selector);

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

}
