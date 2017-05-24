<?php
/**
 * VinceManager.nl
 * CustomerOrder: Provides methods for finding, viewing and creating orders
 *
 * POST api/customerorder/findorders	- Gets orders found by (optional) filter values (max 100 orders at once!)
 * GET  api/customerorder/{id}			- Gets the order details by order id.
 * POST api/CustomerOrder				- Inserts a new order. Please note the following: DeliveryOptions is optional and can be omitted For country, only Id is required For product, only Id is required For Orderrows, only Product (Id) and Amount are required
 */
class Control_VinceManager_CustomerOrder extends Control_VinceManager {

	/**
	 * Class properties
	 */
	protected $sApiUrl = null;
	protected $aMethods = array('findorders', 'details', 'new');

	/**
	 * Class constructor
	 */
	public function __construct() {

		$this->sApiUrl = $this->sBaseUrl.'api/customerorder/';
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
