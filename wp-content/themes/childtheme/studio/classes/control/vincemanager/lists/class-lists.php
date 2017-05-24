<?php
/**
 * VinceManager.nl
 * Lists: Provides methods for getting some entities in list form
 *
 * GET api/lists/saleschannels		- Gets the sales channels (available for you).
 * GET api/lists/orderstatusses		- Gets a list of order statusses.
 * GET api/lists/countries			- Gets a list of countries (available in VinceManager).
 * GET api/lists/products			- Gets a simple list of products.
 */
class Control_VinceManager_Lists extends Control_VinceManager {

	/**
	 * Class properties
	 */
	protected $sApiUrl = null;
	protected $aMethods = array('saleschannels', 'orderstatusses', 'countries', 'products');

	/**
	 * Class constructor
	 */
	public function __construct() {

		$this->sApiUrl = $this->sBaseUrl.'api/lists/';
		parent::__construct();
		exit;
	}

	protected function GetResponse($method) {
		if( !in_array($method, $this->aMethods) ) {
			$this->Error('No valid method provided');
			exit;
		}
		// @todo what's next??
		p($this->ObtainData($this->sApiUrl.$method, 'get'));
	}
}
