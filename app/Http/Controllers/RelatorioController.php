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

use Relatorio\getDates;
use Relatorio\requestData;
use Relatorio\contas;
use Relatorio\dateArrays;
use Relatorio\monthArrays;
use Relatorio\weekArrays;
use Relatorio\hourArrays;
use Relatorio\oldmethods;

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

		$date = new getDates();
		$date = $date->getParameter($request);
		
		($date != 'Date') ? $adsArrays = new monthArrays() : $adsArrays = new dateArrays();

		$cliques = $adsArrays->cliques($values);
		$impressoes = $adsArrays->impressoes($values);
		$cpc = $adsArrays->cpc($values);
		$investimento = $adsArrays->investimento($values);
		$ctr = $adsArrays->ctr($values);
		$posicao = $adsArrays->position($values);
		$conversao = $adsArrays->conversao($values);
		$custoConversao = $adsArrays->custoConversao($values);
		$taxaConversao = $adsArrays->taxaConversao($values);
		$searchImpressionShare = $adsArrays->searchImpressionShare($values);


		$adsArrays = new weekArrays();
		$wcliques = $adsArrays->cliques($values);
		$wimpressoes = $adsArrays->impressoes($values);
		$wcpc = $adsArrays->cpc($values);
		$winvestimento = $adsArrays->investimento($values);
		$wctr = $adsArrays->ctr($values);
		$wposicao = $adsArrays->position($values);
		$wconversao = $adsArrays->conversao($values);
		$wcustoConversao = $adsArrays->custoConversao($values);
		$wtaxaConversao = $adsArrays->taxaConversao($values);
		$wsearchImpressionShare = $adsArrays->searchImpressionShare($values);

		$adsArrays = new hourArrays();
		$hcliques = $adsArrays->cliques($values);
		$himpressoes = $adsArrays->impressoes($values);
		$hcpc = $adsArrays->cpc($values);
		$hinvestimento = $adsArrays->investimento($values);
		$hctr = $adsArrays->ctr($values);
		$hposicao = $adsArrays->position($values);
		$hconversao = $adsArrays->conversao($values);
		$hcustoConversao = $adsArrays->custoConversao($values);
		$htaxaConversao = $adsArrays->taxaConversao($values);
		$hsearchImpressionShare = $adsArrays->searchImpressionShare($values);

		$token = Crypt::encrypt(strtotime('today +1 day'));
		$a = Crypt::encrypt($request->id);
		$b = Crypt::encrypt($request->periodos);
		$c = Crypt::encrypt($request->type);

		$attach = 'token='.$token.'&a='.$a.'&b='.$b.'&c='.$c;

		
		$Arrays = array($cliques, $impressoes, $cpc, $investimento, $ctr, $posicao, $conversao, $custoConversao, $taxaConversao, $searchImpressionShare, $wcliques, $wimpressoes, $wcpc, $winvestimento, $wctr, $wposicao, $wconversao, $wcustoConversao, $wtaxaConversao, $wsearchImpressionShare, $hcliques, $himpressoes, $hcpc, $hinvestimento, $hctr, $hposicao, $hconversao, $hcustoConversao, $htaxaConversao, $hsearchImpressionShare, $attach);

		return $Arrays;

	}

	public function view(Request $request) {

		
		$token = Crypt::decrypt($request->token);
		$a = Crypt::decrypt($request->a);
		$b = Crypt::decrypt($request->b);
		$c = Crypt::decrypt($request->c);
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