<?
/**
 * Class to fetch Zendesk data
 */
class Control_Zendesk_Section extends Control_Zendesk {

	private $aSections = array();

	public function __construct() {

		parent::__construct();

		// collect JSON data
		$sJson        = @file_get_contents($this->GetUrlLocale().'sections.json');
		$oSectionData = json_decode($sJson);

		// display error if no connection is possible
		if( empty($oSectionData) ) {
			return $this->ErrorObject( $this->GetConnError() );
			exit;
		}
		// display error if no sections are available
		if( $oSectionData->count < 1 ) {
			$message = __("There are no sections available.", 'studio');
			return $this->ErrorObject( $message );
			exit;
		}

		// @todo: rewrite to new StdClass();

		// push all sections to the array
		foreach( (array) $oSectionData->sections as $oSection ) {
			$this->aSections[$oSection->id] = $oSection;
		}
	}


	public function GetAllSections() {
		return $this->aSections;
	}


	public function GetSectionById( $id ) {
		return $this->aSections[$id];
	}

	/**
	 * Gets the single section.
	 * @param      string  $id     The identifier
	 * @return     <type>  The single section.
	 */
	public function GetSingleSection( $id ) {
		// $oSection = $this->GetSectionById($id);

		$sJson        = @file_get_contents($this->GetUrlLocale().'sections/'.$id.'/articles.json');
		$oArticleData = json_decode($sJson);

		// display error if no connection is possible
		if( empty($oArticleData) ) {
			return $this->ErrorObject( $this->GetConnError() );
			exit;
		}
		// display error if no sections are available
		if( $oArticleData->count < 1 ) {
			$message = __("There are no articles available.", 'studio');
			return $this->ErrorObject($message);
			exit;
		}

		// @todo: rewrite to new StdClass();

		return $oArticleData->articles;
	}
}


