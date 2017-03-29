<?
/**
 * Class to fetch Zendesk data
 */
class Control_Zendesk_Search extends Control_Zendesk {

	private $sSearchUrl;
	private $aResults = array();

	public function __construct() {

		parent::__construct();
		$this->sSearchUrl = $this->GetUrlBase().'articles/search.json';

	}

	public function GetSearchResults( $search ) {

		// collect JSON data
		$sJson       = @file_get_contents($this->sSearchUrl.'?query='.$search);
		$oSearchData = json_decode($sJson);

// p($oSearchData);
		// display error if no connection is possible
		if( empty($oSearchData) ) {
			return $this->ErrorObject( $this->GetConnError() );
			exit;
		}

		// @todo: rewrite to new StdClass();

		$oResponse          = new StdClass();
		$oResponse->error   = FALSE;

		$aResults = array();

		// push all results to the array
		foreach( (array) $oSearchData->results as $oResult ) {
			$aResults[$oResult->id] = $oResult;
		}

		$oResponse->results = $aResults;

		return $oResponse;
	}
}


