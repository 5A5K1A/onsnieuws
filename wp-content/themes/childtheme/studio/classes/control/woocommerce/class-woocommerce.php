<?
/**
 * Class to programmaticly access some Woocommerce features
 */
class Control_Woocommerce extends Control {
	/**
	 * Class properties
	 */
	protected $aData = null;

	/**
	 * Class constructor
	 */
	public function __construct() {

		echo 'Example data: '.json_encode(array('email' => 'mail@mij.nl', 'username' => 'test', 'password' => 'pass'));
		$this->CreateTempForm();

		// validate
		$this->Validate();
	}

	/**
	 * Validate post
	 */
	private function Validate() {
		// check token
		if($_POST['token'] != 'ni57o345-a03c5nhjacfdDFGDF') $this->Error('Invalid token or no token posted');

		// check if data was set
		if(!isset($_POST['data'])) $this->Error('No data posted');

		// set data
		$this->aData = json_decode(stripslashes($_POST['data']), true);

		// validate data
		if(!is_array($this->aData)) $this->Error('Posted data is no valid json object');

		return true;
	}

	/**
	 * Return success message
	 */
	protected function Success( $message ) {
		$this->Response('success', $message);
	}

	/**
	 * Throw error message
	 */
	protected function Error( $message ) {
		$this->Response('error', $message);
	}

	private function LogResponse( $oResponse ) {

	}

	/**
	 * Create, output and log a response
	 */
	private function Response( $status, $message ) {
		// create response object
		$oResponse = new stdClass();
		$oResponse->status = $status;
		$oResponse->message = $message;

		// log response
		$this->LogResponse($oResponse);

		// output response to api client
		echo json_encode($oResponse);
		exit;
	}

	public function CreateTempForm() {
		echo '<form action="/" method="post"><p>Controler: <input type="text" name="control" value="Woocommerce_User_Create"/></p><p>Data: <input type="text" name="data" /></p> <p>Token: <input type="hidden" name="token" value="ni57o345-a03c5nhjacfdDFGDF"/></p> <input type="submit" name="submit" value="Submit" /> </form>';
	}
}
