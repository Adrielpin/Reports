<?php 
namespace Relatorio;

use AdWordsUser;
use Selector;
use Paging;
use AdWordsConstants;
use Predicate;
use DateRange;
use ReportUtils;
use ReportDefinition;

class requestData {

	public function request ($request) {

		$fields = array('Date', 'HourOfDay', 'Clicks', 'Impressions', 'Cost', 'AveragePosition', 'Conversions', 'ViewThroughConversions', 'SearchImpressionShare', 'SearchBudgetLostImpressionShare', 'SearchRankLostImpressionShare', 'ContentImpressionShare', 'ContentBudgetLostImpressionShare', 'ContentRankLostImpressionShare');

		$user = new AdWordsUser();
		$user->SetClientCustomerId($request->id);
		$user->LoadService('ReportDefinitionService', 'v201605');

		$selector = new Selector();
		$selector->fields = $fields;
		$selector->predicates[] = new Predicate('AdvertisingChannelType', 'EQUALS', array($request->type));
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

		return $returned;

	}

}