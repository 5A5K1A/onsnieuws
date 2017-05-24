<?
/**
 * Class to obtain data from Vincemanager account
 */
class Control_VinceManager extends Control {
	/**
	 * Class properties
	 */
	protected $oToken = null;
	protected $sBaseUrl = 'https://vincemanager.nl/';

	/**
	 * Class constructor
	 */
	public function __construct() {

		if( $this->oToken == null ) $this->ObtainToken();

		if( $sMethod = GetValue('method') ) {
			$this->GetResponse($sMethod);

			// $this->ObtainData($this->sBaseUrl.'api/lists/products');
			exit;
		}

		$this->Error('No valid context or method provided');

		exit;
	}

	private function ObtainToken() {
		// access_token


		$aPostData = http_build_query(
		    array(
		        'grant_type' => 'password',
				'username'   => VINCE_USER,
				'password'   => VINCE_PASS
		    )
		);

		$aOptions = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => $aPostData
		    )
		);

		$sContext = stream_context_create($aOptions);
		$sJSON    = file_get_contents($this->sBaseUrl.'token', false, $sContext);
		$oResult  = json_decode($sJSON);

		if(isset($oResult->access_token)) {
			$this->oToken = $oResult;
			return;
		}

		$this->Error( 'Not able to obtain token' );
		exit;
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

	protected function ObtainData( $url, $type = 'get' ) {
		$sCurl = curl_init();

		$aHeader = array();
		$aHeader[] = 'Content-length: 0';
		$aHeader[] = 'Content-type: application/json';
		$aHeader[] = 'Authorization: '.$this->oToken->token_type.' '.$this->oToken->access_token;

		curl_setopt($sCurl, CURLOPT_URL, $url);
		curl_setopt($sCurl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($sCurl, CURLOPT_HTTPHEADER, $aHeader);

		if( $type != 'get' ) { curl_setopt($sCurl, CURLOPT_POST, true); }
		else { curl_setopt($sCurl, CURLOPT_HTTPGET, true); }

		$sResponse = curl_exec($sCurl);

		if( $sResponse === false ) {
		    $oError = json_decode(curl_error($sCurl));
		    print_r($oError);
		    print_r('Curl error: ' . curl_error($sCurl));
		    // @todo check & dubbelcheck to make this work
		}

		curl_close($sCurl);
		$oResponse = json_decode($sResponse);
		if(isset($oResponse->Message)) {
			$this->Error($oResponse->Message);
			exit;
		}
		return $oResponse;
	}
}
