<?php 
namespace Relatorio;

use getDate;

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

		$fields = array('Year', 'Month', 'Date', 'DayOfWeek', 'HourOfDay', 'Clicks', 'Impressions', 'Cost', 'AveragePosition', 'Conversions', 'ViewThroughConversions', 'SearchImpressionShare', 'SearchBudgetLostImpressionShare', 'SearchRankLostImpressionShare', 'ContentImpressionShare', 'ContentBudgetLostImpressionShare', 'ContentRankLostImpressionShare');

		$user = new AdWordsUser();
		$user->SetClientCustomerId($request->id);
		$user->LoadService('ReportDefinitionService', 'v201605');

		$selector = new Selector();
		$selector->fields = $fields;
		$selector->predicates[] = new Predicate('AdvertisingChannelType', 'EQUALS', array($request->type));

		$date = new getDates();
		$date = $date->getDate($request);

		$selector->dateRange = new DateRange($date['start'], $date['end']);

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
