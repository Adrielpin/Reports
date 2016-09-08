<?php

namespace App\Http\Controllers;

// laravel Classes
use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Contracts\Encryption\DecryptException;

use Auth;
use Crypt;

// AdWords Classes
use AdWordsUser;
use Selector;
use Paging;
use AdWordsConstants;
use Predicate;
use DateRange;
use ReportUtils;
use ReportDefinition;

use Relatorio\requestData;
use Relatorio\contas;
use Relatorio\dateArrays;
use Relatorio\oldMethods;

class RelatorioController extends Controller {

	public function show() {

		$user = new AdWordsUser();
		$user->SetClientCustomerId(Auth::user()->costumer_id);

		$accounts = new contas();
		$accounts = $accounts->GetAccounts($user);
		return view('relatorio.index')->with(['prefer'=>'6284915288','campaigns' => $accounts]);

    }

	public function report(Request $request){


		$values = new requestData();
		$values = $values->request($request);

		$adsArrays = new dateArrays();
		$cliques = $adsArrays->cliques($values);
		$impressoes = $adsArrays->impressoes($values);
		$cpc = $adsArrays->cpc($values);
		$investimento = $adsArrays->investimento($values);
		$ctr = $adsArrays->ctr($values);
		$posicao = $adsArrays->position($values);
		$conversao = $adsArrays->conversao($values);
		$custoConversao = $adsArrays->custoConversao($values);
		$taxaConversao = $adsArrays->taxaConversao($values);


		$Arrays = array($cliques, $impressoes, $cpc, $investimento, $ctr, $posicao, $conversao, $custoConversao, $taxaConversao);

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

		$name = Contas::GetName($a);

		if($token >= strtotime('today')){
			return view('emails.relatorio')->with(['data'=>$data, 'week'=>$week, 'hour'=>$hour, 'geo'=>$geo, 'tipo' => $c, 'name' => $name]);
		}
		else{
			return view('index');
		}

	}
}