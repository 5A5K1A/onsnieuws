<?php
/**
 * VinceManager.nl
 * CustomerProduct: Provides methods for finding and viewing products (and their stock)
 *
 * GET api/customerproduct/getproducts?pageNumber={pageNumber}&pageSize={pageSize}&productFilter={productFilter}&categoryId={categoryId}&onlyNew={onlyNew}
 * 												- Gets the products (paged, max 1000 at once).
 * GET api/customerproduct/{id}					- Gets the product details by id.
 * GET api/customerproduct/image/{id}			- Gets the product image by product's id.
 * GET api/customerproduct/getproductcategories	- Gets the product categories.
 */
class Control_VinceManager_CustomerProduct extends Control_VinceManager {

	/**
	 * Class properties
	 */
	protected $sApiUrl = null;
	protected $aMethods = array('getproducts', 'details', 'image', 'getproductcategories');

	/**
	 * Class constructor
	 */
	public function __construct() {

		$this->sApiUrl = $this->sBaseUrl.'api/customerproduct/';
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
